<?php

namespace API\Lib\Features;

use API\Repositories\UserRepository;

class RetrieveUser extends Feature
{
    protected $repoClass = UserRepository::class;

    /**
     * @param int|null $id
     * @return array
     */
    public function execute($id = null)
    {
        if ($id) {
            $results = $this->repo->find($id);
        } else {
            $results = $this->repo->all();
        }

        return $results->toArray();
    }
}
