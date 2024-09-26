<?php
namespace App;

use App\Route;


class Router {
    public static $routes = [];
    public $path;
    public $method;
    public function __construct($path, $method)
    {   
        $this->path = parse_url($path, PHP_URL_PATH);
        $this->method = $method;
    }

    public function match(){
        foreach(self::$routes as $route){
            // Use regex to match the path, allowing for dynamic segments
            $pattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $route->path);
            if (preg_match("#^$pattern$#", $this->path, $matches)) {
                array_shift($matches); // Remove the full match
                return (object) [
                    'action' => $route->action,
                    'params' => $matches // Pass the parameters
                ];
            }
        }
        return false;
    }
    
    

    public static function addRoute($method, $path, $action){
        self::$routes[] = new Route($method, $path, $action);
    }
}