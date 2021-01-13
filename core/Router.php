<?php

namespace app\core;
use app\core\Application;
use app\core\exceptions\NotFoundException;
class Router
{
public Response $response;
public Request $request;
protected array $routes = [];
    



public function __construct(Request $request,Response $response)
{

$this->request= $request;
$this->response=$response;

}


    public function get($path,$callback)
    {
        $this->routes['get'][$path]=$callback;
    }


    public function post($path,$callback)
    {
        $this->routes['post'][$path]=$callback;
    }


    public function resolve()
    {
       $path= $this->request->getPath();
       $method= $this->request->Method();
       $callback= $this->routes[$method][$path] ?? false;
       if($callback===false)
       {
           //return $this->renderView("_404");
           throw new NotFoundException();
       }

       if(is_string($callback))
       {
           return $this->renderView($callback);
       }

       if(is_array($callback))
       {
           /*
           Application::$app->basecontroller = new $callback[0]();
           Application::$app->action = new $callback[1]();
           $callback[0] =  Application::$app->basecontroller;
           */
          $basecontroller= new $callback[0]();
          Application::$app->basecontroller=$basecontroller;
          $basecontroller->action=$callback[1];
          $callback[0]=$basecontroller;

          foreach($basecontroller->getMiddlewares() as $middleware)
          {
           // echo "post";

            $middleware->execute();
          }


       }
     
      return call_user_func($callback,$this->request,$this->response);


    }


    public function renderView($view,$params=[])
    {
        
        $layoutContent = $this->layoutContent();
        $viewContent=$this->rendorOnlyView($view,$params);
       return str_replace('{{Content}}',$viewContent,$layoutContent);
        //include_once Application::$ROOT_DIR."./../views/$view.php";
    
    
    }

    protected function layoutContent()
    {
        $layout= Application::$app->layout;
        if(Application::$app->basecontroller)
            $layout = Application::$app->basecontroller->layout;
        
        ob_start();
        include_once Application::$ROOT_DIR."./../views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function rendorOnlyView($view,$params)
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."./../views/$view.php";
        return ob_get_clean();
    }

}
?>