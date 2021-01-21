<?php

namespace app\models;
use app\core\Application;

class LoginModel extends RegisterModel
{

public string $email='';
public string $password='';

public function rules(): array
{

    return[
        'emai'=>[self::RULE_REQUIRED,self::RULE_RULE_EMAIL],
        'password'=>[self::RULE_REQUIRED]
    ];

}


public function login()
{
    $user=DBModel::findOne(['email'=>$this->email]);
    
  
    if(!$user)
    {
        $this->addErrorMessage('email','User does not exist');
        return false;
    }
    if(!password_verify($this->password,$user->password))
    {
   
        $this->addErrorMessage('passowrd','password is incorrect');
        return false;
    }

    
     return Application::$app->login($user);
}


}


?>