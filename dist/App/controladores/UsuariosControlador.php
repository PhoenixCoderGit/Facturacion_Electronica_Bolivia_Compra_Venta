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


class UsuariosControlador extends PrincipalModelo
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
        self::render('paginas/usuarios');
    }

    /******************
     * INGRESAR USUARIO
     ******************/

    public function ctrIngresoUsuario($data)
    {

        if (isset($data['ingUsuario']) && isset($data['ingPassword'])) {

            if (
                preg_match('/^[a-zA-Z0-9\_\-]{4,16}$/', $data['ingUsuario']) &&
                preg_match('/^.{3,12}$/', $data['ingPassword'])
            ) {

                $usuario = PrincipalModelo::mdlLimpiarCadena($data['ingUsuario']);
                $clave = PrincipalModelo::mdlLimpiarCadena($data['ingPassword']);
                $claveEncriptado = PrincipalModelo::mdlEncriptar($clave);

                $item = "login";
                $valor = $usuario;
                $respuesta = self::ctrMostrarUsuarios($item, $valor);
                $respuesta = $respuesta->data[0];

                if ((string)$respuesta->login == $data['ingUsuario'] &&
                    (string)$respuesta->password == $claveEncriptado
                ) {

                    if ((string)$respuesta->estado == 1) {


                        if (!isset($_SESSION)) {

                            session_start(['name' => $this->session]);
                        }

                        $item = "siat_codigo_pos";
                        $valor = (string)$respuesta->pos;
                        $pos = PosControlador::ctrMostrarPos($item, $valor);

                        $_SESSION["iniciarSesion".$this->session] = "ok";
                        $_SESSION["login".$this->session] = $data['ingUsuario'];
                        $_SESSION["id".$this->session] = $respuesta->id_usuario;
                        $_SESSION["pos".$this->session] = (string)$respuesta->pos;
                        $_SESSION["sucursal".$this->session] = (string)$respuesta->sucursal;
                        $_SESSION["cafc".$this->session] = $pos->data[0]->cafc;

                        $_SESSION["inspeccion".$this->session] = $pos->data[0]->inspeccion;

                        header('location: inicio');

                    } else {
                        http_response_code(401);
                        header('location: auth-login?error=Usuario no esta activado&ingUsuario');
                    }
                } else {
                    http_response_code(401);
                    header('location: auth-login?error=Error: Password o usuario incorrectos&ingUsuario'.$respuesta->login);
                }

            }

        }

    }

    /****************
     * CERRAR SESSION
     *************** */

    public function ctrCierreSession()
    {

        session_start(['name' => $this->session]);

        if (true) {
            unset($_SESSION[$this->session]);
            unset($_SESSION["login".$this->session]);
            unset($_SESSION["pos".$this->session]);
            unset($_SESSION["sucursal".$this->session]);
            unset($_SESSION["contingencia".$this->session]);
            session_destroy();
            session_unset();
            $mensaje = [
                "alerta" => "redireccionar"
            ];
            return $mensaje;
        } else {
            $mensaje = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "no se pudo cerrar la sesion en el sistema",
                "Tipo" => "error"
            ];
        }
        echo json_encode($mensaje);
    }

    /****************
     * MOSTRAR USUARIOS
     *************** */

    public static function ctrMostrarUsuarios($item = null, $valor = null){
        $usuario = new UsuariosModelo();
        return $usuario->mdlMostrarUsuarios($item, $valor);
    }

    /****************
     * MOSTRAR ROLES
     *************** */

    public static function ctrMostrarRoles($item = null, $valor = null){
        $usuario = new UsuariosModelo();
        return $usuario->mdlMostrarRoles($item, $valor);
    }

}