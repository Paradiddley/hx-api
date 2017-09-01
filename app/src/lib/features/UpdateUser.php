<?php

namespace API\Lib\Features;

use API\Repositories\UserRepository;

class UpdateUser extends Feature
{
    protected $repoClass = UserRepository::class;

    public function execute($data)
    {
        $result = $this->repo->update($data['id'], $data['body']);

        return $result > 0 ? true : false;
    }
}
