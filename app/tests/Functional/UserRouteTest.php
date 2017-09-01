<?php

namespace Tests\Functional;

class UserRouteTest extends BaseTestCase
{
    public function testGetUsers()
    {
        $response = $this->runApp('GET', '/api/users');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testGetUserById()
    {
        $this->markTestIncomplete();
    }

    public function testCreateUser()
    {
        $this->markTestIncomplete();
    }

    public function testSearchUser()
    {
        $this->markTestIncomplete();
    }

    public function testUpdateUser()
    {
        $this->markTestIncomplete();
    }

    public function testDeleteUser()
    {
        $this->markTestIncomplete();
    }
}
