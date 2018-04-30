<?php
ob_start();
require_once "Usuario.php";
require_once "VistaLogin.php";
require_once "Catalogo.php";
require_once "Producto.php";
require_once "Carrito.php";
require_once "VistaCarrito.php";

session_start();

class Control
{
    public $usuario;
    public $login;
    public $catalogo;
    public $producto;
    public $carrito;
    public $vistaCarrito;

    public function __construct()
    {

        $this->login = new VistaLogin();
        $this->catalogo = new Catalogo();
        $this->producto = new Producto();
        $this->carrito = new Carrito();
        $this->vistaCarrito = new VistaCarrito();
        $this->Iniciar();

    }

    public function Iniciar()
    {

        if (isset($_GET['pagina'])) {
            $pagina = $_GET['pagina'];
        } else {
            $pagina = "";
        }

        if (isset($_GET['numpagina'])) {
            $numpagina = $_GET['numpagina'];
        } else {
            $numpagina = "";
        }

        if(isset($_SESSION['usuario'])) {

            switch($pagina){

                case "catalogo":

                   if(!isset($_SESSION['numpagina'])){
                       $_SESSION['numpagina'] = 0;
                       $_SESSION['carrito']=array();
                   }
                    if (isset($_POST['anterior'])) { // pasa a la pagina siguiente
                        if ( $_SESSION['numpagina'] > 0) {
                            $_SESSION['numpagina'] =$_SESSION['numpagina'] - 1 ;
                        }
                    }
                    else if (isset($_POST['siguiente'])) { // vuelve a la pagina anterior
                        if ($_SESSION['numpagina'] < 2 ) {
                            $_SESSION['numpagina'] = $_SESSION['numpagina'] + 1 ;
                        }
                    }

                    $_SESSION['listado'] = $this->cargarProductosPagina($_SESSION['numpagina']);

                    $this->catalogo->display();
                    $this->mascompra();
              //      print_r( $this->carrito->productoscarrito);
                    break;

                case "carrito":

                   if (isset($_POST['listado'])) { //
                    $this->catalogo->display(); //
                    $_SESSION['pagina']='catalogo'; //
                }
                else {
                    if (isset($_POST['anular'])) {
                        $_SESSION['carrito']=array();
                        $this->carrito->productoscarrito = array();
                        $this->catalogo->display();
                        $_SESSION['pagina']='catalogo'; //
                     //   header("location:?pagina=catalogo");

                    }
                    else if (isset($_POST['confirmar'])) {
                        $this->vistaCarrito->display(true); // visualiza el carro confirmado
                        $_SESSION['pagina']='inicio'; // inicia una nueva session de usuario
                    }
                    else {
                        $this->quitarArticulo(); // opciones de borrado de articulos de carro
                        $this->vistaCarrito->display(false); // pinta carrito si confirmar
                    }
                }

                    break;


                default:
                    session_destroy();
                    $this->validarUsuario();
                    $this->login->display();
                    break;
            }

        } else {
            $this->validarUsuario();
            $this->login->display();
        }

    } // fin iniciar

    function validarUsuario(){
        if (isset($_POST['login'])) {
            $this->usuario = new Usuario($_POST['usuario'], $_POST['password']);
            if (count($this->usuario->buscarUsuario()) > 0) {
                $_SESSION['usuario'] = $_POST['usuario'];
                $_SESSION['productos'] = $this->producto->listarProductos();
                header("location:?pagina=catalogo");
            } else {
                $_SESSION['error'] = "Usuario o Password No Validos";
            }
        }
    }

    function cargarProductosPagina($numpagina){

        $pri = $numpagina * 4;
        for ( $i = $pri ; $i < sizeof($_SESSION['productos']); $i++) {
            if ( $i < $pri+4) {
                $listado[]=$_SESSION['productos'][$i];
            }
        }
        return $listado;

    }

    function mascompra() {
        $this->carrito->productoscarrito = $_SESSION['carrito'];
        $listado = $_SESSION['listado']; //
        foreach ( $listado as $value) {

            if (isset($_POST[$value['id']])) {
                
                $sumado=false;
                $this->carrito->add($value);
                $_SESSION['carrito'] = $this->carrito->productoscarrito;
            }

        }
    }


    function quitarArticulo() {

        $this->carrito->productoscarrito = $_SESSION['carrito'];
        for ( $i = 0; $i < sizeof( $this->carrito->productoscarrito); $i++) {
            if (isset($_POST[$this->carrito->productoscarrito[$i]['id']])) { // comprueba si se ha dado a borrar unidad
                $this->carrito->productoscarrito[$i]["cantidad"]--; // se resta uno a la cantidad
                if ($this->carrito->productoscarrito[$i]["cantidad"] == 0) { // si se ha quedado a 0 se borra del carrito
                    unset($this->carrito->productoscarrito[$i]);
                    $carrito = array_values($this->carrito->productoscarrito);
                }
                $_SESSION['carrito'] = $this->carrito->productoscarrito; // se actualiza el carro
            }
        }
    }



} // fin clase
ob_end_flush();
?>