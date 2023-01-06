<?php
namespace App\lib;

use App\config\Constants;
use App\controladores\SucursalesControlador;
use App\controladores\UsuariosControlador;

if (isset($peticionAjax)) {
    require_once "../controladores/SucursalesControlador.php";
}

if (!isset($_SESSION)) {

    session_start(['name' => $this->session]);
}

class PrincipalVista
{
    public function __construct()
    {
        $this->session = Constants::$SESSION;
    }

    function render(string $nombre)
    {?>

        <!DOCTYPE html>
        <html lang="es">


        <?php if ($_SESSION["iniciarSesion".$this->session] != 'ok'): ?>

            <?php include_once "App/vistas/incluidos/head-login.php" ?>

        <?php else: ?>

            <?php include_once "App/vistas/incluidos/head.php" ?>

        <?php endif; ?>

        <body>

        <?php

        if (!isset($_SESSION[$this->session]) && (!isset($_SESSION["iniciarSesion".$this->session]) ||
                $_SESSION["iniciarSesion".$this->session] != 'ok')): ?>

            <div id="auth">
                <?php include_once "App/vistas/paginas/auth-login.php" ?>
            </div>

        <?php else: ?>

            <div id="app">

                <?php
                // ROLES

                $item = "login";
                $valor = $_SESSION["login".$this->session];
                $roles = UsuariosControlador::ctrMostrarRoles($item, $valor);
                $objeto = $roles->data;
                $roles = json_encode($objeto);
                $roles = (json_decode($roles, true));
                foreach ($roles as $value) {

                    if ($value["modulos"]  == "POS"){
                        $posRol = $value;
                    }
                    else if ($value["modulos"]  == "USUARIOS"){
                        $usuariosRol = $value;
                    }
                    else if ($value["modulos"]  == "CATEGORIAS"){
                        $categoriasRol = $value;
                    }
                    else if ($value["modulos"]  == "PRODUCTOS"){
                        $productosRol = $value;
                    }
                    else if ($value["modulos"]  == "EMPRESAS"){
                        $empresasRol = $value;
                    }
                    else if ($value["modulos"]  == "FACTURAS"){
                        $facturasRol = $value;
                    }
                    else if ($value["modulos"]  == "CLIENTES"){
                        $clientesRol = $value;
                    }
                    else if ($value["modulos"]  == "SUCURSALES"){
                        $sucursalesRol = $value;
                    }
                    else if ($value["modulos"]  == "REPORTES"){
                        $reportesRol = $value;
                    }
                }

                include_once "App/vistas/incluidos/menu.php"
                ?>

                <div id="main">

                    <!--VARIABLES DE SESSION-->

                    <input hidden type="text" name="loginSession" id="loginSession" value="<?php echo $_SESSION["login".$this->session] ?>">
                    <input hidden type="text" name="idSession" id="idSession" value="<?php echo $_SESSION["id".$this->session] ?>">
                    <input hidden type="text" name="posSession" id="posSession" value="<?php echo $_SESSION["pos".$this->session] ?>">
                    <input hidden type="text" name="sucursalSession" id="sucursalSession" value="<?php echo $_SESSION["sucursal".$this->session] ?>">

                    <?php
                    $item1 = "siat_codigo_pos";
                    $valor1 = $_SESSION["pos".$this->session];
                    $item2 = "codigo_sucursal";
                    $valor2 = $_SESSION["sucursal".$this->session];
                    $sucursal = SucursalesControlador::ctrMostrarSucursales($item1, $valor1, $item2, $valor2);
                    $sucursal = json_decode($sucursal);
                    ?>

                    <input hidden type="text" name="tipoFacturaSession" id="tipoFacturaSession" value="<?php echo $sucursal->data->documento_ajuste ?>">
                    <input hidden type="text" name="tipoDocumentoSectorSession" id="tipoDocumentoSectorSession" value="<?php echo $sucursal->data->tipo_documento_sector ?>">
                    <input hidden type="text" name="modalidadSession" id="modalidadSession" value="<?php echo $sucursal->data->codigo_modalidad ?>">

                    <input hidden type="text" name="API_URL" id="API_URL" value="<?php echo Constants::$API_URL ?>">



                    <?php include_once "App/vistas/incluidos/cabecera.php" ?>

                    <!--    CONTENIDO    -->
                    <div id="contenido">
                        <?php include_once 'App/vistas/' . $nombre . '.php'; ?>
                    </div>
                    <!--    FIN CONTENIDO    -->

                    <?php include_once "App/vistas/incluidos/footer.php" ?>

                </div>

            </div>

        <?php endif; ?>

        <?php include_once "App/vistas/incluidos/js.php"?>

        </body>

        </html>

    <?php
    }
}
?>


