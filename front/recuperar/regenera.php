<?php
include('./service/functions.php');
if($_POST){
    $pass = base64_encode($_POST['pass']);
    $fecha = date('Y-m-d H:i');
    $mysqli = conexion();
    $sentencia = "UPDATE users SET clave='$pass', updated_at='$fecha'";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
        exit;
    }
    $sentencia = "UPDATE cambiar_pass SET modificado=1, updated_at='$fecha'";
    if(!($resultado = $mysqli->query($sentencia))) {
        echo "Error al ejecutar la sentencia <b>$sentencia</b>;: " . $mysqli->error . "\n";
        exit;
    }
    // Libera la memoria ocupada por el resultado
    $mysqli->close();
    ?>
    <script>window.location='../../index?mensajeError=Su clave ha sido cambiada con exito';</script>
    <?php
    
}
include('../layout/layout.php');
cabecera('Regenerar clave');
?>
<div class="row mt-5">
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
    <img src="https://espaalfood.es/wp-content/uploads/2022/03/cropped-espaalfood-logo.png" class="img-fluid"/>
        <?php
        if($_GET){
            if(isset($_GET['mail']) && $_GET['token']){
                
                $existe = comprobarGet($_GET['mail'], $_GET['token']);
                //controlar los valorez  0 1 y 2 para el formulario!
                if($existe == 0){
                    echo "Lo sentimos pero no existen credenciales para su cambio de contraseña, <br>Esto puede ser debido a que su token ya ha sido usado, realice de nuvo el proceso y si el error permanece, pongase en contacto con soporte.";
                }elseif($existe == 1){
                    echo "El tiempo de 5 horas para cambiar su contraseña ha caducado, por favor vuelva a requerir que se le envie el mail.";
                }elseif($existe == 2){
                    ?>
                    <form method="POST" action="">
                        <input type="text" name="mail" value="<?php echo $_GET['mail']?>" hidden>
                        <div class="campo">
                            <label for="pass">Intorduzca una contraseña<br><small>El formato debe de tener Una letra mayúsculas, una minuscula un número un caracter especial y mínimo 8 caracteres</small></label>
                            <input type="password" name="pass" id="pass" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
                        </div>
                        <div class="campo">
                        <label for="pass">Repita la contraseña</label>
                            <input type="password" name="passCopy" id="passCopy" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" onkeyup=comparaCampos()>
                        </div>
                        <input type="submit" id="enviar" disabled value="Canviar clave" class="btn boton">
                    </form>
                    <div id="error" style="color:red"></div>
                    <?php
                }
            }else{
                echo "Datos incorrectos, pongase en contacto con soporte";
            }
        }else{
        echo "No tiene permisos para acceder a esta página.";
        }
        ?>
    </div>
    <div class="col-lg-4"></div>
</div>
<script>
function comparaCampos(){
    var campo1 = document.getElementById('pass').value;
    var campo2 = document.getElementById('passCopy').value;
    if(campo1 != campo2){
        document.getElementById('error').innerHTML='Los campos no coinciden';  
        document.getElementById("enviar").disabled = true;
    }else{
        document.getElementById('error').innerHTML='';
        document.getElementById("enviar").disabled = false;
    }

}
</script>
<?php
pie();
