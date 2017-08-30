<?php

namespace API\Repositories;

use API\Models\User;
use Slim\Container;

class UserRepository extends Repository
{
    public function __construct(Container $container)
    {
        parent::__construct($container[User::class]);
    }
}
