<?php

$app->group('/user', function () use ($app) {
    $app->get('[/{id:[0-9]+}]', \API\Controllers\UserController::class);
    $app->map(['PATCH', 'DELETE'], '/{id:[0-9]+}', \API\Controllers\UserController::class);
    $app->post('/search', \API\Controllers\UserController::class);
    $app->post('/new', \API\Controllers\UserController::class);
});
