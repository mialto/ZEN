<?php
session_start();
if(!isset($_SESSION['intentosInicio'])){
    $_SESSION['intentosInicio'] = 1;
}
$mensajeError = "";
if($_POST){
    $mail = $_POST['mail'];
    $pass = base64_encode($_POST['pass']);
    include('../app/conexion.php');
    $mysqli = conexion();
    $sentencia = "SELECT * FROM users WHERE email='$mail' AND clave='$pass' AND activo=1";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>: " . $mysqli->error . "\n";
        exit;
    }
    $numfilas = $resultado->num_rows;
    /*var_dump($numfilas);
    echo "<pre>" . print_r($sentencia,true) . "</pre>";*/
    if($numfilas>0){
        while($fila = $resultado->fetch_array()) {
            //aqui hay q crear la sesion!!!
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['email'] = $fila['email'];
            $_SESSION['id'] = $fila['id'];
            $_SESSION['activo'] = $fila['activo'];
            //$_SESSION['rol'] = $fila['id_rol'];
            $_SESSION['roles'] = array();
            $_SESSION['acceso'] = 'permitido';
            $roles = "SELECT * FROM users_roles WHERE id_user = " . $_SESSION['id'] ."";
            if(!($resultado2 = $mysqli->query($roles))) {
                echo "Error al ejecutar la sentencia <b>$roles</b>: " . $mysqli->error . "\n";
                exit;
            }
            while($fila2 = $resultado2->fetch_array()) {
                $_SESSION['roles'][] = $fila2['id_rol'];
            }
            $logFile = fopen("logAccesosAdmin.txt", 'a') or die("Error creando archivo");
            $fecha = new DateTime(); 
            $fecha->modify('+2 hours');
            fwrite($logFile, "\n" . $fecha->format('d-m-Y H:i:s') . " El usuario " . $_SESSION['nombre'] . "  " . $_SESSION['id'].  " ha iniciado sesión" ) or die("Error escribiendo en el archivo");fclose($logFile);  
            ?>
            <script>
                window.location='./panel/';
            </script>
            <?php
        }
    }else{
        $_SESSION['intentosInicio']++;
        $mensajeError = "No hay ningun usuario activo con su mail y contraseña, inténtelo de nuevo, si su problema continua contacte con nosotros " . $_SESSION['intentosInicio'];
        if($_SESSION['intentosInicio'] >= 4){
            echo "<br>". $_SESSION['intentosInicio'];
            $hora = date('B');
            $fin = $hora + 30;
            $_SESSION['fin']=$fin;
            ?>
            <script>
                window.location='index.php?mensajeError=Se le ha restringido el acceso durante 30 minutos por reiterados intentos de acceso';
            </script>
            <?php
        }
    }  
    $resultado->close();
    $mysqli->close();
}
if(isset($_GET['mensajeError'])){
    $mensajeError = $_GET['mensajeError'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dale al play</title>
    <!--Introducir el css-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <!--Introducir el javascript-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../assets/css/frontcss.css">
    <style>
    </style>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <center><img src="../assets/images/logo.png" class="img-fluid"/></center>
                <center><h3>Acceso de administrador</h3></center>
                <form method="POST" action="#">
                    <div class="campo">
                        <input type="email" name="mail" id="email" placeholder="email" class="input_login">
                    </div>
                    <div class="campo">
                        <input type="password" name="pass" id="pass" placeholder="password" class="input_login">
                    </div>
                    <input type="submit" value="ENTRAR" class="btn boton">
                </form>
                <div class="error"><?php echo $mensajeError; ?></div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </div>
</body>
</html>   