<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// Load class dependencies
$paths = require $container->get('classloader');

// Classes to instantiate with container
$injectContainer = [
    'controllers',
    'repositories'
];

foreach ($paths as $path => $classes) {
    $inject = in_array($path, $injectContainer);
    foreach ($classes as $class) {
        if (class_exists($class)) {
            $container[$class] = function ($c) use ($class, $inject) {
                if ($inject) {
                    return new $class($c);
                } else {
                    return new $class;
                }
            };
        }
    }
};
