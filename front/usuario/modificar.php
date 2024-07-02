<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(3, $_SESSION['roles']) || isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('./functions/validaciones.php');
    //include ('../../app/functions.php');
    $id = $_SESSION['id'];
    $mensaje= "";
    if($_POST){
        
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
    
        if($mensaje == ""){
            modificarDatosCliente($cif, $pais, $poblacion, $provincia, $cp, $direccion, $id);
            modificarTelefonosCliente($telefonos, $id);
            
            ?>
            <script>window.location ="../index/";</script>
            <?php
        }else{
            //seguimos mostrando los errores  
        }
    
    }
    $datos_usuario = obtenerDatosUsuario($id);
    $telefonos_usuario = obtenerTelefonosUsuario($id);
    //$roles_usuario = obtenerRolesUsuario($id);
    cabecera('Constructor de eventos');
    navegador();
    
    ?>
    <!-- Page Content -->
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
                                            <label>Nombre: <?=$datos_usuario['nombre'];?></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Email: <?=$datos_usuario['email'];?></label>
                                        </div>
                                    </div>
                                
                                </div>
                                <div id="cliente">
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
                   
                    
        </div>
    </div>


<?php
    pie();
}else{
    ?>
    <script>
        window.location='../../';
    </script>
    <?php
}