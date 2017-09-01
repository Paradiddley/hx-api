<?php

namespace Test\Unit\Features;

use API\Lib\Features\DeleteUser;
use API\Repositories\UserRepository;
use Tests\Unit\BaseTestCase;
use Mockery as M;

class DeleteUserTest extends BaseTestCase
{
    public function testDeleteUser()
    {
        $id = 99;

        $mRepo = M::mock(UserRepository::class, $this->container);
        $mRepo->shouldReceive('delete')
            ->once()
            ->andReturn(1);
        $mRepo->shouldReceive('delete')
            ->once()
            ->andReturn(0);

        $this->container[UserRepository::class] = $mRepo;

        $feature = new DeleteUser($this->container);
        $result = $feature->execute($id);

        $this->assertTrue($result);

        $result = $feature->execute($id);

        $this->assertFalse($result);
    }
}
