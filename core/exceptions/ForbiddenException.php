<?php

namespace app\core\exceptions;


// base php class
class ForbiddenException extends \Exception
{

    protected $message='User UnAuthorized';
    protected $code=403;

}


?>