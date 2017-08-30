<?php

namespace API\Controllers;

interface ControllerInterface
{
    public function get();

    public function post();

    public function patch();

    public function delete();
}