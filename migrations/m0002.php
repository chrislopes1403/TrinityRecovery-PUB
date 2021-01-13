<?php


class m0002
{
public function up()
{
   $db = \app\core\Application::$app->db;

   $SQL = "CREATE TABLE chatrooms ( 
   id INT AUTO_INCREMENT PRIMARY KEY,
   chatId INT NOT NULL,
   doctorId INT NOT NULL,
   clientId INT NOT NULL,
   doctorName VARCHAR(255) NOT NULL,
   clientName VARCHAR(255) NOT NULL,
   msg VARCHAR(255) NOT NULL,
   created_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;";

    $db->pdo->exec($SQL);
  
}

public function down()
{
    $db = \app\core\Application::$app->db;
    $SQL = "DROP TABLE chatrooms";
    
        $db->pdo->exec($SQL);
}



}

?>