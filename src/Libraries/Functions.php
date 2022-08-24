<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

use function PHPUnit\Framework\returnSelf;

function getAllRouteNameAsArray()
{
    $routes = Route::getRoutes();

    $data = [];
    foreach ($routes as $key => $route) {

        if(isset($route->action))
        {
            $action = $route->action;
            if(isset($action['as']) && !empty($action['prefix']  && Str::startsWith($action['as'], 'app')))
            {
                    $permission = explode('.', substr($action['as'], 4));

                    $arrKey = count($permission);
                    switch ($arrKey) {
                        case "0":
                          echo "Your favorite color is red!";
                          break;
                        case "1":
                          break;
                        case "2":
                            $data[$permission[0]][] = $permission[1];
                          break;
                        case "3":
                            $data[$permission[0]][] = $permission[1].'.'.$permission[2];
                          break;
                        case "4":
                            $data[$permission[0]][] = $permission[1].'.'.$permission[2].'.'.$permission[3];
                          break;
                        default:
                
                      }
            }
        }


    }

    if (!empty($data)) {
        
        return $data;
    }
}






function getAllRouteNames()
{
    $routes = Route::getRoutes();

    foreach ($routes as $key => $route) {

        if(isset($route->action))
        {
            $action = $route->action;
            if(isset($action['as']) && !empty($action['prefix'] && Str::startsWith($action['as'], 'app')))
            {
                $permission = explode('.', substr($action['as'], 4));

                if (array_key_exists(1, $permission)){
                    $data[] = substr($action['as'], 4);
                }
            }
        }
    }

    if (!empty($data)) {
        return $data;
    }
}
