<?php
include('../../app/conexion.php');
include('../../mails/mails.php');
function listarEventos(){
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

function listarUltimosEventos(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM datos_clientes JOIN users ON datos_clientes.id_user = users.id WHERE datos_clientes.fecha_boda >= CURRENT_DATE ORDER BY datos_clientes.fecha_boda ASC LIMIT 3";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $listasEventos = [];
    $contador = 0;
     while($fila = $resultado->fetch_array()) {
        $listasEventos[$contador]['id'] = $fila['id'];
        $listasEventos[$contador]['nombre'] = $fila['nombre'];
        $listasEventos[$contador]['fecha_boda'] = $fila['fecha_boda'];
        $listasEventos[$contador]['lugar_boda'] = $fila['lugar_boda'];
        $contador++;
    }
    $resultado->close();
    $mysqli->close();
    return $listasEventos;
}