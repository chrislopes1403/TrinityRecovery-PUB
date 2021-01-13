<?php


namespace app\models;

use app\models\DBModel;
use app\core\Application;


class RegisterModel extends DBModel
{

public string $firstname,$lastname,$email,$password,$confirmPassword;


const STATUS_INACTIVE=1;
const STATUS_ACTIVE=3;
const STATUS_ACTIVE_DOCTOR=2;
const STATUS_INACTIVE_DOCTOR=0;
const STATUS_DELETED=4;


public const RULE_REQUIRED = 'required';
public const RULE_EMAIL = 'email';
public const RULE_MAX = 'max';
public const RULE_MIN = 'min';
public const RULE_MATCH = 'match';
public const RULE_UNIQUE = 'unique';


public int $status = self::STATUS_ACTIVE;


public array $errors=[];


public function tableName(): string
{

    return 'users';
}

public function primaryKey(): string
{
    return 'id';
}






public function rules() :array
{

    return [
        'firstname' => [self::RULE_REQUIRED],
        'lastname' => [self::RULE_REQUIRED],
        'email' => [self::RULE_REQUIRED,self::RULE_EMAIL,
        [
            self::RULE_UNIQUE, 'class'=> self::class
        ]
    ],
        'password' => [self::RULE_REQUIRED , [self::RULE_MIN, 'min' => 8],[self::RULE_MAX, 'max' => 24]],
        'confirmPassword' => [self::RULE_REQUIRED,[self::RULE_MATCH, 'match' => 'password']]

    ];
}


public function validate()
{
    foreach($this->rules() as $attribute => $rules)
    {
        $value = $this-> {$attribute};
        foreach($rules as $rule)
        {
            $ruleName=$rule;
            if(!is_string($ruleName))
            {
                $ruleName=$rule[0];
            }
            if($ruleName === self::RULE_REQUIRED && !$value)
            {
                $this->addError($attribute,self::RULE_REQUIRED);
            }
            if($ruleName === self::RULE_EMAIL && !filter_var($value,FILTER_VALIDATE_EMAIL))
            {
                $this->addError($attribute,self::RULE_EMAIL);
            }
            if($ruleName === self::RULE_MIN  && strlen($value) < $rule['min'])
            {
                $this->addError($attribute,self::RULE_MIN,$rule);
            }
            if($ruleName === self::RULE_MAX  && strlen($value) > $rule['max'])
            {
                $this->addError($attribute,self::RULE_MAX,$rule);
            }
            if($ruleName === self::RULE_MATCH  && $value !== $this->{$rule['match']})
            {
                $this->addError($attribute,self::RULE_MATCH,$rule);
            }
            if($ruleName === self::RULE_UNIQUE)
            {
                $className = $rule['class'];
                $uniqueAttr = $rule['attribute'] ?? $attribute;
                $tableName = $className::tableName();
                $statement=Application::$app->db->prepare("SELECT* FROM $tableName WHERE $uniqueAttr = :attr");
                $statement->bindValue(":attr",$value);
                $statement->execute();
                $record=$statement->fetchObject();
                if($record)
                {
                $this->addError($attribute,self::RULE_UNIQUE,$rule);
                }
            }
        }
    }
    //print_r($this->errors);
    return empty($this->errors);
  // return true;

}





public function addError(string $attribute, string $rule, $params=[] )
{
    $message=$this->errorMessages()[$rule] ?? '';

    foreach($params as $key => $value)
    {
    $message = str_replace("{{$key}}",$value,$message); 
    }

    $this->errors[$attribute][]= $message;

}


public function addErrorMessage(string $attribute, string $message )
{

    $this->errors[$attribute][]= $message;

}









public function errorMessages()
{
    return [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'This feild must be a valid email address',
        self::RULE_MIN => 'Min length of this field must be {min}',
        self::RULE_MAX => 'Max length of this field must be {max}',
        self::RULE_MATCH => 'This field must be the same as {match}',
        self::RULE_UNIQUE => 'This field must be unqiue email'               
    ];
}

public function hasError($attribute)
{ 
    echo "error";
    return $this->errors[$attribute] ?? false;
}


public function register()
{
    $this->password=password_hash($this->password,PASSWORD_DEFAULT);
   return parent::save(); 
}

public function attributes():array
{
    return ['firstname','lastname','email', 'password','status'];
}

public function getUserName() : string
{

    $first= $this->firstname;
    $last= $this->lastname;
    return $this->firstname. ' '.$this->lastname;

}

public function getFristname() : string
{

    return $this->firstname;
}

public function getLastname() : string
{

    return $this->lastname;
}


public function FindDoctor() : string
{

    return $this->FindADoctor($this->firstname);
}



}



?>