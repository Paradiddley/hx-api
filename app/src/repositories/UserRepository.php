<?php

namespace API\Repositories;

use API\Models\User;
use Slim\Container;

class UserRepository extends Repository
{
    private $required = [
        'forename',
        'surname',
        'email'
    ];

    public function __construct(Container $container)
    {
        parent::__construct($container[User::class]);
    }

    public function create($data)
    {
        $missing = array_diff_key(array_flip($this->required), $data);

        if (!empty($missing)) {
            throw new \Exception('Missing data for create: ' . implode(', ', $missing));
        } elseif (User::where('email', $data['email'])->first()) {
            throw new \Exception('A user with the email ' . $data['email'] . ' already exists');
        }

        $user = new User;
        $user->forename = $data['forename'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];

        return $user->save();
    }

    public function search($field, $term)
    {
        return $this->model
            ->where($field, 'like', "%$term%")
            ->get();
    }

    public function update($id, $data)
    {
        $fields = array_intersect_key($data, array_flip($this->required));

        if (isset($fields['email']) && User::where('email', $fields['email'])->first()) {
            throw new \Exception('A user with the email ' . $data['email'] . ' already exists');
        }

        return $this->model
            ->where('id', $id)
            ->update($fields);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
