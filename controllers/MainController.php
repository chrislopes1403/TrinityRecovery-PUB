<?php


namespace app\controllers;

use app\core\BaseController;
use app\core\Application;
use app\core\Request;
use app\models\AppointmentModel;
use app\core\Response;

class MainController extends BaseController
{


   
    public function home()
    {   
     
        $params=[];
        return $this->render('home',$params);
    }
    public function pricing()
    {
        $params=[];
        return $this->render('pricing',$params);
    }
    public function appointment(Request $request, Response $response)
    {
        $params=[];     

        return $this->render('appointment',$params);
    }
    public function contact()
    { 
        $params=[];
        return $this->render('contact',$params);
    
    }
    public function chat()
    {
        $params=[];
        return $this->render('chat',$params);
    }
    public function message(Request $request, Response $response)
    {
        $params=[];
        return $this->render('message',$params);
       
    }
    public function booking(Request $request, Response $response)
    {
        $params=$request->getBody();     
        return $this->render('booking',$params);
    }
    public function login()
    {
        $params=[];
        return $this->render('login',$params);
    }

    public function addAppointment(Request $request, Response $response)
    {
        if($request->isPost())
        {
        
            $AppointmentModel = new AppointmentModel();
            $result=$AppointmentModel->addAppointment($_POST['client'],$_POST['time'],
            $_POST['duration'],$_POST['doctor'],$_POST['msg']);
           echo json_encode(["result"=>$result]);
           Application::$app->session->setFlash('success','Appointment Set!');
        }
    }

    public function getAppointmentTimes(Request $request, Response $response)
    {
        echo "calling....";
        if($request->isPost())
        {
            $AppointmentModel = new AppointmentModel();
            $result=$AppointmentModel->getAppointmentTimes();
            echo json_encode(["result"=>1]);


           
        }
    }
   


/*
    public function contact()
    {       
        $params=['name' => "Chris"];
        return $this->render('contact',$params);
    }

    
    public function handleContact(Request $request)
    {
        $body=$request->getBody();

        echo '<pre>';
        var_dump($body);
        echo '<pre>';
        exit;

        return 'handle contact data';
    }
    */
}


?>