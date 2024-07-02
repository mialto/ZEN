<?php 
include('../../app/conexion.php');
include('../../mails/mails.php');
function listasMusica(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM listas_musica Where activa=1";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $listasMusica = [];
    $contador = 0;
     while($fila = $resultado->fetch_array()) {
        $listasMusica[$contador]['id'] = $fila['id'];
        $listasMusica[$contador]['nombre'] = $fila['nombre'];
        $listasMusica[$contador]['descripcion'] = $fila['descripcion'];
        $listasMusica[$contador]['enlace'] = $fila['enlace'];
        $contador++;
    }
    $resultado->close();
    $mysqli->close();
    return $listasMusica;
}