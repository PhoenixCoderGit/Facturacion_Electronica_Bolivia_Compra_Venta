<?php

use App\controladores\UsuariosControlador;

$peticionAjax = true;
require_once "../controladores/UsuariosControlador.php";


class LoginAjax{

    public function mostrar(){
        $usuario = new UsuariosControlador();
        $respuesta = $usuario->ctrCierreSession();
        echo json_encode($respuesta);
    }

}

if (isset($_POST['tokenM'])){

    $mostrar = new LoginAjax();
    $mostrar->mostrar();

}else{
    session_unset();
    session_destroy();
    //setcookie("tokenM", "", time()+(-1), "/");
}
