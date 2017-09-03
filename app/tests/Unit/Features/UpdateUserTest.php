<?php

namespace Test\Unit\Features;

use API\Lib\Features\UpdateUser;
use API\Repositories\UserRepository;
use Tests\Unit\BaseTestCase;
use Mockery as M;

class UpdateUserTest extends BaseTestCase
{
    public function testUpdateUser()
    {
        $data = [
            'id' => 'foo',
            'body' => 'bar'
        ];

        $mRepo = M::mock(UserRepository::class, $this->container);
        $mRepo->shouldReceive('update')
            ->once()
            ->with($data['id'], $data['body'])
            ->andReturn(1);
        $mRepo->shouldReceive('update')
            ->once()
            ->with($data['id'], $data['body'])
            ->andReturn(0);

        $this->container[UserRepository::class] = $mRepo;

        $feature = new UpdateUser($this->container);
        $result = $feature->execute($data);

        $this->assertTrue($result);

        $result = $feature->execute($data);

        $this->assertFalse($result);
    }
}
