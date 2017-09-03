<?php

namespace Test\Unit\Features;

use API\Lib\Features\CreateUser;
use API\Repositories\UserRepository;
use Tests\Unit\BaseTestCase;
use Mockery as M;

class CreateUserTest extends BaseTestCase
{
    public function testCreateUser()
    {
        $data = ['key' => 'value'];

        $mRepo = M::mock(UserRepository::class, $this->container);
        $mRepo->shouldReceive('create')
            ->with($data)
            ->andReturn(true);

        $this->container[UserRepository::class] = $mRepo;

        $feature = new CreateUser($this->container);
        $result = $feature->execute($data);

        $this->assertTrue($result);
    }
}
