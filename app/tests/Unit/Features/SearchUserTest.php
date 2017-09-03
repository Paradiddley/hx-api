<?php

namespace Test\Unit\Features;

use API\Lib\Features\SearchUser;
use API\Repositories\UserRepository;
use Tests\Unit\BaseTestCase;
use Mockery as M;

class SearchUserTest extends BaseTestCase
{
    public function testSearchUser()
    {
        $data = [
            'searchTerm' => 'foo',
            'searchField' => 'bar'
        ];

        $mRepo = M::mock(UserRepository::class, $this->container);
        $mRepo->shouldReceive('search')
            ->with($data['searchField'], $data['searchTerm'])
            ->andReturn(M::self());
        $mRepo->shouldReceive('toArray')
            ->andReturn(true);

        $this->container[UserRepository::class] = $mRepo;

        $feature = new SearchUser($this->container);
        $result = $feature->execute($data);

        $this->assertTrue($result);
    }
}
