<?php


namespace app\models;

use app\models\DBModel;
use app\core\Application;


class MessageModel extends DBModel
{
    

public function attributes(): array{}
    
public function tableName(): string{}

public function primaryKey(): string{}


public  function sendMessage($email,$title,$client,$doctor,$msg)
    {
        $date=date('Y-m-d h:i:s');
        $stmt = self::prepare('INSERT INTO `messages`(`id`, `email`, `title`, `client`, `doctor`, `msg`, `time`) VALUES (null,:email,:title,:client,:doctor,:msg,:created_on)');
        $stmt->bindParam(':created_on', $date);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':client', $client);
        $stmt->bindParam(':doctor', $doctor);
        $stmt->bindParam(':msg', $msg);


        try{
                if($stmt->execute())
                {
                    return true;
                }
                else
                {
                    return false;
                }      
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
                echo("<script>console.log('PHP:".$e->getMessage()."');</script>");
            }
    }
    

    
public  function getMessages($doctor)
{
    $stmt =self::prepare("SELECT * FROM messages WHERE doctor = :doctor");
    $stmt->bindParam(':doctor', $doctor);
  
        try{
            $stmt->execute();
            $result = $stmt->fetchAll();
            if(is_array($result) && count($result)>0)
            {
                return $result;
            }
            else
            {
                return false;
            }      
        } 
        catch (Exception $e) 
        {
            echo $e->getMessage();
            echo("<script>console.log('PHP:".$e->getMessage()."');</script>");
        }
}




}


?>