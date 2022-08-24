<?php

namespace DevSajid\Permission\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

trait GetRoutesName
{

    public function getAllRouteNameAsArray()
    {
        $routes = Route::getRoutes();

        foreach ($routes as $key => $route) {

            if (isset($route->action)) {
                $action = $route->action;
                if (isset($action['as']) && !empty($action['prefix'] && Str::startsWith($action['as'], 'app'))) {
                    $permission = explode('.', substr($action['as'], 4));

                    if (array_key_exists(1, $permission)) {
                        $data[$permission[0]][] = $permission[1];
                    }
                }
            }
        }

        if (!empty($data)) {
            return $data;
        }
    }
}
