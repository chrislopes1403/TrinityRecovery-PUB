<?php

namespace app\core\middlewares;
use app\core\middlewares\BaseMiddleare;
use app\core\Application;
use app\core\exceptions\ForbiddenException;
class AuthMiddleware extends BaseMiddleware
{

public array $actions = [];


public function __construct(array $actions =[])
{      
    $this->actions =$actions;
}


public function execute()
{
    if(Application::IsGuest())
    {
        if(empty($this->actions) ||in_array(Application::$app->basecontroller->action,$this->actions))
        {
            throw new ForbiddenException();
        }
    }
}


}



?>