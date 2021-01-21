<?php


namespace app\models;

use app\models\DBModel;
use app\core\Application;


class ChatModel extends DBModel
{
    

public function attributes(): array{}
    
public function tableName(): string{}

public function primaryKey(): string{}

    public  function getChatRooms($id)
    {
        if(Application::$app->user->FindDoctor())
        {
            $doctor =true;
            $stmt =self::prepare("SELECT * FROM chatrooms WHERE doctorId = :id");
        }
        else
        {
            $doctor =false;
            $stmt =self::prepare("SELECT * FROM chatrooms WHERE clientId = :id");
        }
       
        $stmt->bindParam(':id', $id);
      
        
        try{
                $stmt->execute();
                $result = $stmt->fetchAll();
                //return $result;
                if(is_array($result) && count($result)>0)
                {
                    $result[]=$doctor;
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
            }
    }


    public function getSenderData($toUser)
    {
        $id=9;
        $statement=self::prepare("SELECT firstname,lastname,status,id FROM users WHERE id = :id");
        $statement->bindParam(':id', $toUser);
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


    
    public function pushMessage($id,$msg,$targetId,$twofrom,$senderName,$chatId)
    {
        $stmt = self::prepare(' INSERT INTO `chatrooms`(`id`, `chatId`, `doctorId`, `clientId`, `doctorName`, `clientName`, 
        `to/from`, `msg`, `created_on`)
         VALUES (null, :chatId, :doctorId, :clientId,:doctorName, :clientName,:twofrom, :msg, :created_on)');
       
       if(Application::$app->user->FindDoctor())
        {
            $doctor = $id;
            $client= $targetId;
            $doctorName = Application::$app->user->getLastName();
            $clientName = $senderName;
        }
        else
        {
            $doctor = $targetId;
            $client= $id;
            $clientName = Application::$app->user->getLastName();
            $doctorName = $senderName;
        }

        $date=date('Y-m-d h:i:s');

        $stmt->bindParam(':chatId', $chatId);
        $stmt->bindParam(':doctorId', $doctor);
        $stmt->bindParam(':clientId', $client);
        $stmt->bindParam(':doctorName', $doctorName);
        $stmt->bindParam(':clientName', $clientName);
        $stmt->bindParam(':twofrom', $twofrom);
        $stmt->bindParam(':msg', $msg);
        $stmt->bindParam(':created_on', $date);




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



    
    public function createNewChatroom($ClientName,$DoctorName)
    {


        $client=DBModel::findOne(['firstname'=>$ClientName]);
        $doctor=DBModel::findOne(['firstname'=>$DoctorName]);
        $statement=self::prepare("SELECT MAX(chatId) FROM chatrooms");
        try{
            $statement->execute();
            $result = $statement->fetchAll();
            if(is_array($result) && count($result)>0)
            {
                $result = array_values($result);
                $chatid = $result[0];
               $chatid=intval($chatid['0'])+1;

             $stmt = self::prepare(' INSERT INTO `chatrooms`(`id`, `chatId`, `doctorId`, `clientId`, `doctorName`, `clientName`, 
             `to/from`, `msg`, `created_on`)
              VALUES (null, :chatId, :doctorId, :clientId,:doctorName, :clientName,:twofrom, :msg, :created_on)');

            $twofrom=1;
            $date=date('Y-m-d h:i:s');
            $msg="New Chat!";
            $stmt->bindParam(':chatId', $chatid);
            $stmt->bindParam(':doctorId', $doctor->id);
            $stmt->bindParam(':clientId', $client->id);
            $stmt->bindParam(':doctorName', $doctor->lastname);
            $stmt->bindParam(':clientName', $client->lastname);
            $stmt->bindParam(':twofrom', $twofrom);
            $stmt->bindParam(':msg', $msg);
            $stmt->bindParam(':created_on', $date);


                    try {
                        if($stmt->execute()) {

                            $rst=[];

                            $rst[]=$doctor->id;
                            $rst[]=$client->id;
                            $rst[]=$chatid;
                            $rst[]=$msg;
                            $rst[]=$date;
                            $rst[]=$doctor->firstname;
                            $rst[]=$client->firstname;

                            return $rst;
                        } else {
                            return false;
                        }
                    } catch (Exception $e) {
                        echo $e->getMessage();
                    }

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













}













?>