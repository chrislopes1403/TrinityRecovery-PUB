<?php


class m0003
{
public function up()
{
   $db = \app\core\Application::$app->db;

   $SQL = "CREATE TABLE chats ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
   toUserId INT NOT NULL,
   fromUserId INT NOT NULL,
   chatId INT NOT NULL
    ) ENGINE=INNODB;";

   // $db->pdo->exec($SQL);
  
}

public function down()
{
    $db = \app\core\Application::$app->db;
    $SQL = "DROP TABLE chats";
    
        $db->pdo->exec($SQL);
}



}

?>