<?php
include('../../app/conexion.php');
include('../../mails/mails.php');

/*function obtenerDatosUsuario($id){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM users JOIN datos_clientes ON users.id = datos_clientes.id_user WHERE users.id=$id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $datos_usuario = $resultado->fetch_array();
    $resultado->close();
    $mysqli->close();
    return $datos_usuario;
}

function obtenerTelefonosUsuario($id){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM telefonos_clientes WHERE id_user = $id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $telefonos = [];
    while($fila = $resultado->fetch_array()) {
        $telefonos[] =  $fila['telefono'];
    }
    $resultado->close();
    $mysqli->close();
    return $telefonos;
}*/

function cambiarClave($id, $pass){
    $fecha = date('Y-m-d H:i');
    $mysqli = conexion();
    $sentencia = "UPDATE users SET clave='$pass', updated_at='$fecha' WHERE id=$id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $mysqli->close();
}
