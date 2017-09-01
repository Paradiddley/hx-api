<?php

namespace API\Lib;

use API\Repositories\Repository;
use Slim\Container;

abstract class Feature
{
    /** @var Container $container */
    protected $container;

    /** @var string|null $repoClass */
    protected $repoClass = null;

    /** @var Repository $repository */
    protected $repo;

    public function __construct(Container $container)
    {
        $this->container = $container;

        if (!is_null($this->repoClass) && class_exists($this->repoClass)) {
            $this->repo = new $this->repoClass($container);
        }
    }
}
