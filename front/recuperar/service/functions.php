<?php
include('../../app/conexion.php');
/**
 * funcion que determina si existen el mail y el token asociados junto con la fecha para comprobar
 * que todo esta correcto para regenerar el password
 * 
 * @param string $mail
 * @param string $token
 * 
 * return $retornado
 *      0 -> no existe el par mail token (esto evita suplantaciones)
 *      1 -> existe pero la fehca se ha pasado en mas de 5 horas
 *      2 -> existe y se puede cambiar la fecha
 * 
 */
function comprobarGet($mail, $token){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM cambiar_pass WHERE email='$mail' AND token='$token' AND modificado=0";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $numfilas = $resultado->num_rows;
    $retornado = "";
    if($numfilas == 0){
        $retornado = 0;
    }elseif($numfilas > 0){
        while($fila = $resultado->fetch_array()) {
            $fechaToken = $fila['created_at'];
            $fechaTokenIncrementada = strtotime('+5 hour', strtotime($fechaToken));
            $fechaActual = strtotime(date('Y-m-d H:i'));
            if($fechaTokenIncrementada < $fechaActual){
                $retornado = 1;
            }else{
                $retornado = 2;
            }


        }
    }
    $resultado->close();
    $mysqli->close();
    return $retornado;       
}
?>