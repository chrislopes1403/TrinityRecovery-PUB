<?php

// import namespace comes befor use
namespace app\controllers;

use app\core\BaseController;
use app\core\Request;
use app\models\RegisterModel;
use app\models\ChatModel;
use app\models\DBModel;

use app\models\MessageModel;
use app\core\Application;
use app\core\Response;
use app\models\LoginModel;
use app\core\middlewares\AuthMiddleware;
class AuthorizeController extends BaseController
{


    public function __construct()
    {
        //$this->registerMiddleware(new AuthMiddleware([])); restrict the whole controller;
        $this->registerMiddleware(new AuthMiddleware(['chat']));
        $this->registerMiddleware(new AuthMiddleware(['message']));
        $this->registerMiddleware(new AuthMiddleware(['doctor']));
        $this->registerMiddleware(new AuthMiddleware(['doctorAppointments']));
        //$this->registerMiddleware(new AuthMiddleware());
    }


    public function login(Request $request, Response $response)
    {
        $LoginModel= new LoginModel();
        if($request->isPost())
        {
            $LoginModel->loadViewData($request->getBody());
        
           
            if($LoginModel->login())
            { 
               if(Application::$app->user->FindDoctor())
               {
               $response->redirect('/doctor');
               return;
               }
            $response->redirect('/');
            return;
            }
         }
       // $this->setLayout('authorize');
        return $this->render('login');
        
    }

    public function register(Request $request)
    {
      //  $this->setLayout('authorize');
        $registerModel = new RegisterModel();

        if($request->IsPost())
        {

            $registerModel->loadViewData($request->getBody());

            if($registerModel->validate() && $registerModel->register())
            {
               Application::$app->session->setFlash('success','Thanks for registering');
               Application::$app->response->redirect('/');
            }

           return $this->render('register',['model'=>$registerModel]);
       
        }

        return $this->render('register',['model'=>$registerModel]);
    }


    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
    
    public function chat(Request $request, Response $response)
    {        

        return $this->render('chat');
    }

    public function message(Request $request, Response $response)
    {

        if($request->isGet())
        {

        $params= DBModel::getDoctorNames();
        return $this->render('message',$params);
        }
        
        if($request->isPost())
        {  
        $MessageModel = new MessageModel;

            if(($_POST['email']=="") || ($_POST['title']=="") || ($_POST['client']=="") || ($_POST['doctor']=="") || ($_POST['message']==""))
            {
                
                Application::$app->session->setFlash('success','Error Message not Sent!');
                $response->redirect('/contact/message');
                return;
            }
            else
            {
             $result=$MessageModel->sendMessage($_POST['email'],$_POST['title'],$_POST['client'],$_POST['doctor'],$_POST['message']);
            
                if($result)
                {
                    Application::$app->session->setFlash('success','Message Sent!');
                    $response->redirect('/');
                    return;
                }
                else
                {
                    Application::$app->session->setFlash('success','Error with Message!');
                    $response->redirect('/contact/message');
                    return;
                }

            }

        }
    }
    
    public function doctor(Request $request, Response $response)
    {

        return $this->render('doctor');
    }

    public function doctorAppointments(Request $request, Response $response)
    {
        return $this->render('doctorAppointments');
    }

    public function doctorMessage(Request $request, Response $response)
    {
        $MessageModel = new MessageModel;
        $lastname=Application::$app->user->getlastName();
        $params=[];
        $params=$MessageModel->getMessages($lastname);
        return $this->render('doctorMessage',$params);



      
    }

    public function getChats(Request $request, Response $response)
    {
        $ChatModel = new ChatModel();

       if($request->isPost())
        {
           $id= Application::$app->session->get('user');
           $result=$ChatModel->getChatRooms($id);
            $result[]=$id;
            echo json_encode($result);
           
            /*
           $SenderNames=[];

           foreach($result as $item)
           {
               if($id==$item['toUserId'])
                    $selectId = $item['fromUserId'];
                else
                    $selectId = $item['toUserId'];


               $SenderNames[]=$ChatModel->getSenderData($selectId);
           }
            $result[]=$SenderNames;
            $result[]=$id;

            echo json_encode($result);
           */
        }
    }
    
    public function sendChatMessage(Request $request, Response $response)
    {
        $ChatModel = new ChatModel();

       if($request->isPost())
        {
           $id= Application::$app->session->get('user');
           $result=$ChatModel->pushMessage($id,$_POST['msg'],$_POST['targetId'], $_POST['twofrom'],
           $_POST['senderName'],$_POST['chatId']);

           if($result)
           {
                echo json_encode(["status"=>true,"id"=>$id,"result"=>$result]);
           }
            else
            {
                echo json_encode(["status"=>false,"id"=>$id]);
            }

        }
    }



}




?>