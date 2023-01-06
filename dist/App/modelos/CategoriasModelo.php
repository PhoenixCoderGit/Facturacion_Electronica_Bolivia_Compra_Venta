<?php
namespace App\modelos;
if (isset($peticionAjax)) {
    require_once "../lib/PrincipalModelo.php";
    require_once "../lib/Database.php";
    require_once "../config/Constants.php";
}

use App\config\Constants;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CategoriasModelo
{

    /****************
     * MOSTRAR USUARIOS
     *************** */

    public function mdlMostrarUsuarios($item = null, $valor = null)
    {

        $client = new Client();
        try {
            $request = $client->request(
                'GET',
                Constants::$API_URL.'usuarios/'.$item.'/'.$valor,
                [
                    'auth' => [
                        Constants::$API_USUARIO,
                        Constants::$API_LLAVE
                    ]
                ]
            );
            $respuesta = json_decode($request->getBody()->getContents());
            return  $respuesta;

        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            return json_decode($responseBodyAsString, true);
        }

    }

}