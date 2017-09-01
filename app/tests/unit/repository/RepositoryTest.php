<?php

namespace Tests\Unit\Repository;

use API\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;
use Mockery as M;
use Tests\Unit\BaseTestCase;

class RepositoryTest extends BaseTestCase
{
    public function testAll()
    {
        $mModel = M::mock(Model::class);
        $mModel->shouldReceive('all')
            ->andReturn(true);

        $mRepo = $this->getMockForAbstractClass(Repository::class, [$mModel]);
        $result = $mRepo->all();

        $this->assertTrue($result);
    }

    public function testFind()
    {
        $attribute = 'key';
        $id = 99;

        $mModel = M::mock(Model::class);
        $mModel->shouldReceive('getKeyName')
            ->andReturn($attribute);
        $mModel->shouldReceive('where')
            ->with($attribute, $id)
            ->andReturn(M::self());
        $mModel->shouldReceive('firstOrFail')
            ->andReturn(true);

        $mRepo = $this->getMockForAbstractClass(Repository::class, [$mModel]);
        $result = $mRepo->find($id);

        $this->assertTrue($result);
    }

    public function testFindBy()
    {
        $attribute = 'key';
        $value = 'value';

        $mModel = M::mock(Model::class);
        $mModel->shouldReceive('where')
            ->with($attribute, $value)
            ->andReturn(M::self());
        $mModel->shouldReceive('firstOrFail')
            ->andReturn(true);

        $mRepo = $this->getMockForAbstractClass(Repository::class, [$mModel]);
        $result = $mRepo->findBy($attribute, $value);

        $this->assertTrue($result);
    }

    public function testMagicFindBy()
    {
        $attribute = 'magic';
        $value = 'value';

        $mModel = M::mock(Model::class);
        $mModel->shouldReceive('where')
            ->with($attribute, $value)
            ->andReturn(M::self());
        $mModel->shouldReceive('firstOrFail')
            ->andReturn(true);

        $mRepo = $this->getMockForAbstractClass(Repository::class, [$mModel]);
        $result = $mRepo->findByMagic($value);

        $this->assertTrue($result);
    }
}
