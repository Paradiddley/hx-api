<?php

namespace API\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /** @var Model $model */
    protected $model;

    /**
     * Repository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->findBy($this->model->getKeyName(), $id);
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return mixed
     */
    public function findBy($attribute, $value)
    {
        $query = $this->model->where($attribute, $value);
        return $query->firstOrFail();
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        /*
         * findBy convenience calling to be available
         * through findByName and findByTitle etc.
         */
        if (preg_match('/^findBy/', $method)) {
            $attribute = strtolower(substr($method, 6));
            array_unshift($arguments, $attribute);
            return call_user_func_array(array($this, 'findBy'), $arguments);
        }
    }
}
