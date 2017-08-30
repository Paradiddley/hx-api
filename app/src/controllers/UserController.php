<?php

namespace API\Controllers;

use API\Validation\UserValidation;
use Lib\CreateUser;
use Lib\RetrieveUser;
use Lib\SearchUser;

class UserController extends BaseController
{
    protected $validation = UserValidation::class;

    /**
     * User GET method to retrieve user data
     *
     * @return string
     */
    public function get()
    {
        $feature = new RetrieveUser($this->container);
        $result = $feature->execute($this->request->getAttribute('id'));

        return $this->response($result);
    }

    /**
     * User POST method to create user or find by
     * a users' attribute
     */
    public function post()
    {
        $path = explode('/', $this->request->getUri());

        switch (last($path)) {
            case 'new':
                $feature = new CreateUser($this->container);
                break;
            case 'search':
                $feature = new SearchUser($this->container);
                break;
        }

        $result = $feature->execute($this->body);

        return $this->response($result);
    }

    /**
     * User PATCH method to update existing user
     */
    public function patch()
    {

    }

    /**
     * User DELETE method to remove user record
     */
    public function delete()
    {

    }
}
