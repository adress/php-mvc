<?php declare(strict_types=1);

namespace App\Services\Helper;

class Helper
{
    public function uri_remove_first($uri){
        $uri_arr = explode("/", $uri);
        unset($uri_arr[0], $uri_arr[1]);
        $uri = "/" . implode("/", $uri_arr);
        return $uri;
    }
}