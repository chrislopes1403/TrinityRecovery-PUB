<?php


namespace app\core\exceptions;

class NotFoundException extends \Exception
{

    protected $message='Not Found';
    protected $code=404;
}

?>