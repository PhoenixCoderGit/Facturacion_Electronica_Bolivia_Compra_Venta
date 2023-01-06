<?php

use App\config\Constants;
$peticionAjax = true;
require_once "../config/Constants.php";

if (!isset($_SESSION)) {
    session_start(['name' => Constants::$SESSION]);
}

class SessionAjax
{
    public $sucursal;
    public $pos;
    public $cafc;

    private string $session;

    public function __construct()
    {
        $this->session = Constants::$SESSION;
    }

    public function ajaxCambiarSession(){
        $_SESSION["sucursal".$this->session] = $this->sucursal;
        $_SESSION["pos".$this->session] = $this->pos;
        $_SESSION["cafc".$this->session] = $this->cafc;

        echo json_encode($this->cafc);
    }

}

if (isset($_POST["tipo_operacion"]) && $_POST["tipo_operacion"] == "cambiar_session") {
    $session = new SessionAjax();
    $session->pos = $_POST["pos"];
    $session->sucursal = $_POST["sucursal"];
    $session->cafc = $_POST["cafc"];
    $session->ajaxCambiarSession();
}