<?php

declare(strict_types=1);

class Helper
{
    public static function uri_remove_first($uri)
    {
        $uri_arr = explode("/", $uri);
        unset($uri_arr[0], $uri_arr[1]);
        $uri = "/" . implode("/", $uri_arr);
        return $uri;
    }

    public static function asset($uri)
    {
        return self::join_paths('/', $_ENV['BASE_DIR'], $uri);
    }

    public static function join_paths()
    {
        $paths = array();
        foreach (func_get_args() as $arg) {
            if ($arg !== '') {
                $paths[] = $arg;
            }
        }
        return preg_replace('#/+#', '/', join('/', $paths));
    }
}
