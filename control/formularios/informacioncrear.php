<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(2, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('./functions/validaciones.php');
    $mensaje = "";
    if($_POST){
        $nombre = sanearCadena($_POST['nombre']);
        $cp = sanearCadena($_POST['cp']);
        $localidad = sanearCadena($_POST['localidad']);
        $calidad = sanearCadena($_POST['calidad']);
        $pPiso = sanearCadena($_POST['precioPiso']);
        $pHabitacion = sanearCadena($_POST['precioHabitacion']);
        $fecha = date('Y-m-d-H:i');
        //validaciones
        if($mensaje == ""){
            //aqui guardamos y redirigimos
            guardarBarrio($nombre, $cp, $localidad, $calidad, $fecha, $pPiso, $pHabitacion);
            ?>
            <script>window.location ="barrios";</script>
            <?php
        }else{
            //seguimos mostrando los errores  
        }
    
    }
    cabecera('Crear Barrio');
    navegador();
    ?>
        <div class="container-fluid">
            <div class="row">
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Crear Campo de Información</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="informacion" type="button" class="btn btn-success">Volver</a>
                            </div>
                        </div>
                        <!-- /.row -->
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="" method="POST">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Nombre del campo</label>
                                                    <input type="text" name="nombre" id="nombre" <?php if($_POST){echo "value='$nombre'";}?> class="form-control" required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tipo del campo</label>
                                                    <input type="text" name="cp" id="cp" <?php if($_POST){echo "value='$cp'";}?> class="form-control" required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Localidad</label>
                                                <?php //listadoLocalidades() ;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Tipo de campo</label>
                                                <select required name="calidad" class="form-control">
                                                    <option value="" disabled selected>Elige calidad</option>
                                                    <option value="mala">Mala</option>
                                                    <option value="buena">Buena</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Precio medio piso</label>
                                                    <input type="text" name="precioPiso" id="precioPiso" class="form-control">   
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Precio medio habitacion</label>
                                                    <input type="text" name="precioHabitacion" id="precioHabitacion" class="form-control">   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                        No poner precio de barrios chungos
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
                        </div>
                        
                   
                    </div><!-- /.container-fluid -->
                </div><!-- IMPORTANT -->
            </div><!-- IMPORTANT -->
        </div><!-- IMPORTANT -->
    </div><!-- /#wrapper este siempre tiene q estar q abre en el navegador-->
    <script>
        $('select').selectpicker();
        
    </script>
    <?php
    pie();
}else{
    header('Location: ../index.php');
}