<?php

namespace Tests\Functional;

class TestListener extends \PHPUnit_Framework_BaseTestListener
{
    public static $wasCalled = false;

    public function startTestSuite(\PHPUnit_Framework_TestSuite $suite)
    {
        // Boot Eloquent
        require __DIR__ . '/../../config/capsule.php';

        if (!self::$wasCalled) {
            exec('php ' . __DIR__ . '/../../novice migrate', $out);
            exec('php ' . __DIR__ . '/../../novice seed', $out);
            self::$wasCalled = true;
        }
    }
}
