<?php
namespace app\models;

use app\models\BaseModel;
use app\core\Application;


 abstract class DBModel extends BaseModel
{

    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;


    public function save()
    {

        $tableName= $this->tableName();
        $attributes=$this->attributes();
        $params= array_map(fn($attr)=> ":$attr", $attributes);
        $statement= self::prepare("INSERT INTO $tableName (".implode(',', $attributes).")
        VAlUES(".implode(',', $params).")");

        foreach($attributes as $attribute)
        {
            $statement->bindValue(":$attribute",$this->{$attribute});
        }

        $statement->execute();


        
        return true;
       
    }


    public static  function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql); 
    }


    public function findOne($where)
    {
        $tableName='users';
        $attributes=array_keys($where);
        $sql = implode("AND ",array_map(fn($attr) => "$attr = :$attr",$attributes));
        $statement=self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach($where as $key =>$item)
        {
            $statement->bindValue(":$key",$item);
        }
        $statement->execute();
       
        return $statement->fetchObject(static::class);
    }


    public static function FindADoctor($firstname)
    {
        $tableName='users';
        $two = 2;
        $zero = 0;  

        $statement=self::prepare("SELECT * FROM $tableName WHERE firstname = :firstname AND status % :value = :value2");
        $statement->bindValue(":firstname",$firstname);
        $statement->bindValue(":value",$two);
        $statement->bindValue(":value2",$zero);
        try{
        $statement->execute();
            $result = $statement->fetchAll();
            if(is_array($result) && count($result)>0)
            {
             return  true;
            }
            else
            {
             return false;
            }
         
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }


    public static function FindAClient($firstname)
    {
        $tableName='users';
        $two = 2;
        $zero = 0;  

        $statement=self::prepare("SELECT firstname, id ,lastname FROM $tableName WHERE firstname = :firstname AND status % :value != :value2");
        $statement->bindValue(":firstname",$firstname);
        $statement->bindValue(":value",$two);
        $statement->bindValue(":value2",$zero);
        try{
        $statement->execute();
            $result = $statement->fetchAll();
            if(is_array($result) && count($result)>0)
            {
             return  true;
            }
            else
            {
                return false;
            }
         
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public static function getDoctorNames()
    {
        $tableName='users';
        $two = 2;
        $zero = 0;  

        $statement=self::prepare("SELECT firstname, lastname FROM $tableName WHERE  status % :value = :value2");
        $statement->bindValue(":value",$two);
        $statement->bindValue(":value2",$zero);
        try{
        $statement->execute();
            $result = $statement->fetchAll();
            if(is_array($result) && count($result)>0)
            {
             return  $result;
            }
            else
            {
                return false;
            }
         
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }


    public static function getClientNames()
    {
        $tableName='users';
        $two = 2;
        $zero = 0;  

        $statement=self::prepare("SELECT firstname,lastname FROM $tableName WHERE  status % :value != :value2");
        $statement->bindValue(":value",$two);
        $statement->bindValue(":value2",$zero);
        try{
        $statement->execute();
            $result = $statement->fetchAll();
            if(is_array($result) && count($result)>0)
            {
             return  $result;
            }
            else
            {
                return false;
            }
         
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
        }
    }

    public static function logoutUser($id)
    {
        $stmt =self::prepare("UPDATE users SET status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $zero =0;
        $one =1;
        if(Application::$app->user->FindDoctor())
        {
            $select=$zero;
        }
        else
        {
            $select=$one;
        }
       
        $stmt->bindParam(':status', $select);

            try {
                if($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    }
    public static function loginUser($id)
    {
        $stmt =self::prepare("UPDATE users SET status = :status WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $three = 3;
        $two = 2;
        if(Application::$app->user->FindDoctor())
        {
            $select=$two;
        }
        else
        {
            $select=$three;
        }
       
        $stmt->bindParam(':status', $select);

            try {
                if($stmt->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    }




}




?>