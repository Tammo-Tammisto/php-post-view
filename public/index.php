<?php

if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}

spl_autoload_register(function($class){
    $class=substr($class, 4);
    require_once __DIR__ . "/../src/$class.php";
});

require __DIR__ . '/../helpers.php';
require __DIR__ . '/../routes.php';

$router = new App\Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$match = $router->match();

if ($match) {
    // Check if the matched action is callable
    if (is_callable($match->action)) {
        call_user_func($match->action); // For any closure or callable
    } elseif (is_array($match->action) && count($match->action) === 2) {
        $class = $match->action[0];
        $controller = new $class();
        $method = $match->action[1];
        
        // Call the controller method with parameters, if any
        if (!empty($match->params)) {
            call_user_func_array([$controller, $method], $match->params);
        } else {
            $controller->$method(); // Call without parameters
        }
    } else {
        echo 'Invalid route definition';
    }
} else {
    http_response_code(404);
    echo '404 Not Found';
}
