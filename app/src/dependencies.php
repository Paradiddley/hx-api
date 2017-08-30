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

function loadFiles($name, &$container, $construct = false)
{
    $classes = include($container->get('classloader'));

    foreach ($classes[$name] as $class) {
        if (class_exists($class)) {
            $container[$class] = function ($c) use ($class, $construct) {
                if ($construct) {
                    return new $class($c);
                } else {
                    return new $class;
                }
            };
        }
    };
}

// load controllers
loadFiles('controllers', $container, true);

// load models
loadFiles('models', $container);
