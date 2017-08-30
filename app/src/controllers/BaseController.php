<?php

namespace API\Controllers;

use API\Repositories\Repository;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseController implements ControllerInterface
{
    /** @var Request $request */
    private $request;

    /** @var Response $response */
    private $response;

    /** @var array $args */
    private $args;

    /** @var string|null $repoClass */
    protected $repoClass = null;

    /** @var Repository $repository */
    protected $repo;

    public function __construct(Container $container)
    {
        if (!is_null($this->repoClass) && class_exists($this->repoClass)) {
            $this->repo = new $this->repoClass($container);
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case 'request':
            case 'response':
            case 'args':
                return $this->$name;
        }
    }

    public function __invoke(Request $request, Response $response, array $arguments)
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $arguments;

        try {
            switch ($request->getMethod()) {
                case 'GET':
                    return $this->get();
                case 'POST':
                    return $this->post();
                case 'PATCH':
                    return $this->patch();
                case 'DELETE':
                    return $this->delete();
            }
        } catch (\Exception $e) {
            return $this->response(['error' => ['message' => $e->getMessage()]], 400);
        }
    }

    protected function response(array $data, $code = 200)
    {
        return $this->response->withJson($data, $code);
    }
}
