<?php
// Clase Vista Formulario login
class VistaLogin
{
    // Variable que contiene el html con el formulario
    public $login= "<html lang=\"es\">
<head>
    <meta charset=\"UTF-8\">

    <title>Autentificacion </title>

    <link rel=\"stylesheet\" type=\"text/css\" href=\"estilos/estilologin.css\"/>
</head>

<body>

<section>

    <div id=\"formulario_login\">
        <h2>Login</h2>
        <form  method=\"POST\">

            <div class=\"campoFormulario\">
                <label for=\"usuario\">Usuario:</label>
                <input type='text' name=\"usuario\" maxlength=\"15\" required/>
            </div>
            <div class=\"campoFormulario\">
                <label for=\"password\">Contraseña:</label>
                <input type='password' name=\"password\" maxlength=\"20\" required/>
            </div>
            <div class=\"botonFormulario\">
                <input type=\"submit\" id=\"login\" name=\"login\" value=\"Entrar\">
            </div>

        </form>

    </div>
</section>

</body>
</html>";

// Funcion para mostrar 

function display(){
        echo $this->login;
        if(isset($_SESSION['error'])){
            echo '<h2>'.$_SESSION['error'].'</h2>';
        }
    }

}
