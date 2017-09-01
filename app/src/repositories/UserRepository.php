<?php

namespace API\Repositories;

use API\Models\User;
use Slim\Container;

class UserRepository extends Repository
{
    /** @var array $required */
    private $required = [
        'forename',
        'surname',
        'email'
    ];

    /**
     * UserRepository constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct($container[User::class]);
    }

    /**
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function create($data)
    {
        $missing = array_diff_key(array_flip($this->required), $data);

        if (!empty($missing)) {
            throw new \Exception('Missing data for create. Fields required are: ' . implode(', ', $this->required));
        } elseif ($this->model->where('email', $data['email'])->first()) {
            throw new \Exception('A user with the email ' . $data['email'] . ' already exists');
        }

        $user = $this->model;
        $user->forename = $data['forename'];
        $user->surname = $data['surname'];
        $user->email = $data['email'];

        return $user->save();
    }

    /**
     * @param string $field
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search($field, $term)
    {
        return $this->model
            ->where($field, 'like', "%$term%")
            ->get();
    }

    /**
     * @param int $id
     * @param array $data
     * @return int
     * @throws \Exception
     */
    public function update($id, $data)
    {
        $fields = array_intersect_key($data, array_flip($this->required));

        if (isset($fields['email']) && $this->model->where('email', $fields['email'])->first()) {
            throw new \Exception('A user with the email ' . $data['email'] . ' already exists');
        }

        return $this->model
            ->where('id', $id)
            ->update($fields);
    }

    /**
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
