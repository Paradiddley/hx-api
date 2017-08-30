<?php
// Routes

$app->group('/api', function () use ($app) {
    require 'routes/user.php';
});
