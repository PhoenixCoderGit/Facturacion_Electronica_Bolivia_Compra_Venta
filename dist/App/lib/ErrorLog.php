<?php


namespace App\lib;

date_default_timezone_set('America/La_Paz');

class ErrorLog
{
    public static function activarErrorLog(){
        error_reporting(E_ALL & ~E_NOTICE);
        ini_set('ignore_repeated_errors', TRUE);
        ini_set('display_errors', FALSE);//use FALSE only in production environment or real server. Use TRUE in development environment
        ini_set('log_errors', TRUE);
        ini_set('error_log', dirname(__DIR__).'/logs/php-error.log');
        //error_log( "Inicia app" );
    }

}