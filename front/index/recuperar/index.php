<?php
$mensajeError = "";
if($_POST){
    $mail = $_POST['mail'];
    include('app/conexion.php');
    include('mails/mails.php');
    $mysqli = conexion();
    $sentencia = "SELECT * FROM users WHERE email='$mail'";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $numfilas = $resultado->num_rows;
    if($numfilas>0){
        while($fila = $resultado->fetch_array()) {
            $fecha = date('Y-m-d H:1');
            $token = hash('sha256', $fecha);
            $insertar = "INSERT INTO cambiar_pass (email, token, created_At) VALUES ('$mail', '$token', '$fecha')";
            if(!($resultado2 = $mysqli->query($insertar))) {
                echo "Error al ejecutar la sentencia <b>$insertar</b>;: " . $mysqli->error . "\n";
                exit;
            }
            //preparamos el mail y lo enviamos
            $subject =  "asunto del mail para recuperar pass";
            $cuerpoMail = "Esto es un test q mañana sigo!";
            enviarMail($mail, $subject, $cuerpoMail);
        }
    }else{
        $mensajeError = "No hay ningun usuario con ese correo, por favor intentelo de nuevo";
    }  
    $resultado->close();
    $mysqli->close();
}
if(isset($_GET['mensajeRerror'])){
    $mensajeError = $_GET['mensajeError'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espaal Food</title>
    <!--Introducir el css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <!--Introducir el javascript-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="icon" href="https://espaalfood.es/wp-content/uploads/2022/03/cropped-espaalfood-favicon-32x32.png" sizes="32x32" />
    <link rel="icon" href="https://espaalfood.es/wp-content/uploads/2022/03/cropped-espaalfood-favicon-192x192.png" sizes="192x192" />
    <link rel="apple-touch-icon" href="https://espaalfood.es/wp-content/uploads/2022/03/cropped-espaalfood-favicon-180x180.png" />
    <link rel="stylesheet" href="../../assets/css/frontcss.css">
    <style>

    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <img src="https://espaalfood.es/wp-content/uploads/2022/03/cropped-espaalfood-logo.png" class="img-fluid"/>
                <center><h3>Recuperar contraseña</h3></center>    
            </div>
            <div class="col-lg-4"></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>Introduzca el correo electronico regisrado para recibir una nueva clave</p>
                <form method="POST" action="#">
                    <div class="campo">
                        <input type="email" name="mail" id="email" placeholder="email">
                    </div>
                    <input type="submit" value="ENVIAR" class="btn boton">
                     <div class="error"><?php echo $mensajeError; ?></div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-2"><a href="index" class="btn btn-info">Volver al login</a></div>
        </div>
    </div>
</body>
</html>  