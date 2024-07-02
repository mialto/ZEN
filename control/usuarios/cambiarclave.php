<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(2, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('./functions/validaciones.php');
    $mensaje = "";
    if($_GET){
        $id = $_GET['id'];
        $datos_usuario = obtenerDatosUsuario($id);
    }
    if($_POST){
        $pass = base64_encode($_POST['pass']);
        $id = cambiarClave($id, $pass);
        ?>
        <script>window.location ="index";</script>
        <?php
    }
    cabecera('Editar Usuario');
    navegador();
    ?>
        <div class="container-fluid">
            <div class="row">
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Editar Clave de usuario <?=$datos_usuario['email'];?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="index" type="button" class="btn btn-success">Volver</a>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <br>
                                <p class="errores"><?php echo $mensaje; ?></p>
                                <br>
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                        <form action="" method="POST">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Password <small>8 digitos, una mayuscula una minuscula, un número y un caracter especial</small></label>
                                                            <input type="text" name="pass" id="pass" class="form-control" <?php if($_POST){echo "value='$mail'";}?> pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                <label>
                                                <input type="submit" value="ENVIAR" class="btn boton">
                                                </label>
                                                </div>
                                            </div>
                                       </form>
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                   
                    </div><!-- /.container-fluid -->
                </div><!-- IMPORTANT -->
            </div><!-- IMPORTANT -->
        </div><!-- IMPORTANT -->
    </div><!-- /#wrapper este siempre tiene q estar q abre en el navegador-->

        
        
       


    <script>
        var select = document.getElementById('rol');
        select.addEventListener('change',
        function(){
            const selected = document.querySelectorAll('#rol option:checked');
            const values = Array.from(selected).map(el => el.value);
            if(values.includes('3')){
                document.getElementById('cliente').removeAttribute("hidden");
            }else{
                document.getElementById('cliente').setAttribute("hidden", "");
            }
            
        });
    </script>
    <?php
    pie();
}else{
    header('Location: ../index.php');
}