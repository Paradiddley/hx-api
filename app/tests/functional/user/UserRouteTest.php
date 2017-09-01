<?php

namespace Tests\Functional\User;

use API\Models\User;
use Tests\Functional\BaseTestCase;

class UserRouteTest extends BaseTestCase
{
    public function testGetUsers()
    {
        $this->runApp('GET', '/api/users');

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseHasContentType('application/json');
        $this->assertCount(5, $this->responseData());
    }

    public function testGetUserById()
    {
        $expectedKeys = ['id', 'email', 'forename', 'surname'];

        $this->runApp('GET', '/api/user/3');

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseHasContentType('application/json');

        $result = $this->responseData();

        foreach ($expectedKeys as $key) {
            $this->assertArrayHasKey($key, $result);
        }

        $this->assertCount(6, $result);
        $this->assertEquals(3, $result['id']);
        $this->assertEquals('Bart', $result['forename']);
        $this->assertEquals('Simpson', $result['surname']);
        $this->assertEquals('bart@simpsons.com', $result['email']);
    }

    public function testCreateUser()
    {
        $data = [
            'forename' => 'Ned',
            'surname' => 'Flanders',
            'email' => 'ned@thesimpsons.com'
        ];

        $this->runApp('POST', '/api/user/new', $data);

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseHasContentType('application/json');
        $this->assertSame(['success' => true], $this->responseData());

        $user = User::where('forename', 'Ned')->first();
        $this->assertEquals($data['forename'], $user->forename);
        $this->assertEquals($data['surname'], $user->surname);
        $this->assertEquals($data['email'], $user->email);
    }

    public function testSearchUser()
    {
        $data = [
            'searchField' => 'surname',
            'searchTerm' => 'Simpson'
        ];

        $this->runApp('POST', '/api/user/search', $data);

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseHasContentType('application/json');

        $response = $this->responseData();

        $this->assertCount(2, $response);
        $this->assertEquals('Bart', $response[0]['forename']);
        $this->assertEquals('Homer', $response[1]['forename']);
    }

    public function testUpdateUser()
    {
        $data = [
            'forename' => 'Lisa'
        ];

        $user = User::find(3);
        $this->assertEquals('Bart', $user->forename);
        $this->assertEquals('Simpson', $user->surname);

        $this->runApp('PATCH', '/api/user/3', $data);

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseHasContentType('application/json');
        $this->assertSame(['success' => true], $this->responseData());

        $user = User::find(3);
        $this->assertEquals('Lisa', $user->forename);
    }

    public function testDeleteUser()
    {
        $user = User::find(3);
        $this->assertInstanceOf(User::class, $user);

        $this->runApp('DELETE', '/api/user/3');

        $this->assertThatResponseHasStatus(200);
        $this->assertThatResponseHasContentType('application/json');
        $this->assertSame(['success' => true], $this->responseData());

        $user = User::find(3);
        $this->assertEmpty($user);
    }
}
