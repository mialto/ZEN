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
        $telefonos_usuario = obtenerTelefonosUsuario($id);
        $roles_usuario = obtenerRolesUsuario($id);
    }
    if($_POST){
        $nombre = sanearCadena($_POST['nombre']);
        $mail = sanearCadena($_POST['mail']);
        $roles = $_POST['roles'];
        //$pass = base64_encode($_POST['pass']);
        $cif = "";
        $telefonos[] = "";
        $telefonos[] = "";
        $pais = "";
        $poblacion = "";
        $provincia = "";
        $cp = "";
        $direccion = "";
        $fechaBoda = "";
        $lugarBoda = "";
        $activo = 0;

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


        if(isset($_POST['activo'])){
            $activo = $_POST['activo'];
        } 
        if(isset($_POST['activo'])){
            $activo = $_POST['activo'];
        } 
        //validaciones
        //$mensaje .= comprobarMail($mail);
        //echo "<pre>" . print_r($_POST, true) . "</pre>";
        /*if(in_array(3, $roles)){
            $cif = sanearCadena($_POST['cif']);
            $telefonos[] = sanearCadena($_POST['telefono1']);
            $telefonos[] = sanearCadena($_POST['telefono2']);
            $pais = sanearCadena($_POST['pais']);
            $poblacion = sanearCadena($_POST['poblacion']);
            $provincia = sanearCadena($_POST['provincia']);
            $cp = sanearCadena($_POST['cp']);
            $direccion = sanearCadena($_POST['direccion']);
            $fechaBoda = sanearCadena($_POST['fecha_boda']);
            $lugarBoda = sanearCadena($_POST['lugar_boda']);
            if($cif == "" || $pais == "" || $poblacion == "" || $provincia == "" || $cp == "" || $direccion == ""){
                $mensaje.="tiene que rellenar todos los campos";
            }
            //$mensaje .= comprobarCif($_POST['cif']);
        }else{
            $cif = "";
            $telefonos[] = "";
            $pais = "";
            $poblacion = "";
            $provincia = "";
            $cp = "";
            $direccion = "";
        }*/
        if($mensaje == ""){
            modificarUsuarios($nombre, $mail, $activo, $id);
            //modificarRoles($roles, $id);
            modificarDatosCliente($cif, $pais, $poblacion, $provincia, $cp, $direccion, $id);
            modificarTelefonosCliente($telefonos, $id);
            
            ?>
            <script>window.location ="index";</script>
            <?php
        }else{
            //seguimos mostrando los errores  
        }
    
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
                                <h1 class="page-header">Editar Usuario</h1>
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
                                                            <input type="text" name="nombre" id="nombre" value="<?=$datos_usuario['nombre'];?>" class="form-control">   
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                            <input type="email" name="mail" id="mail" class="form-control" value="<?=$datos_usuario['email'];?>">
                                                            
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <!--<select id="rol" name="roles[]" class="selectpicker form-control" multiple data-live-search="true">
                                                            
                                                            <?php roles($roles_usuario); ?>
                                                        </select>-->
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <!--<label>Password <small>8 digitos, una mayuscula una minuscula, un número y un caracter especial</small></label>
                                                            <input type="text" name="pass" id="pass" class="form-control" <?php if($_POST){echo "value='$mail'";}?> pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required> -->  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                <label>
                                                    <?php
                                                    if($datos_usuario['activo'] == 1){
                                                       echo '<input name="activo" id="activo" type="checkbox" value="1" checked> Activo'; 
                                                    }else{
                                                        echo '<input name="activo" id="activo" type="checkbox" value="0" > No Activo';
                                                    }
                                                    ?>
                                                    
                                                </label>
                                                </div>
                                            </div>
                                            <?php 
                                            //echo "<pre" .print_r($roles_usuario, true) . "</pre>";
                                            if(in_array('cliente', $roles_usuario)){
                                                echo '<div id="cliente">';
                                            }else{
                                                echo '<div id="cliente" hidden>';
                                            }
                                            ?>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>CIF</label>
                                                                <input type="text" name="cif" id="cif" value="<?=$datos_usuario['cif'];?>"  class="form-control">   
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Teléfono 1</label>
                                                                <input type="text" name="telefono1" id="telefono1" value="<?php if(isset($telefonos_usuario[0])){echo $telefonos_usuario[0];}?>" class="form-control">   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Teléfono 2</label>
                                                                <input type="text" name="telefono2" id="telefono2" value="<?php if(isset($telefonos_usuario[1])){echo $telefonos_usuario[1];}?>" class="form-control">   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                            <label>País</label>
                                                                <input type="text" name="pais" id="pais" value="<?=$datos_usuario['pais'];?>" class="form-control">   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Población</label>
                                                                <input type="text" name="poblacion" id="poblacion" value="<?=$datos_usuario['poblacion'];?>" class="form-control">    
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Provincia</label>
                                                                <input type="text" name="provincia" id="provincia" value="<?=$datos_usuario['provincia'];?>" class="form-control">   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>CP</label>
                                                                <input type="text" name="cp" id="cp" value="<?=$datos_usuario['cp'];?>" class="form-control">   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label>Dirección</label>
                                                                <input type="text" name="direccion" id="direccion" value="<?=$datos_usuario['direccion'];?>" class="form-control">   
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
    <?php
    pie();
}else{
    header('Location: ../index.php');
}