<?php

namespace Test\Unit\Features;

use API\Lib\Features\RetrieveUser;
use API\Repositories\UserRepository;
use Tests\Unit\BaseTestCase;
use Mockery as M;

class RetrieveUserTest extends BaseTestCase
{
    public function testGetUserById()
    {
        $mRepo = M::mock(UserRepository::class, $this->container);
        $mRepo->shouldReceive('find')
            ->with(99)
            ->andReturn(M::self());
        $mRepo->shouldReceive('toArray')
            ->andReturn(true);

        $this->container[UserRepository::class] = $mRepo;

        $feature = new RetrieveUser($this->container);
        $result = $feature->execute(99);

        $this->assertTrue($result);
    }

    public function testGetAllUsers()
    {
        $mRepo = M::mock(UserRepository::class, $this->container);
        $mRepo->shouldReceive('all')
            ->andReturn(M::self());
        $mRepo->shouldReceive('toArray')
            ->andReturn(true);

        $this->container[UserRepository::class] = $mRepo;

        $feature = new RetrieveUser($this->container);
        $result = $feature->execute();

        $this->assertTrue($result);
    }
}
