<?php
function route(string $uri) {
    $routes = require __DIR__ . '/routes.php';

    $uri = parse_url($uri, PHP_URL_PATH);

    if (isset($routes[$uri])) {
        [$controllerClass, $method] = $routes[$uri];
        $controller = new $controllerClass();

        if (method_exists($controller, $method)) {
            $controller->$method();
        } else {
            http_response_code(500);
            echo "Metoda $method nie istnieje.";
        }
    } else {
        http_response_code(404);
        echo "404 Nie znaleziono strony.";
    }
}
