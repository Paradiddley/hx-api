<?php

namespace Lib;

use API\Repositories\UserRepository;

class SearchUser extends Feature
{
    protected $repoClass = UserRepository::class;

    public function execute($terms)
    {

    }
}
