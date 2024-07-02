<?php 

function obtenerDatosUsuario($id){
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
}

function modificarDatosCliente($cif, $pais, $poblacion, $provincia, $cp, $direccion, $id){
    $fecha = date('Y-m-d H:i');
    $mysqli = conexion();
    $sentencia = "UPDATE datos_clientes SET cif='$cif', direccion='$direccion', cp='$cp', poblacion='$poblacion', provincia='$provincia', pais='$pais', updated_at='$fecha' WHERE id_user=$id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $mysqli->close();
}

function modificarTelefonosCliente($telefonos, $id){
    $mysqli = conexion();
    $sentencia = "DELETE FROM telefonos_clientes WHERE id_user=$id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $mysqli->close();
    guardarTelefonosCliente($telefonos, $id);
}

function guardarTelefonosCliente($telefonos, $id){
    $mysqli = conexion();
    foreach($telefonos as $telefono){    
        if($telefono != ""){
            $sentencia = "INSERT INTO telefonos_clientes (id_user, telefono) VALUES ('$id', '$telefono')";
            if(!($resultado = $mysqli->query($sentencia))) {
                echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
                exit;
            }
        }
        
        
    }
    $mysqli->close();
}
                            