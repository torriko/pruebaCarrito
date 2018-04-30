<?php
include_once ("Conexion.php");
// Clase Usuario
class Usuario
{
  // Variables de la Base de la Tabla
    public $id;
    public $nombre;
    public $password;
  
  // Variable de Conexion   
    public $conexion;

//Constructor
    public function __construct($usuario,$password)
    {
        $this->nombre = $usuario;
        $this->password= $password;
    }

    // Metodos Set and Get 

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    // Metodo para insertar un nuevo Usuario , s

    function addUsuario(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if( $this->conexion){
            $sentencia = $this->conexion->prepare("INSERT INTO usuarios (usuario,password) VALUES (:nombre,:password)");
            $sentencia->bindParam(':nombre', $this->nombre);
            $sentencia->bindParam(':password', $this->password);
            $sentencia->execute();
            return $sentencia;
        }
        // Cierra la conexion
        $this->conexion =  $this->conexion->closeConnection();
    }

    // Metodo para buscar un usuario por su nombre y password (es para validar)

    function buscarUsuario(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if($this->conexion){
            $sentencia = $this->conexion->prepare("SELECT * FROM `usuarios` WHERE `usuario`=:nombre AND `password`=:password");
            $sentencia->bindParam(':nombre', $this->nombre);
            $sentencia->bindParam(':password', $this->password);
            $sentencia->execute();
            return  $rows =  $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
        $this->conexion =  $this->conexion->closeConnection();
    }

// Muetra todos los usuarios y devuelve un array

    function listarUsuarios(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if($this->conexion){
            $sentencia = $this->conexion->prepare("SELECT * FROM usuarios");
            $sentencia->execute();
            return  $rows =  $sentencia->fetchAll(PDO::FETCH_ASSOC);

        }
        $this->conexion =  $this->conexion->closeConnection();
    }

}