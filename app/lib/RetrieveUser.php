<?php

namespace Lib;

use API\Repositories\UserRepository;

class RetrieveUser extends Feature
{
    protected $repoClass = UserRepository::class;

    /**
     * @param int $id
     * @return array
     */
    public function execute($id)
    {
        if ($id) {
            $results = $this->repo->find($id);
        } else {
            $results = $this->repo->all();
        }

        return $results->toArray();
    }
}
