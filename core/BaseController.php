<?php

namespace app\core;
use app\core\Application;
use app\core\middlewares\BaseMiddleware;

class BaseController
{
    public string $layout='main';
    public string $action='';

    public array $middlewares =[];

    public function setLayout($layout)
    {

        $this->layout=$layout;

    }

    public function render($view,$params=[])
    {
        return Application::$app->router->renderView($view,$params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[]=$middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }


}


?>