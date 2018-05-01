<?php
require_once "Carrito.php";
require_once "Producto.php";
class VistaCarrito
{
    public $producto;
    public $carrito;
// Esta variable contiene la cabecera
    public $cabecera=
        "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Lista producto Carrito Valido</title>
            <link rel='stylesheet' href='estilos/estilocatalogo.css'>
        </head>";

// menu superior del Listado del Carrito sin confirmar con los botones catalogo y salir

    public $contenido=
        "<body>
        <div id='contenedor'>
            <header>
       
                <a href='?pagina=inicio'><button class='boton'>Salir</button></a>
                <a href='?pagina=catalogo'><button class='boton'>Listado</button></a>
        ";

// menu inferior con los botones confirmar y anular
        public $finContenido=" 
                <form  method='post'> 
                    <input type='submit' class='boton' name='confirmar' value='Confirmar'>  
                                             
                    <input type='submit' class='boton' name='anular' value='anular'>
                </form>
            </div>
        </div>
        </body>
        </html>";

// Contenido para carro completado
    public $contenido1=
        "<body>
        <div id='contenedor'>
            <header>
            
         <a href='?pagina=inicio'><button class='boton'>Salir</button></a>
            
        ";

    public $finContenido1=" 

            </div>
        </div>
        </body>
        </html>";


// Cuerpo de la página
// $fin indica si el carro ha sido o no completado
    function carrito($fin){
        $productos = $_SESSION['carrito'];  // Listado de articulos del carro
        $total=0; // Importe total de carro

        echo '<h2>Usuario: '.$_SESSION['usuario'].'</h2>';
        echo '</header>';
        echo "<div id='contenido'>";
        echo '<form  method="post">';
        echo '<table>';
        echo '<tr><th colspan="5"><h2>Carro de Productos</h2></th></tr>';
        echo '<tr><th>Descripcion</th><th>Unidades</th><th>Precio</th><th>Importe</th><th></th></tr>';
        // Bucle para listar los articulos
       
        foreach ($productos as $valor ) {
            echo '<tr><td>'.$valor["descripcion"].'</td>';
            echo '<td>'.$valor["cantidad"].'</td>';
            echo '<td>'.$valor["precio"].'</td>';
            $importe = $valor["cantidad"]*$valor["precio"];
            echo '<td>'.$importe.'€ </td>';
            // texto dependiendo de cantidad del mismo articulo
            if ($valor["cantidad"]>1) $texborrar="Quitar Uno";
            else $texborrar="Borrar";
            // Muestra el boton de borrar solo si esta sin confirmar el carrito
            if ( $fin ) {
                echo '<td></td></tr>';
                $total += $importe;
            }
            else echo '<td><input type="submit" class="boton" name="'.$valor["id"].'" value="'.$texborrar.'"></td></tr>';
        }
        echo '</table></br>';
        echo '</form>';
        if ($fin) {
            echo "<br/>";
            echo "<h2> Importe carrito ".$total."€ </h2>";

        }

    }
    function display($fin){
        echo $this->cabecera;
        $error = false;
        if ($fin) { // Carrito confirmado
            echo $this->contenido1;
            echo $this->carrito($fin);
            echo $this->finContenido1;
            $this->producto = new Producto();

          /*  
            foreach ($_SESSION['carrito'] as $valor){

                if($valor["stock"] < $valor["cantidad"]){
               $valor["cantidad"] = $valor["stock"];
               $error = true;
              }

            }
              
            if($error){
                echo "<br><h2>No Puedes Realizar La compra No hay suficientes productos en STOCK</h2>";
                echo "<a href='?pagina=catalogo'><button class='boton'>Volver al Listado</button></a>";
            } else {
                foreach ($_SESSION['carrito'] as $valor){
                $stock =  $valor["stock"] - $valor["cantidad"] ;
                $reci = $this->producto->updateStock($stock,$valor["id"]);
            }
            */
            foreach ($_SESSION['carrito'] as $valor){
              $stock =  $valor["stock"] ;
                $reci = $this->producto->updateStock($stock,$valor["id"]);
            }

            echo"<script language='javascript'>window.location='GenerarPDF.php'</script>";
      
           
        } else { // carrito sin confirmar
            echo $this->contenido;
            echo $this->carrito($fin);
            echo $this->finContenido;
            $this->carrito = new Carrito();


        }
    }

}