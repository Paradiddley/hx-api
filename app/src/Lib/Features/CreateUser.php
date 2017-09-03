<?php

namespace API\Lib\Features;

use API\Repositories\UserRepository;

class CreateUser extends Feature
{
    protected $repoClass = UserRepository::class;

    public function execute($postData)
    {
        return $this->repo->create($postData);
    }
}
