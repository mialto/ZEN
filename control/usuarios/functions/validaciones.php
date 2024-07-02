<?php
include('../../app/validacionesgenerales.php');

/**
 * comprueba que no exista ya el mail en la web
 * @param string $mail
 * return $mensaje
 */
function comprobarMail($mail){
    $mensaje = "";
    $mysqli = conexion();
    $sentencia = "SELECT * FROM users WHERE email='$mail'";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $numfilas = $resultado->num_rows;
    if($numfilas > 0){
        $mensaje = "El correo eléctronico ya existe";
    }
    return $mensaje;
}

/**
 * comprueba que no exista el cif ya en el sistema
 * @param string @$cif
 * return $mensaje
 */
 function comprobarCif($cif){
    $mensaje = "";
    $mysqli = conexion();
    $sentencia = "SELECT * FROM datos_clientes WHERE cif='$cif'";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $numfilas = $resultado->num_rows;
    if($numfilas > 0){
        $mensaje = "El cif introducido ya existe";
    }
    return $mensaje;
 }