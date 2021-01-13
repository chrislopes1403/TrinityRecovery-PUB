<?php

namespace app\models;

abstract class BaseModel
{

    public function loadViewData($data)
    {
        foreach($data as $key=>$value)
        {
            if(property_exists($this,$key))
            {
                $this->{$key}=$value;
            }
        }

    }



    




}




?>