<?php

function sanearCadena($cadena){
    $cadena = str_replace("'", "·", $cadena);
    $cadena = str_replace('"', '·', $cadena);
    $cadena = str_replace("´", "·", $cadena);
    $cadena = str_replace("`", "·", $cadena);
    $cadena = stripslashes($cadena);
    $cadena = strip_tags($cadena);
    return $cadena;
}