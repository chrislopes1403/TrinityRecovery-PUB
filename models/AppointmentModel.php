<?php


namespace app\models;

use app\models\DBModel;
use app\core\Application;


class AppointmentModel extends DBModel
{
    

public function attributes(): array{}
    
public function tableName(): string{}

public function primaryKey(): string{}


public  function addAppointment($client,$time,$duration,$doctor,$msg)
    {
       $time=date($time);
        $stmt =self::prepare("SELECT * FROM appointments WHERE time = :time");
        $stmt->bindParam(':time', $time);

        try{
                $stmt->execute();
                $result = $stmt->fetchAll();
                if(is_array($result) && count($result)>0)
                {
                    return false;
                }
                else
                {

                    $statement =self::prepare("INSERT INTO `appointments`(`id`, `doctor`, `client`, `time`,`duration`, `msg`) VALUES (null, :doctor, :client, :time, :duration, :msg)");
                    $statement->bindParam(':doctor', $doctor);
                    $statement->bindParam(':client', $client);
                    $statement->bindParam(':time', $time);
                    $statement->bindParam(':duration', $duration);
                    $statement->bindParam(':msg', $msg);
          
                    try{
                        if( $statement->execute())
                        {
                            return 1;
                        }
                        else
                        {        
                          return 2;
                        }         
                    } 
                    catch (Exception $e) 
                    {
                        echo $e->getMessage();
                    }        
                }      
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
            }
    }
    

    public  function getAppointmentTimes()
    {
      
        $stmt =self::prepare("SELECT time,duration FROM appointments");
        $stmt->bindParam(':time', $time);

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
            }
    }
    


    public  function getAppointments()
    {
        $doctor=Application::$app->user->getLastName();
        $stmt =self::prepare("SELECT * FROM appointments WHERE doctor = :doctor");
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
                    return $doctor;
                }      
            } 
            catch (Exception $e) 
            {
                echo $e->getMessage();
            }
    }











}


?>