<?php

namespace Tests\Unit\Repository;

use API\Models\User;
use API\Repositories\UserRepository;
use Mockery as M;
use Tests\Unit\BaseTestCase;

class UserRepositoryTest extends BaseTestCase
{
    public function testCreate()
    {
        $data = [
            'forename' => 'john',
            'surname' => 'smith',
            'email' => 'john@example.com'
        ];

        $mUser = M::mock(User::class);
        $mUser->shouldReceive('where->first')
            ->andReturn(false);

        $mUser->shouldReceive('setAttribute')
            ->with('forename', $data['forename']);
        $mUser->shouldReceive('setAttribute')
            ->with('surname', $data['surname']);
        $mUser->shouldReceive('setAttribute')
            ->with('email', $data['email']);
        $mUser->shouldReceive('save')
            ->andReturn(true);

        $this->container[User::class] = $mUser;

        $repo = new UserRepository($this->container);
        $result = $repo->create($data);

        $this->assertTrue($result);
    }

    public function testSearch()
    {
        $searchField = 'foo';
        $searchTerm = 'bar';

        $mUser = M::mock(User::class);
        $mUser->shouldReceive('where')
            ->with($searchField, 'like', "%$searchTerm%")
            ->andReturn(M::self())
            ->getMock()
            ->shouldReceive('get')
            ->andReturn(true);

        $this->container[User::class] = $mUser;

        $repo = new UserRepository($this->container);
        $result = $repo->search($searchField, $searchTerm);

        $this->assertTrue($result);
    }

    public function testUpdate()
    {
        $id = 99;
        $data = [
            'email' => 'foo@example.com'
        ];

        $mUser = M::mock(User::class);
        $mUser->shouldReceive('where->first')
            ->once()
            ->andReturn(false);

        $mUser->shouldReceive('where->update')
            ->with('id', $id)
            ->andReturn(M::self())
            ->getMock()
            ->shouldReceive('update')
            ->with($data)
            ->andReturn(true);

        $this->container[User::class] = $mUser;

        $repo = new UserRepository($this->container);
        $result = $repo->update($id, $data);

        $this->assertTrue($result);
    }

    public function testDelete()
    {
        $id = 99;

        $mUser = M::mock(User::class);
        $mUser->shouldReceive('destroy')
            ->with($id)
            ->andReturn(true);

        $this->container[User::class] = $mUser;

        $repo = new UserRepository($this->container);
        $result = $repo->delete($id);

        $this->assertTrue($result);
    }
}
