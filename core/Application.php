<?php

//core component should not use any componet outside of core
namespace app\core;

//fix this
use app\core\BaseController;
use app\models\DBModel;
use app\models\RegisterModel;

class Application
{

public string $layout = 'main';
public ?RegisterModel $userClass;
public static string $ROOT_DIR;
public Router $router;
public Request $request;
public Response $response;
public Database $db;
public Session $session;
public static Application $app;
public ?DBModel  $user;

public ?BaseController $basecontroller=null;

    public function __construct($rootpath, array $config)
    {
        //$this->userClass=$config['userClass'];
        //$this->userClass=app\models\RegisterModel::class;
        $this->userClass=new registerModel();
        self::$ROOT_DIR=$rootpath;
        self::$app=$this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router( $this->request,$this->response );
        $this->db= new Database($config['db']);
        $this->session = new Session();

        $primaryValue=$this->session->get('user');

        if($primaryValue)
        {
        $primaryKey= $this->userClass->primaryKey();
        $this->user=$this->userClass->findOne([$primaryKey =>$primaryValue]);
        }else
        {
            $this->user=null;
        }
    }

    public function run()
    {
        try
        {
             echo $this->router->resolve();
        }catch(\Exception $e)
        {
            $this->response->setStatusCode( intval( $e->getCode() ) );
            echo $this->router->renderview('_error',[
                'exception'=> $e
            ]);
        }
    }

    public function getController()
    {
        return $this->basecontroller;
    }

    public function setController(BaseController $basecontroller)
    {
        $this->basecontroller=$basecontroller;
    }
   
    public function login( DBModel $user)
    {
        $this->user=$user;
        $primaryKey=$user->primaryKey();
        $primaryValue=$user->{$primaryKey};
        $this->session->set('user',$primaryValue);
        DBModel::loginUser($this->session->get('user'));
        return true;
    }

    public function logout()
    {
        DBModel::logoutUser($this->session->get('user'));
        $this->user=null;
        $this->session->remove('user');
    }

    public static function IsGuest()
    {
        return !self::$app->user;
    }
   
   

}
?>