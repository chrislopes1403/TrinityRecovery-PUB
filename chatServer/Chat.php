<?php
namespace app\chatServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;
    private $users;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->users = [];
        echo "Sever Stared.";
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";

    }

    public function onMessage(ConnectionInterface $conn, $msg)
    {
        $data = json_decode($msg);
        switch ($data->command)
         {
            case "setup":
                $this->users [$data->session] = $conn;
                echo "user" . $data->session ."set";
                break;
            case "message":
            
                if (isset($this->users[$data->target])) 
                {
                   
                    $this->users[$data->target]->send($data->message);
                    echo"message=>".$data->message;
                }
                else{echo"no message";}
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        unset($this->users[$data->session]);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}
?>