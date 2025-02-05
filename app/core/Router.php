<?php
class Router
{

    private $routes = [];

    public function route($uri, $filePath, $class = null, $method = null)
    {
        $this->routes[] = [
            "uri" => $uri,
            "path" => $filePath,
            "class" => $class,
            "method" => $method,
        ];
    }

    public function dispatch($uri)
    {
        $this->messagesHandler();
        foreach ($this->routes as $route) {
            $pattern =  preg_replace("#{\w+}#", "([^/]+)", $route["uri"]);
            if (preg_match("#^$pattern$#", $uri, $matches)) {
                if (!is_null($route["class"])) {
                    $instance = $route["class"];
                    $method = $route["method"];
                    call_user_func_array([$instance, $method], [isset($matches[1]) ? $matches[1] : ""]);
                    return;
                }
                include __DIR__ . "/../app/{$route["path"]}";
                return;
            }
        }
        include __DIR__ . "/../app/views/404.view.php";
    }


}