<?php
// Routes

$app->group('/api', function () use ($app) {
    require 'Routes/user.php';
});
