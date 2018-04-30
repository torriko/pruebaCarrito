<?php
require_once "Carrito.php";

class Catalogo
{
    
    public $cabecera=
        "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Listado</title>
            <link rel='stylesheet' href='estilos/estilocatalogo.css'>
        </head>";



    public $contenido=
        "<body>
        <div id='contenedor'>
            <header>
             <!--   <form method='post'> 
                <input type='submit' class='boton' name='inicio' value='Inicio'>
                <input type='submit' class='boton' name='carrito' value='Carrito'>
                </form> -->
                <a href='?pagina=inicio'><button class='boton'>Salir</button></a>
                <a href='?pagina=carrito'><button class='boton'>Carrito</button></a>
        ";


    public $finContenido0=" 

                <form  method='post'> 
                               
                    <input type='submit' class='boton' name='siguiente' value='Siguiente'>
                </form>
            </div>
        </div>
        </body>
        </html>";

    public $finContenido1=" 

                <form  method='post'> 
                    <input type='submit' class='boton' name='anterior' value='Anterior'>                                 
                    <input type='submit' class='boton' name='siguiente' value='Siguiente'>
                </form>
            </div>
        </div>
        </body>
        </html>";

    public $finContenido2=" 

                <form  method='post'> 
                    <input type='submit' class='boton' name='anterior' value='Anterior'>                                 
 
                </form>
            </div>
        </div>
        </body>
        </html>";

    function listado(){

        $unid = 0; // Indica cuantos productos tenemos en el carro
        foreach ( $_SESSION['carrito'] as $value) {
            $unid += $value['cantidad'];
        }
      echo "  <h2>Bienvenido :".$_SESSION['usuario']."</h2>
              <h3>Articulos en su Carrito : ". $unid." </h3> ";

        $listado = $_SESSION['listado'];
        echo '</header>';
        echo "<div id='contenido'>";
        echo '<form  method="post">';
        echo '<table>';
        echo '<tr><th colspan="3"><h2>Listado de Productos</h2></th></tr>';
        echo '<tr><th>Descripcion</th><th>Imagen</th><th>Precio</th><th></th></tr>';
        foreach ($listado as $valor ) {
            echo '<tr><td>'.$valor["descripcion"].'</td>';
            echo '<td><img src="'.$valor["imagen"].'"</td>';
            echo '<td>'.$valor["precio"].'€ </td>';
            if($valor["stock"]>0) {
                echo '<td><input type="submit" class="boton" name="'.$valor["id"].'" value="comprar"></td></tr>';
            } 
        
        }
        echo '</table></br>';
        echo '</form>';
    }

    public function display(){

        echo $this->cabecera;
        echo $this->contenido;
        echo $this->listado();
        if ($_SESSION['numpagina']== 0) echo $this->finContenido0;
        else if ($_SESSION['numpagina']== 1) echo $this->finContenido1;
        else echo $this->finContenido2;

    }

}