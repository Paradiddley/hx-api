<?php
// Routes

$app->group('/user', function () use ($app) {
    $app->map(['GET', 'PATCH', 'DELETE'], '/{id:[0-9]+}', \API\Controllers\UserController::class);
    $app->post('', 'UserController');
});
