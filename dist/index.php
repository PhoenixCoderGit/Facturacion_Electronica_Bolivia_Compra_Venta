<?php

use App\lib\ErrorLog;
use Dotenv\Dotenv;

require __DIR__.'/vendor/autoload.php';

ErrorLog::activarErrorLog();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require __DIR__.'/App/lib/routes.php';