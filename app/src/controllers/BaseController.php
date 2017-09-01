<?php

namespace API\Controllers;

use API\Validation\Validator;
use API\Validation\ValidatorException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseController implements ControllerInterface
{
    /** @var Request $request */
    protected $request;

    /** @var Response $response */
    protected $response;

    /** @var array $args */
    protected $args;

    /** @var array $params */
    protected $params;

    /** @var array $body */
    protected $body;

    /** @var Container $container */
    protected $container;

    /** @var Validator|null $validation */
    protected $validation = null;

    /**
     * BaseController constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Magic method that runs validation and resolves route
     * via request method
     *
     * @param Request $request
     * @param Response $response
     * @param array $arguments
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $arguments)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->args     = $arguments;
        $this->params   = $request->getParams();
        $this->body     = $request->getParsedBody();

        try {
            if (!is_null($this->validation) && !is_null($this->body)) {
                $validation = new $this->validation($this->body);
                $validation->validate();
            }

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
        } catch (ValidatorException $e) {
            return $this->respond(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return $this->respond(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * @param array|bool $data
     * @param int $code
     * @return Response
     */
    protected function respond($data, $code = 200)
    {
        $data = is_bool($data) ? ['success' => $data] : $data;

        $responseBody = $this->response->getBody();
        $responseBody->write(json_encode($data));

        $response = $this->response;
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code)
            ->withBody($responseBody);
    }
}
