<?php

namespace API\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->findBy($this->model->getKeyName(), $id);
    }

    public function findBy($attribute, $value, $relations = null)
    {
        $query = $this->model->where($attribute, $value);
        if ($relations && is_array($relations)) {
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        }
        return $query->firstOrFail();
    }

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
