<?php

namespace App\modelos;

if (isset($peticionAjax)) {
    require_once "../lib/PrincipalModelo.php";
    require_once "../config/Constants.php";
}

use App\config\Constants;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class InspeccionesModelo
{


}