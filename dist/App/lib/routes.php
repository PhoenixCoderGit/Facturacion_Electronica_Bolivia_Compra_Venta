<?php

use App\config\Constants;
use App\controladores\CafcControlador;
use App\controladores\CategoriasControlador;
use App\controladores\ClientesControlador;
use App\controladores\ConfiguracionesControlador;
use App\controladores\ContingenciasControlador;
use App\controladores\EmisionFacturasControlador;
use App\controladores\Error404;
use App\controladores\FacturasControlador;
use App\controladores\InicioControlador;
use App\controladores\InspeccionesControlador;
use App\controladores\LoginControlador;
use App\controladores\PaquetesControlador;
use App\controladores\PerfilControlador;
use App\controladores\PosControlador;
use App\controladores\ProductosControlador;
use App\controladores\ReportesControlador;
use App\controladores\SucursalesControlador;
use App\controladores\UsuariosControlador;


$router = new Bramus\Router\Router();


if (!isset($_SESSION)) {
    session_start(['name' => Constants::$SESSION]);
}


/***********************ERRORES*************************/

$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    $controller = new Error404();
    $controller ->index();
});


/************************ INICIO ***********************/

$router->get('/', function() {
    $controller = new InicioControlador();
    $controller->index();
});

$router->get('/inicio', function() {
    $controller = new InicioControlador();
    $controller -> index();
});


/************************ USUARIOS ***********************/

$router->get('/auth-login', function() {
    if (isset($_SESSION['iniciarSesion'.Constants::$SESSION])){
        $controller = new InicioControlador();
        $controller->index();
    }else{
        $controller = new LoginControlador();
        $controller->index();
    }
});

$router->post('/auth', function() {
    $controller = new UsuariosControlador();
    $controller->ctrIngresoUsuario($_POST);

});

$router->get('/usuarios', function() {
    $controller = new UsuariosControlador();
    $controller -> index();
});

$router->get('/perfil', function() {
    $controller = new PerfilControlador();
    $controller -> index();
});


/************************ CLIENTES ***********************/

$router->get('/clientes', function() {
    $controller = new ClientesControlador();
    $controller -> index();
});

/************************ CATEGORIAS ***********************/

$router->get('/categorias', function() {
    $controller = new CategoriasControlador();
    $controller -> index();
});

/************************ PRODUCTOS ***********************/

$router->get('/productos', function() {
    $controller = new ProductosControlador();
    $controller -> index();
});

/************************ EMISION ***********************/

$router->get('/emisionFacturas', function() {
    $controller = new EmisionFacturasControlador();
    $controller -> index();
});

/************************ SUCURSALES ***********************/

$router->get('/sucursales', function() {
    $controller = new SucursalesControlador();
    $controller -> index();
});

/************************ POS ***********************/

$router->get('/pos', function() {
    $controller = new PosControlador();
    $controller -> index();
});

/************************ CONFIGURACIONES ***********************/

$router->get('/configuraciones', function() {
    $controller = new ConfiguracionesControlador();
    $controller -> index();
});

/************************ FACTURAS ***********************/

$router->get('/facturas', function() {
    $controller = new FacturasControlador();
    $controller -> index();
});

/************************ CONTINGENCIAS ***********************/

$router->get('/contingencias', function() {
    $controller = new ContingenciasControlador();
    $controller -> index();
});

/************************ CAFC ***********************/

$router->get('/cafc', function() {
    $controller = new CafcControlador();
    $controller -> index();
});

/************************ PAQUETES ***********************/

$router->get('/paquetes', function() {
    $controller = new PaquetesControlador();
    $controller -> index();
});

/************************ REPORTES ***********************/

$router->get('/reportes', function() {
    $controller = new ReportesControlador();
    $controller -> index();
});

/************************ INSPECCIONES ***********************/

$router->get('/inspecciones', function() {
    $controller = new InspeccionesControlador();
    $controller -> index();
});


$router->run();