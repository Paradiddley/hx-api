<?php

namespace API\Controllers;

use API\Repositories\UserRepository;

class UserController extends BaseController
{
    protected $repoClass = UserRepository::class;

    public function get()
    {
        $all = $this->repo->all();
        return $this->response([$all]);
    }

    public function post()
    {

    }

    public function patch()
    {

    }

    public function delete()
    {

    }
}
