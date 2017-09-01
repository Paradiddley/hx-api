<?php

namespace API\Lib\Features;

use API\Repositories\Repository;
use Slim\Container;

abstract class Feature
{
    /** @var string|null $repoClass */
    protected $repoClass = null;

    /** @var Repository $repository */
    protected $repo;

    public function __construct(Container $container)
    {
        if (!is_null($this->repoClass) && class_exists($this->repoClass)) {
            $this->repo = $container[$this->repoClass];
        }
    }
}
