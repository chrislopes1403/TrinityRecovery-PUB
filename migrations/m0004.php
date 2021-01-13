<?php


class m0004
{
public function up()
{
   $db = \app\core\Application::$app->db;

   $SQL = "CREATE TABLE appointments ( 
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor VARCHAR(255) NOT NULL,
    client VARCHAR(255) NOT NULL,
    time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    duration VARCHAR(255) NOT NULL,
    msg VARCHAR(255) NOT NULL
    ) ENGINE=INNODB;";

    $db->pdo->exec($SQL);
  
}

public function down()
{
    $db = \app\core\Application::$app->db;
    $SQL = "DROP TABLE appointments";
    
        $db->pdo->exec($SQL);
}



}

?>