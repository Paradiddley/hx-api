<?php

namespace API\Controllers;

use API\Validation\UserValidation;
use Lib\CreateUser;
use Lib\DeleteUser;
use Lib\RetrieveUser;
use Lib\SearchUser;
use Lib\UpdateUser;

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

        return $this->respond($result);
    }

    /**
     * User POST method to create user or find by
     * a users' attribute
     *
     * @return string
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

        return $this->respond($result);
    }

    /**
     * User PATCH method to update existing user
     *
     * @return string
     */
    public function patch()
    {
        $data = [
            'id' => $this->request->getAttribute('id'),
            'body' => $this->body
        ];

        $feature = new UpdateUser($this->container);
        $result = $feature->execute($data);

        return $this->respond($result);
    }

    /**
     * User DELETE method to remove user record
     *
     * @return string
     */
    public function delete()
    {
        $feature = new DeleteUser($this->container);
        $result = $feature->execute($this->request->getAttribute('id'));

        return $this->respond($result);
    }
}
