<?php

namespace app\core;


class Request
{

    public function getPath()
    {
        $path= $_SERVER['REQUEST_URI'] ?? '/';
        $position=strpos($path,'?');
        if($position===false)
        {
            return $path;
        }
        //sub string all the way up to ?
        return substr($path,0,$position);
    }

    public function Method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);

    }
    public function IsGet()
    {
        return ($this->Method() ==='get');
    }

    public function IsPost()
    {
        return ($this->Method() ==='post');
    }
    public function getBody()
    {
        $body=[];
        
        if($this->IsGet())
        {
            foreach($_GET as $key=>$value)
            {
               $body[$key]= filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);

            }
        }

           
        if($this->IsPost())
        {
            foreach($_POST as $key=>$value)
            {
               $body[$key]= filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
               
            }
        }

        return $body;
    }

}


?>