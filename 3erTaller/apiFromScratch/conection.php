<?php

class dataBase
{

    public $servername = "";
    public $username = "";
    public $password = "";
    public $database = "";


    public function conectar($server, $user, $pass, $db)
    {
        $this->servername = $server;
        $this->username = $user;
        $this->password = $pass;
        $this->database = $db;

        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully"; 
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }




    }


}



?>