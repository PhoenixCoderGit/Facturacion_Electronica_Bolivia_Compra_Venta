<?php

namespace App\lib;

class PrincipalModelo
{
    public function __construct()
    {

    }
    /*private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    protected function query($query){
        return $this->db->connect()->query($query);
    }

    protected function prepare($query){
        return $this->db->connect()->prepare($query);
    }*/

    /*MODELO PARA LIMPIAR CADENAS*/
    protected static function mdlLimpiarCadena($cadena){
        $cadena = trim($cadena);
        $cadena = stripcslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src", "", $cadena);
        $cadena = str_ireplace("<script type=", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);
        $cadena = stripcslashes($cadena);
        $cadena = trim($cadena);
        return $cadena;
    }

    /*Encriptar*/
    public static function mdlEncriptar($cadena)
    {
        $key = hash("sha256", $_ENV['SECRET_KEY']);
        $iv = substr(hash('sha256', $_ENV['SECRET_IV']), 0, 16);
        $salida = openssl_encrypt($cadena, $_ENV['METHOD'], $key, 0, $iv);
        $salida = base64_encode($salida);
        return $salida;
    }

    /*Desencriptar*/
    protected function mdlDesencriptar($cadena){
        $key = hash("sha256", $_ENV['SECRET_KEY']);
        $iv = substr(hash('sha256', $_ENV['SECRET_IV']), 0, 16);
        $salida = openssl_decrypt(base64_decode($cadena), $_ENV['METHOD'], $key, 0, $iv);
        return $salida;
    }

    /*MODELO PARA ELIMINAR RECURSIVAMENTE CARPETAS Y ARCHIVOS*/
    static function deleteDirectory($dir) {
        if(!$dh = @opendir($dir)) return;
        while (false !== ($current = readdir($dh))) {
            if($current != '.' && $current != '..') {
                //echo 'Se ha borrado el archivo '.$dir.'/'.$current.'<br/>';
                if (!@unlink($dir.'/'.$current))
                    deleteDirectory($dir.'/'.$current);
            }
        }
        closedir($dh);
        //echo 'Se ha borrado el directorio '.$dir.'<br/>';
        @rmdir($dir);
    }

}