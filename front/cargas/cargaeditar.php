<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('./functions/validaciones.php');
    $mensaje = "";
    if($_GET){
        $id=$_GET['id'];
        $datos = datosCarga($id);
        $datosSub = datosSubcarga($id);
        $numero = $datos['num_animales'];
        $tara = $datos['peso_tara'];
        $pesoTotal =$datos['peso_con_animales'];

    }
    if($_POST){
        //unlink("../../assets/tickets/" . $datos['ticket']);
        //unlink("../../assets/guias/" . $datos['guia']);
        $id=$_GET['id'];
        $fecha = sanearCadena($_POST['fecha']);
        $poblacion = sanearCadena($_POST['poblacion']);
        $provincia = sanearCadena($_POST['provincia']);
        $empresa = sanearCadena($_POST['empresa']);
        $numero = sanearCadena($_POST['numero']);
        $tara = sanearCadena($_POST['tara']);
        $pesoAnimales = sanearCadena($_POST['peso_animales']);
        //$explotacion = sanearCadena($_POST['explotacion']);
        $eTransportes = sanearCadena($_POST['transportes']);
        $camion = sanearCadena($_POST['camion']);
        $camionero = sanearCadena($_POST['camionero']);
        $matadero = sanearCadena($_POST['matadero']);
        $fechaGuardado = date('Y-m-d-H:i');
        $categoria = sanearCadena($_POST['categoria']);
        $alimentacion = "S/D";
        $raza= "S/D";
        $explotaciones = array();
        $explotaciones[] = $_POST['explotacion1'];
        $explotaciones[] = $_POST['explotacion2'];
        $explotaciones[] = $_POST['explotacion3'];
        $explotaciones[] = $_POST['explotacion4'];
        $explotaciones[] = $_POST['explotacion5'];
        

        $id_carga = $datos['id'];

        if($categoria == "Con norma" || $categoria == "Reproductoras con norma"){
            $raza = sanearCadena($_POST['raza']);
            $alimentacion = sanearCadena($_POST['alimentacion']);
        }
        
        if($mensaje == ""){
            $contador = 1;
            foreach ($explotaciones as $explotacion){
                $id_explotacion = $explotacion;
                $ticket = "";
                $guia = "";
                if($explotacion != ''){
                    echo "existo $id_explotacion";
                    $archivoTicket = comprobarArchivo($id_carga, $id_explotacion, 'ticket');
                    $archivoGuia = comprobarArchivo($id_carga, $id_explotacion, 'guia');
                    $idSubcarga = comprobarSubcarga($id_carga, $explotacion);
                    echo "$archivoTicket --- $archivoGuia --- $idSubcarga";
                    if($idSubcarga == ""){
                        //aqui se crean las subcargas
                        $nombre = $_FILES['ticket'.$contador]['name'];
                        $file_size = $_FILES['ticket'.$contador]['size'];
                        $file_tmp = $_FILES['ticket'.$contador]['tmp_name'];
                        $file_type = $_FILES['ticket'.$contador]['type'];
                        $temp = explode('/', $file_type);
                        $extension = end($temp);
                        if($nombre != ""){
                            $ticket = "ticket-" . $fecha . "-" . $nombre . "." . $extension;   
                        } 
                        if($file_size > 6097152) {
                        $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                        }       
                        if(empty($errors)==true) {
                            $url = "../../assets/tickets/".$ticket;
                            move_uploaded_file($file_tmp, $url);
                        }
                        $nombre = $_FILES['guia'.$contador]['name'];
                        $file_size = $_FILES['guia'.$contador]['size'];
                        $file_tmp = $_FILES['guia'.$contador]['tmp_name'];
                        $file_type = $_FILES['guia'.$contador]['type'];
                        $temp = explode('/', $file_type);
                        $extension = end($temp);
                        $guia = "";
                        if($nombre != ""){
                            $guia = "guia-" . $fecha . "-" . $nombre . "." . $extension;
                        }
                            
                        if($file_size > 6097152) {
                        $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                        }       
                        if(empty($errors)==true) {
                            $url = "../../assets/guias/".$guia;
                            move_uploaded_file($file_tmp, $url);
                        }
                        guardarSubcarga($id_carga, $ticket, $guia, $id_explotacion);
                        
                    }elseif($idSubcarga != ""){
                        //aqui se modifican las subcargas
                        if($_FILES["ticket$contador"]['name'] != ''){
                            if($archivoTicket != ''){
                                unlink("../../assets/tickets/" . $archivoTicket);
                                //guardar el nuevo archivo
                            }
                            $nombre = $_FILES['ticket'.$contador]['name'];
                            $file_size = $_FILES['ticket'.$contador]['size'];
                            $file_tmp = $_FILES['ticket'.$contador]['tmp_name'];
                            $file_type = $_FILES['ticket'.$contador]['type'];
                            $temp = explode('/', $file_type);
                            $extension = end($temp);
                            if($nombre != ""){
                                $ticket = "ticket-" . $fecha . "-" . $nombre . "." . $extension;   
                            } 
                            if($file_size > 6097152) {
                            $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                            }       
                            if(empty($errors)==true) {
                                $url = "../../assets/tickets/".$ticket;
                                move_uploaded_file($file_tmp, $url);
                            }
                            
                        }
                        else{
                            $ticket = $archivoTicket;
                        }
                        
                        if($_FILES["guia$contador"]['name'] != ''){
                            if($archivoGuia != ''){
                                unlink("../../assets/guias/" .$archivoGuia);
                                //guardar el nuevo archivo
                            }
                            $nombre = $_FILES['guia'.$contador]['name'];
                            $file_size = $_FILES['guia'.$contador]['size'];
                            $file_tmp = $_FILES['guia'.$contador]['tmp_name'];
                            $file_type = $_FILES['guia'.$contador]['type'];
                            $temp = explode('/', $file_type);
                            $extension = end($temp);
                            $guia = "";
                            if($nombre != ""){
                                $guia = "guia-" . $fecha . "-" . $nombre . "." . $extension;
                            }
                                
                            if($file_size > 6097152) {
                            $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                            }       
                            if(empty($errors)==true) {
                                $url = "../../assets/guias/".$guia;
                                move_uploaded_file($file_tmp, $url);
                            }
                            

                        }else{
                            $guia = $archivoGuia;
                        }
                        modificarSubcarga($idSubcarga, $id_carga, $id_explotacion, $guia, $ticket);
                    }
                }else{
                    
                }
                
                $contador++;
                
            }


            //aqui guardamos y redirigimos
            modificarCarga($id, $fecha, $provincia, $poblacion, $empresa, $raza, $numero, $tara, $pesoAnimales, $eTransportes, $camion, $camionero, $matadero, $fechaGuardado, $categoria, $alimentacion);
            ?>
            <script>window.location ="index";</script>
            <?php
        }else{
            //seguimos mostrando los errores  
        }
    
    }
    cabecera('Crear Carga');
    navegador();
    ?>
        <div class="container-fluid">
            <div class="row">
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">Editar Carga <?=$datos['id']?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="index" type="button" class="btn btn-success">Volver</a>
                                <?php
                                  // echo "<pre>" . print_r($datos, true) . "</pre>";
                                ?>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="errores"><?php echo $mensaje; ?></p>
                            </div>
                        </div>
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Fecha de la carga</label>
                                                    <input type="date" name="fecha" id="fecha" value="<?=$datos['fecha']?>" class="form-control" required>
                                                       
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Provincia Origen</label>
                                                <?php provincias($datos['provincia']);?>    
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Población</label>
                                                    <input type="text" name="poblacion" id="poblacion" value="<?=$datos['poblacion']?>" class="form-control" required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Empresa Integradora</label>
                                                <?php listadoEmpresasIntegradoras($datos['id_empresa_integradora']);?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Categoria</label>
                                                <?php listadoCategorias($datos['categoria']);?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Número de animales</label>
                                                    <input type="number" name="numero" id="numero" value="<?=$numero;?>" class="form-control" min="0" value="0" required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Peso tara</label>
                                                    <input type="number" name="tara" id="tara" value="<?=$tara;?>" class="form-control" min="0" value="0" step="0.01"required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Peso con animales</label>
                                                    <input type="number" name="peso_animales" id="peso_animales" value="<?=$pesoTotal?>" class="form-control" min="0" value="0" required>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                        <div class="form-group">
                                                <label>Matadero</label>
                                                <?php listadoMataderos($datos['id_matadero']);?>  
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Empresa Transporte</label>
                                                <?php listadoEmpresasTransportes($datos['id_empresa_transportes']);?>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="transporte">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Camión</label>
                                                <?php listadoCamiones($datos['id_empresa_transportes'], $datos['id_camion']);?>  
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Camionero</label>
                                                <?php listadoCamioneros($datos['id_empresa_transportes'], $datos['id_camionero']);?>  
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div id="resultados"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="datos_animales">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Alimentacion</label>
                                                <?php selectAlimentacion($datos['alimentacion']);?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Tipo Racial</label>
                                                <?php listadoRazas($datos['raza']);?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            Las subcargas que tienen asignado un ticket o una guía no tienen por que asignarsele de nuevo, el sistema tomará por defecto las cargadas. Pero si se carga una imagen nueva, está se cargará en el sistema sustituyendo a la anterior
                                        </div>
                                    </div>
                                    <?php 
                                    //hay que crear una funcion nueva que sea la que se traiga los datos y modifique y toda la pesca!!!
                                    pintarSubcargasEditar($datosSub);?>
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
        $('#transportes').on('change', function (){
            //alert("hola");
            var url = "cambiar.php";//dirección url del archivo que ejecuta datos
            var id_transportes = $(this).val();
            var parametros ={
                "id_transportes" : id_transportes,
            };
            $.ajax({
                data: parametros,
                url: url,
                type: 'post',
                beforeSend: function () {//elemento que queramos poner mientras ajax carga
                    $("#transporte").html("Procesando, espere por favor...");
                },
                success: function (response) {//resultado de la función
                    $("#transporte").html(response);
                }
            });
        });
        $('#empresa_integradora').on('change', function (){
            //alert("hola");
            var url = "cambiar.php";//dirección url del archivo que ejecuta datos
            var id_empresa = $(this).val();
            var parametros ={
                "id_empresa" : id_empresa
            };
            $.ajax({
                data: parametros,
                url: url,
                type: 'post',
                beforeSend: function () {//elemento que queramos poner mientras ajax carga
                    $("#explotaciones").html("Procesando, espere por favor...");
                },
                success: function (response) {//resultado de la función
                    $("#explotaciones").html(response);
                }
            });
        });
        $('#categoria').on('change', function (){
            var url = "cambiar.php";//dirección url del archivo que ejecuta datos
            var categoria = $(this).val();
            var parametros ={
                "categoria" : categoria
            };
            $.ajax({
                data: parametros,
                url: url,
                type: 'post',
                beforeSend: function () {//elemento que queramos poner mientras ajax carga
                    $("#datos_animales").html("Procesando, espere por favor...");
                },
                success: function (response) {//resultado de la función
                    $("#datos_animales").html(response);
                }
            });
        });
        
    </script>
    <?php
    pie();
}else{
    header('Location: ../index.php');
}