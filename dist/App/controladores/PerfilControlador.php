<?php

namespace App\controladores;

if (isset($peticionAjax)) {
    require_once "../lib/PrincipalModelo.php";
    require_once "../lib/PrincipalVista.php";
    require_once "../modelos/UsuariosModelo.php";
    require_once "../config/Constants.php";
}

use App\lib\PrincipalModelo;
use App\lib\PrincipalVista;
use App\modelos\UsuariosModelo;
use App\config\Constants;


class PerfilControlador extends PrincipalModelo
{
    private PrincipalVista $view;
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->view = new PrincipalVista();
        $this->session = Constants::$SESSION;
    }

    public function render(string $name)
    {
        $this->view->render($name);
    }

    public function index()
    {
        self::render('paginas/perfil');
    }

    /****************
     * MOSTRAR USUARIOS
     *************** */

    public static function ctrMostrarUsuarios($item = null, $valor = null){
        $usuario = new UsuariosModelo();
        return $usuario->mdlMostrarUsuarios($item, $valor);
    }

}