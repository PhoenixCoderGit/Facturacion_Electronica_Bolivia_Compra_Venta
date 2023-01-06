<?php
namespace App\controladores;

use App\lib\PrincipalVista;


class InicioControlador
{
    private PrincipalVista $view;

    public function __construct()
    {
        $this->view = new PrincipalVista();
    }

    public function render(string $name){
        $this->view->render($name);
    }

    public function index(){
        self::render('paginas/inicio');
    }

}