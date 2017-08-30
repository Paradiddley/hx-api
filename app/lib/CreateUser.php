<?php

namespace Lib;

use API\Repositories\UserRepository;

class CreateUser extends Feature
{
    protected $repoClass = UserRepository::class;

    public function execute($postData)
    {
        return $this->repo->create($postData);
    }
}
