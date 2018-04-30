<?php
include_once "Conexion.php";
class Producto
{
    public $id;
    public $descripcion;
    public $imagen;
    public $precio;
    public $stock;
    public $cantidad;
    public $conexion;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function setCantidad($cantidad){
        $this->cantidad = $cantidad;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio = $precio;
    }

    public function getStock(){
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

    function addProducto(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if( $this->conexion){
            $sentencia = $this->conexion->prepare("INSERT INTO productos (decripcion,imagen,precio,stock,cantidad) VALUES (:descripcion,:imagen,:precio,:stock,0)");
            $sentencia->bindParam(':descripcion', $this->descripcion);
            $sentencia->bindParam(':imagen', $this->imagen);
            $sentencia->bindParam(':precio', $this->precio);
            $sentencia->bindParam(':stock', $this->stock);
            $sentencia->execute();
            return $sentencia;
        }

        $this->conexion =  $this->conexion->closeConnection();
    }

    function buscarProducto($id){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if($this->conexion){
            $sentencia = $this->conexion->prepare("SELECT * FROM `productos` WHERE `id`=:id");
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            return  $rows =  $sentencia->fetchAll(PDO::FETCH_ASSOC);
        }
        $this->conexion =  $this->conexion->closeConnection();
    }


    function updateProducto(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if($this->conexion){
            $sentencia = $this->conexion->prepare("UPDATE productos SET descripcion=:descripcion, imagen=:imagen,precio=:precio,stock=:stock WHERE id=:id");
            $sentencia->bindParam(':id', $this->id);
            $sentencia->bindParam(':descripcion', $this->descripcion);
            $sentencia->bindParam(':imagen', $this->imagen);
            $sentencia->bindParam(':precio', $this->precio);
            $sentencia->bindParam(':stock', $this->stock);
            $sentencia->execute();
            return $sentencia;
        }

        $this->conexion =  $this->conexion->closeConnection();

    }

    function deleteUsuario($id){
        $this->conexion = new Conexion();

        $this->conexion = $this->conexion->conectar();
        if($this->conexion){
            $sentencia = $this->conexion->prepare("DELETE FROM productos WHERE id=:id");
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            return $sentencia;
        }

        $this->conexion =  $this->conexion->closeConnection();

    }

    function listarProductos(){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if($this->conexion){
            $sentencia = $this->conexion->prepare("SELECT * FROM productos");
            $sentencia->execute();
            return  $rows =  $sentencia->fetchAll(PDO::FETCH_ASSOC);

        }
        $this->conexion =  $this->conexion->closeConnection();
    }

    
    function updateStock($stock,$id){
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conectar();
        if($this->conexion){
            $sentencia = $this->conexion->prepare("UPDATE productos SET stock=:stock WHERE id=:id");
            $sentencia->bindParam(':id', $id);    
            $sentencia->bindParam(':stock', $stock);
            $sentencia->execute();
            return $sentencia;
        }

        $this->conexion =  $this->conexion->closeConnection();

    }

}