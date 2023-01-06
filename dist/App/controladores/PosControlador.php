<?php

namespace App\controladores;

if (isset($peticionAjax)) {
    require_once "../lib/PrincipalVista.php";
    require_once "../lib/PrincipalModelo.php";
    require_once "../modelos/PosModelo.php";
    require_once "../config/Constants.php";
}

use App\config\Constants;
use App\lib\PrincipalModelo;
use App\lib\PrincipalVista;
use App\modelos\PosModelo;


if (!isset($_SESSION)) {
    $session = Constants::$SESSION;
    session_start(['name' => $session]);
}

class PosControlador extends PrincipalModelo
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
        self::render('paginas/pos');
    }

    /********************
     * MOSTRAR SUCURSALES
     ****************** */

    public static function ctrMostrarPos($item1, $valor1){
        $resp = new PosModelo();
        return $resp->mdlMostrarPos($item1, $valor1);
    }


}