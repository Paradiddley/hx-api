<?php

namespace API\Lib\Helpers;

class Str
{
    public static function startsWith($haystack, $needle)
    {
        return substr_compare($haystack, $needle, 0, strlen($needle)) === 0;
    }

    public static function endsWith($haystack, $needle)
    {
        return substr_compare($haystack, $needle, -strlen($needle)) === 0;
    }
}
