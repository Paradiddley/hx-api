<?php

namespace Tests\Unit;

use Mockery;
use Slim\App;

class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    protected $container;

    public function setUp()
    {
        $app = new App();
        $this->container = $app->getContainer();
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
