<?php
include('../../app/conexion.php');
include('../../app/functions.php');


function informacion(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM campos WHERE id_formulario=1";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    while($fila = $resultado->fetch_array()) {
        echo "<tr>";
        echo "<td>" . $fila['id'] . "</td>";
        echo "<td>" . $fila['nombre_campo'] . "</td>";
        echo "<td>" . $fila['name'] . "</td>";
        echo "<td>" . $fila['value'] . "</td>";
        echo "<td>" . $fila['tipo'] . "</td>";
        echo "<td>
            <a href='barrioseditar?id=" . $fila['id'] . "&nombre=" . $fila['nombre_barrio'] . "' type='button' class='btn btn-warning btn-xs'>Editar</a>
        </td>";
        echo "</tr>";
    }
    $resultado->close();
}




