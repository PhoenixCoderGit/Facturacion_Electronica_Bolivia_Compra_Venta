<?php
namespace App\modelos;
if (isset($peticionAjax)) {
    require_once "../lib/PrincipalModelo.php";
    require_once "../config/Constants.php";
}

use App\config\Constants;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class SucursalesModelo
{

    /********************
     * MOSTRAR SUCURSALES
     ****************** */

    public function mdlMostrarSucursales($item1, $valor1, $item2, $valor2)
    {

        $client = new Client();
        try {
            $request = $client->request(
                'GET',
                Constants::$API_URL.'empresas/'.$item1.'/'.$valor1.'/'.$item2.'/'.$valor2,
                [
                    'auth' => [
                        Constants::$API_USUARIO,
                        Constants::$API_LLAVE
                    ]
                ]
            );
            $respuesta = ($request->getBody()->getContents());
            return  $respuesta;

        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return ($responseBodyAsString);
        }

    }

}