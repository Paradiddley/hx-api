<?php

namespace API\Lib;

use API\Repositories\UserRepository;

class DeleteUser extends Feature
{
    protected $repoClass = UserRepository::class;

    public function execute($id)
    {
        $result = $this->repo->delete($id);

        return $result > 0 ? true : false;
    }
}
