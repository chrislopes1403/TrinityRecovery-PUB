<?php


class m0005
{
public function up()
{
   $db = \app\core\Application::$app->db;

   $SQL = "CREATE TABLE messages ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    client VARCHAR(255) NOT NULL,
    doctor VARCHAR(255) NOT NULL,
    msg VARCHAR(255) NOT NULL,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=INNODB;";

    $db->pdo->exec($SQL);
  
}

public function down()
{
    $db = \app\core\Application::$app->db;
    $SQL = "DROP TABLE messages";
    
        $db->pdo->exec($SQL);
}



}

?>