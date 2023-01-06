<?php

namespace App\controladores;

if (isset($peticionAjax)) {
    require_once "../lib/PrincipalVista.php";
    require_once "../lib/PrincipalModelo.php";
    require_once "../modelos/SucursalesModelo.php";
    require_once "../config/Constants.php";
}

use App\config\Constants;
use App\lib\PrincipalModelo;
use App\lib\PrincipalVista;
use App\modelos\SucursalesModelo;


if (!isset($_SESSION)) {
    $session = Constants::$SESSION;
    session_start(['name' => $session]);
}

class SucursalesControlador extends PrincipalModelo
{
    private PrincipalVista $view;

    public function __construct()
    {
        parent::__construct();
        $this->view = new PrincipalVista();
    }

    public function render(string $name)
    {
        $this->view->render($name);
    }

    public function index()
    {
        self::render('paginas/sucursales');
    }

    /********************
     * MOSTRAR SUCURSALES
     ****************** */

    public static function ctrMostrarSucursales($item1, $valor1, $item2, $valor2){
        $resp = new SucursalesModelo();
        return $resp->mdlMostrarSucursales($item1, $valor1, $item2, $valor2);
    }

}