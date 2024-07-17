<?php

namespace App\Helpers;

use App\Models\User;
use Config;
use Illuminate\Support\Facades\Route;

class UtilityHelper
{
    public static function format($string)
    {
        return ucwords(str_replace("-", " ", $string));
    }

    public static function getModel()
    {
        // Get the current route action
        $action = Route::currentRouteAction();


        // Extract the controller class name
        list($controller, $method) = explode('@', $action);

        // Get the controller class name without the namespace
        $controllerClassName = class_basename($controller);

        return str_replace('Controller', '', $controllerClassName);
    }

    public static function getMimes()
    {
        return 'mimes:webp,jfif,avif,jpg,png,jpeg,gif,bmp|max:4096';
    }
}
