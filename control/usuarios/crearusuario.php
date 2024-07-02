<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(2, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('./functions/validaciones.php');
    $mensaje = "";
    if($_POST){
        $nombre = sanearCadena($_POST['nombre']);
        $mail = sanearCadena($_POST['mail']);
        $pass = base64_encode($_POST['pass']);
        $roles = $_POST['roles'];
        $activo = 0;
        if(isset($_POST['activo'])){
            $activo = $_POST['activo'];
        } 
       
        //validaciones
        $mensaje .= comprobarMail($mail);
        if(in_array(3, $roles)){
            $cif = sanearCadena($_POST['cif']);
            $telefonos[] = sanearCadena($_POST['telefono1']);
            $telefonos[] = sanearCadena($_POST['telefono2']);
            $pais = sanearCadena($_POST['pais']);
            $poblacion = sanearCadena($_POST['poblacion']);
            $provincia = sanearCadena($_POST['provincia']);
            $cp = sanearCadena($_POST['cp']);
            $direccion = sanearCadena($_POST['direccion']);
            if($cif == "" || $pais == "" || $poblacion == "" || $provincia == "" || $cp == "" || $direccion == ""){
                $mensaje.="tiene que rellenar todos los campos";
            }
            $mensaje .= comprobarCif($_POST['cif']);
           
        }else{
            $cif = "";
            $telefonos[] = "";
            $pais = "";
            $poblacion = "";
            $provincia = "";
            $cp = "";
            $direccion = "";
        }
        if($mensaje == ""){
            //aqui guardamos y redirigimos
            $id = guardarUsuarios($nombre, $mail, $activo, $pass);
            guardarRoles($roles, $id);
            guardarDatosCliente($cif, $pais, $poblacion, $provincia, $cp, $direccion, $id);
            guardarTelefonosCliente($telefonos, $id);
            $rutaCarpeta = '../../assets/archivos/' . $id;

            // Verificar si la carpeta ya existe
            if (!is_dir($rutaCarpeta)) {
                // Intentar crear la carpeta
                if (mkdir($rutaCarpeta)) {
                    //echo 'La carpeta se ha creado correctamente.';
                } else {
                    //echo 'Error al intentar crear la carpeta.';
                }
            } else {
                //echo 'La carpeta ya existe.';
            }
            ?>
            <script>window.location ="index";</script>
            <?php
        }else{
            //seguimos mostrando los errores  
        }
    
    }
    cabecera('Crear Usuario');
    navegador();
    ?>
        <div class="container-fluid">
            <div class="row">
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Crear Usuario</h1>
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
                                                        <label>Nombre</label>
                                                            <input type="text" name="nombre" id="nombre" <?php if($_POST){echo "value='$nombre'";}?> class="form-control" required>   
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                            <input type="email" name="mail" id="mail" class="form-control" <?php if($_POST){echo "value='$mail'";}?> required>   
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Tipo</label>
                                                        <select id="rol" name="roles[]" class="selectpicker form-control" multiple data-live-search="true">
                                                            <?php roles(); ?>
                                                        </select>
                                                    </div>
                                                </div>
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
                                                    <input name="activo" id="activo" type="checkbox" value="1" checked> Activo
                                                </label>
                                                </div>
                                            </div>
                                            <div id="cliente" hidden>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>CIF</label>
                                                                <input type="text" name="cif" id="cif" <?php if($_POST){echo "value='$cif'";}?> class="form-control">   
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Teléfono 1</label>
                                                                <input type="text" name="telefono1" id="telefono1" <?php if($_POST){echo "value='$telefonos[0]'";}?> class="form-control">   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Teléfono 2</label>
                                                                <input type="text" name="telefono2" id="telefono2" <?php if($_POST){echo "value='$telefonos[1]'";}?> class="form-control">   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                            <label>País</label>
                                                                <input type="text" name="pais" id="pais" <?php if($_POST){echo "value='$pais'";}?> class="form-control">   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Población</label>
                                                                <input type="text" name="poblacion" id="poblacion" <?php if($_POST){echo "value='$poblacion'";}?> class="form-control">   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Provincia</label>
                                                                <input type="text" name="provincia" id="provincia" <?php if($_POST){echo "value='$provincia'";}?> class="form-control">   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>CP</label>
                                                                <input type="text" name="cp" id="cp" <?php if($_POST){echo "value='$cp'";}?> class="form-control">   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label>Dirección</label>
                                                                <input type="text" name="direccion" id="direccion" <?php if($_POST){echo "value='$direccion'";}?> class="form-control">   
                                                        </div>
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
    <script>
        $('select').selectpicker();  
    </script>
    <?php
    pie();
}else{
    header('Location: ../index.php');
}