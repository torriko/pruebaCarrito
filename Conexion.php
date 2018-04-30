<?php


class Conexion
{

    const USERNAME="root";
    const PASSWORD="";
    const HOST="localhost";
    const DB="dwes";

    private $pdo;


    public function conectar(){

        try {

            $username = self::USERNAME;
            $password = self::PASSWORD;
            $host = self::HOST;
            $db = self::DB;

            $this->pdo = new PDO("mysql:dbname=$db;host=$host", $username, $password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->pdo->exec("SET CHARACTER SET UTF8");

            return $this->pdo;

        }catch(Exception $e){
            return null;
            die('Error'. $e->getMessage());
            echo "Linea del error". $e->getLine();
        }

    }

    public function closeConnection()
    {
          $this->pdo = null;
    }
}