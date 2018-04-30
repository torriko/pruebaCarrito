<?php
require_once "Producto.php";
class Carrito
{

    public $productoscarrito = array();

    public function __construct()
    {
    }

    public function add($producto){
        $existe=false;
     
        array_filter($this->productoscarrito);
        for ( $i = 0; $i < count($this->productoscarrito); $i++) {
            if ( $producto["id"] == $this->productoscarrito[$i]["id"]) {
                $existe=true;
                if( $this->productoscarrito[$i]["stock"]>0){
                    $this->productoscarrito[$i]["cantidad"]++;
                    $this->productoscarrito[$i]["stock"]--;
                }
           
            }
        }
      
        if (!$existe) {
            
            $compra = array (
                "id" => $producto["id"],
                "descripcion" => $producto['descripcion'],
                "cantidad" => 1,
                "precio" => $producto['precio'],
                "stock" => $producto['stock']-1
            );
            $this->productoscarrito[] = $compra;
        }
        
        $_SESSION['carrito'] = $this->productoscarrito; 

    }

    public function unidades(){
        $unidades = 0;
        foreach ($this->productoscarrito as $value){
            $unidades += value['cantidad'];
        }

        return $unidades;
    }

    public function remove($producto){

        if(!empty($this->productos)){

        foreach ($this->productos as $value){
            if($value['id'] == $producto->getId()){
                if($value['cantidad'] > 0){
                    $value['cantidad']--;
                }else {
                unset($this->productoscarrito[$producto]);
                }

            } else {
                $this->productoscarrito[] = $producto;
            }
        }
    }

}

}