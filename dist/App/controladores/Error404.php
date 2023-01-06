<?php


namespace App\controladores;


use App\lib\PrincipalVista;

class Error404
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
        self::render('paginas/error-404');
    }

}