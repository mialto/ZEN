<?php
include('../../app/conexion.php');
include('../../mails/mails.php');

function usuarios(){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM users ORDER BY nombre"; 
    /*$sentencia = "SELECT users.*, datos_clientes.fecha_boda 
    FROM users
    JOIN datos_clientes ON users.id = datos_clientes.id_user
    ORDER BY users.nombre";*/
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }

    while($fila = $resultado->fetch_array()) {
        $roles = leerRolesUsuario($fila['id']);
        $posicion = stripos($roles, "superadmin");
        if ($posicion !== false) {
            
        } else {
            echo '<tr class="odd gradeX">';
                //echo '<td>' . $fila['id'] . '</td>';
                echo '<td>' . $fila['nombre'] . '</td>';
                echo '<td>' . $fila['email'] . '</td>';
                /*if($fila['activo'] == 1){
                    echo '<td><center><i class="fa fa-check-circle" aria-hidden="true" style="color:green"></i></center></td>';
                }elseif($fila['activo'] == 0){
                    echo '<td><center><i class="fa fa-circle" aria-hidden="true" style="color:red"></i></center></td>'; 
                }*/
                
                echo "<td>" . $roles . "</td>";
                
                /*if($fila['activo'] == 1){
                    echo '<td><a href="" type="button" class="btn btn-warning btn-xs">Editar</a> <a href="" type="button" class="btn btn-info btn-xs">Ver ficha</a></td>';
                }else{*/
                    echo '<td>';
                echo '<a href="editarusuario?id='. $fila['id'] . '" type="button" class="btn btn-warning btn-xs">Editar</a> <a href="fichausuario?id='. $fila['id'] . '" type="button" class="btn btn-info btn-xs">Ver ficha</a> <a href="cambiarclave?id='. $fila['id'] .'" type="button" class="btn btn-primary btn-xs">Cambiar clave</a>';
                
                if(is_string($roles) && stripos(trim($roles), 'admin') !== false) {
                    
                } else {

                }          
                echo '</td>';
                //}
                
            echo '</tr>';

        }
    }
    $resultado->close();
    $mysqli->close();
}


function leerRolesUsuario($id){
    $roles = "";
    $mysqli = conexion();
    $sentencia2 = "SELECT * FROM users_roles LEFT JOIN roles ON users_roles.id_rol=roles.id where users_roles.id_user=$id";
    if(!($resultado2 = $mysqli->query($sentencia2))) {
        echo "Error al ejecutar la sentencia <b>$sentencia2</b>: " . $mysqli->error . "\n";
        exit;
    }
    while($fila2 = $resultado2->fetch_array()) {
        $roles .=  $fila2['nombre_rol'] . " ";
    }
    $resultado2->close();
    $mysqli->close();
    return $roles;
}

function roles($roles_usuario=[]){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM roles";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    while($fila = $resultado->fetch_array()) {
        if(in_array(1, $_SESSION['roles'])){    
            echo "<option value='" . $fila['id'] . "'";
            if(in_array($fila['nombre_rol'], $roles_usuario)){
                echo " selected";
            }
            echo">". $fila['nombre_rol'] ."</option>";      
        }else{
            if($fila['nombre_rol'] != 'superadmin'){
                if(in_array($fila['nombre_rol'], $roles_usuario)){
                    echo " selected";
                }
                echo "<option value='" . $fila['id'] . "'>". $fila['nombre_rol'] ."</option>";}
            }

    }
    $resultado->close();
    $mysqli->close();
}

/**
 * 
 */
function guardarUsuarios($nombre, $mail, $activo, $pass){
    $fecha = date('Y-m-d H:i');
    $mysqli = conexion();
    $sentencia = "INSERT INTO users (nombre, email, activo, clave, created_at) VALUES ('$nombre','$mail','$activo', '$pass', '$fecha')";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $id=mysqli_insert_id($mysqli);
    // Libera la memoria ocupada por el resultado
    $mysqli->close();
    //mandar correo electronico para poner la clave!
    $mysqli = conexion();
    $token = hash('sha256', $fecha);
    $insertar = "INSERT INTO cambiar_pass (email, token, modificado, created_At) VALUES ('$mail', '$token', 0, '$fecha')";
    if(!($resultado2 = $mysqli->query($insertar))) {
        echo "Error al ejecutar la sentencia <b>$insertar</b>;: " . $mysqli->error . "\n";
        exit;
    }
    //preparamos el mail y lo enviamos
    /*$subject =  "Crea tu clave en Espaal Food";
    $cuerpoMail = "<p>Si has recibido este mail es por que se ha creado un usuario dentro de la plataforma de Espaal Food.<p>";
    $cuerpoMail .= "<p>Por favor si no es así borra este correo</p>";
    $cuerpoMail .= "<p>Si lo has solicitado, por favor has click <a href='https://clientes.espaalfood.es/front/recuperar/regenera?mail=$mail&token=$token'>en este enalace para recuperar tu contraseña</a></p>";
    $cuerpoMail .= "localhost/espaalfood/front/recuperar/regenera?mail=$mail&token=$token";
    enviarMail($mail, $subject, $cuerpoMail);*/
    return $id;
}

function guardarDatosCliente($cif, $pais, $poblacion, $provincia, $cp, $direccion, $id){
    $fecha = date('Y-m-d H:i');
    $mysqli = conexion();
    $sentencia = "INSERT INTO datos_clientes (cif, pais, poblacion, provincia, cp, direccion, created_at, id_user) VALUES ('$cif','$pais','$poblacion','$provincia', '$cp', '$direccion','$fecha', '$id')";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    // Libera la memoria ocupada por el resultado
    $mysqli->close();
}



function guardarRoles($roles, $id){
    $mysqli = conexion();
    foreach($roles as $rol){
        $sentencia = "INSERT INTO users_roles (id_user, id_rol) VALUES ('$id', '$rol')";
        if(!($resultado = $mysqli->query($sentencia))) {
            echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
            exit;
        }
    }
    $mysqli->close();
}



function obtenerRolesUsuario($id){
    $mysqli = conexion();
    $sentencia = "SELECT * FROM users_roles JOIN roles ON users_roles.id_rol = roles.id WHERE users_roles.id_user = $id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $roles = [];
    while($fila = $resultado->fetch_array()) {
        $roles[] =  $fila['nombre_rol'];
    }
    $resultado->close();
    $mysqli->close();
    return $roles;
}

function modificarUsuarios($nombre, $mail, $activo, $id){
    $fecha = date('Y-m-d H:i');
    $mysqli = conexion();
    $sentencia = "UPDATE users SET nombre='$nombre', email='$mail', activo='$activo', updated_at='$fecha' WHERE id=$id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $mysqli->close();
}



function modificarRoles($roles, $id){
    $mysqli = conexion();
    $sentencia = "DELETE FROM users_roles WHERE id_user=$id";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $mysqli->close();
    guardarRoles($roles, $id);
}

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