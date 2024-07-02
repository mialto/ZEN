<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('./functions/validaciones.php');
    $mensaje = "";
    if($_POST){
        $id=$_SESSION['id'];
        $fecha = sanearCadena($_POST['fecha']);
        $poblacion = sanearCadena($_POST['poblacion']);
        $provincia = sanearCadena($_POST['provincia']);
        $empresa = sanearCadena($_POST['empresa']);
        $numero = sanearCadena($_POST['numero']);
        $tara = sanearCadena($_POST['tara']);
        $pesoAnimales = sanearCadena($_POST['peso_animales']);
        $explotacion = sanearCadena($_POST['explotacion']);
        $eTransportes = sanearCadena($_POST['transportes']);
        $camion = sanearCadena($_POST['camion']);
        $camionero = sanearCadena($_POST['camionero']);
        $matadero = sanearCadena($_POST['matadero']);
        $fechaGuardado = date('Y-m-d-H:i');
        $categoria = sanearCadena($_POST['categoria']);
        $alimentacion = "S/D";
        $raza= "S/D";
        $explotacion = sanearCadena($_POST['explotacion']);
        $ticket="";
        $guia="";
        $explotacion2 = "";
        $ticket2="";
        $guia2="";
        $explotacion3 = "";
        $ticket3="";
        $guia3="";
        $explotacion4 = "";
        $ticket4="";
        $guia4="";
        $explotacion5 = "";
        $ticket5="";
        $guia5="";

        $subcargas = $_POST['subcargas'];
        if($categoria == "Con norma" || $categoria == "Reproductoras con norma"){
            $raza = sanearCadena($_POST['raza']);
            $alimentacion = sanearCadena($_POST['alimentacion']);
        }

        if($subcargas == 'si'){
            echo "tenemos subcarga";
            if($_POST['explotacion2'] != ''){
                $explotacion2 = $_POST['explotacion2'];
                $nombre2 = $_FILES['ticket2']['name'];
                $file_size2 = $_FILES['ticket2']['size'];
                $file_tmp2 = $_FILES['ticket2']['tmp_name'];
                $file_type2 = $_FILES['ticket2']['type'];
                $temp2 = explode('/', $file_type2);
                $extension2 = end($temp2);
                if($nombre2 != ""){
                    $ticket2 = "ticket-" . $fecha . "-" . $nombre2 . "." . $extension2;   
                } 
                if($file_size2 > 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url2 = "../../assets/tickets/".$ticket2;
                    move_uploaded_file($file_tmp2, $url2);
                }
                $nombre2 = $_FILES['guia2']['name'];
                $file_size2 = $_FILES['guia2']['size'];
                $file_tmp2 = $_FILES['guia2']['tmp_name'];
                $file_type2 = $_FILES['guia2']['type'];
                $temp2 = explode('/', $file_type2);
                $extension2 = end($temp2);
                $guia2 = "";
                if($nombre2 != ""){
                    $guia2 = "guia-" . $fecha . "-" . $nombre2 . "." . $extension2;
                }
                    
                if($file_size2 > 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url2 = "../../assets/guias/".$guia2;
                    move_uploaded_file($file_tmp2, $url2);
                }
            }
            if($_POST['explotacion3'] != ''){
                $explotacion3 = $_POST['explotacion3'];
                $nombre3 = $_FILES['ticket3']['name'];
                $file_size3 = $_FILES['ticket3']['size'];
                $file_tmp3 = $_FILES['ticket3']['tmp_name'];
                $file_type3 = $_FILES['ticket3']['type'];
                $temp3 = explode('/', $file_type3);
                $extension3 = end($temp3);
                if($nombre3 != ""){
                    $ticket3 = "ticket-" . $fecha . "-" . $nombre3 . "." . $extension3;   
                } 
                if($file_size3 > 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url3 = "../../assets/tickets/".$ticket3;
                    move_uploaded_file($file_tmp3, $url3);
                }
                $nombre3 = $_FILES['guia3']['name'];
                $file_size3 = $_FILES['guia3']['size'];
                $file_tmp3 = $_FILES['guia3']['tmp_name'];
                $file_type3 = $_FILES['guia3']['type'];
                $temp3 = explode('/', $file_type3);
                $extension3 = end($temp3);
                $guia3 = "";
                if($nombre3 != ""){
                    $guia3 = "guia-" . $fecha . "-" . $nombre3 . "." . $extension3;
                }
                    
                if($file_size3 > 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url3 = "../../assets/guias/".$guia3;
                    move_uploaded_file($file_tmp3, $url3);
                }
            }
            if($_POST['explotacion4'] != ''){
                $explotacion4 = $_POST['explotacion4'];
                $explotacion4 = $_POST['explotacion4'];
                $nombre4 = $_FILES['ticket4']['name'];
                $file_size4 = $_FILES['ticket4']['size'];
                $file_tmp4 = $_FILES['ticket4']['tmp_name'];
                $file_type4 = $_FILES['ticket4']['type'];
                $temp4= explode('/', $file_type4);
                $extension4 = end($temp4);
                if($nombre4 != ""){
                    $ticket4 = "ticket-" . $fecha . "-" . $nombre4 . "." . $extension4;   
                } 
                if($file_size34> 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url4 = "../../assets/tickets/".$ticket4;
                    move_uploaded_file($file_tmp4, $url4);
                }
                $nombre4 = $_FILES['guia4']['name'];
                $file_size4 = $_FILES['guia4']['size'];
                $file_tmp4 = $_FILES['guia4']['tmp_name'];
                $file_type4 = $_FILES['guia4']['type'];
                $temp4 = explode('/', $file_type4);
                $extension4 = end($temp4);
                $guia4 = "";
                if($nombre4 != ""){
                    $guia4 = "guia-" . $fecha . "-" . $nombre4 . "." . $extension4;
                }
                    
                if($file_size4 > 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url4 = "../../assets/guias/".$guia4;
                    move_uploaded_file($file_tmp4, $url4);
                }
            }
            if($_POST['explotacion5'] != ''){
                $explotacion5 = $_POST['explotacion5'];
                $explotacion5 = $_POST['explotacion5'];
                $nombre5 = $_FILES['ticket5']['name'];
                $file_size5 = $_FILES['ticket5']['size'];
                $file_tmp5 = $_FILES['ticket5']['tmp_name'];
                $file_type5 = $_FILES['ticket5']['type'];
                $temp5 = explode('/', $file_type5);
                $extension5 = end($temp5);
                if($nombre5 != ""){
                    $ticket5 = "ticket-" . $fecha . "-" . $nombre5 . "." . $extension5;   
                } 
                if($file_size5 > 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url5 = "../../assets/tickets/".$ticket5;
                    move_uploaded_file($file_tmp5, $url5);
                }
                $nombre5 = $_FILES['guia5']['name'];
                $file_size5 = $_FILES['guia5']['size'];
                $file_tmp5 = $_FILES['guia5']['tmp_name'];
                $file_type5 = $_FILES['guia5']['type'];
                $temp5 = explode('/', $file_type5);
                $extension5 = end($temp5);
                $guia5 = "";
                if($nombre5 != ""){
                    $guia5 = "guia-" . $fecha . "-" . $nombre5 . "." . $extension5;
                }
                    
                if($file_size5 > 6097152) {
                $mensaje='<br>EL tamaño del documento es mayor de 5 MB';
                }       
                if(empty($errors)==true) {
                    $url5 = "../../assets/guias/".$guia5;
                    move_uploaded_file($file_tmp5, $url5);
                }
            }

        }


        if($mensaje == ""){
            //guardamos el ticket
            $nombre = $_FILES['ticket']['name'];
            $file_size = $_FILES['ticket']['size'];
            $file_tmp = $_FILES['ticket']['tmp_name'];
            $file_type = $_FILES['ticket']['type'];
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
            //guardamos la guia
                $nombre = $_FILES['guia']['name'];
                $file_size = $_FILES['guia']['size'];
                $file_tmp = $_FILES['guia']['tmp_name'];
                $file_type = $_FILES['guia']['type'];
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
            
            //aqui guardamos y redirigimos
            $id_carga = guardarCarga($id, $fecha, $provincia, $poblacion, $empresa, $raza, $numero, $tara, $pesoAnimales, $eTransportes, $camion, $camionero, $matadero, $fechaGuardado, $categoria, $alimentacion, $id);
            guardarSubcarga($id_carga, $ticket, $guia, $explotacion);
            if($explotacion2 != ""){
                guardarSubcarga($id_carga, $ticket2, $guia2, $explotacion2);
            }
            if($explotacion3 != ""){
                guardarSubcarga($id_carga, $ticket3, $guia3, $explotacion3);
            }
            if($explotacion4 != ""){
                guardarSubcarga($id_carga, $ticket4, $guia4, $explotacion4);
            }
            if($explotacion5 != ""){
                guardarSubcarga($id_carga, $ticket5, $guia5, $explotacion5);
            }
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
                                <h1 class="page-header">Crear Carga</h1>
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
                                                    <input type="text" name="subcargas" value="no" class="form-control" style="display:none">
                                                    <input type="date" name="fecha" id="fecha" <?php if($_POST){echo "value='$fecha'";}?> class="form-control" required>
                                                       
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Provincia Origen</label>
                                                <?php provincias();?>    
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Población</label>
                                                    <input type="text" name="poblacion" id="poblacion" <?php if($_POST){echo "value='$poblacion'";}?> class="form-control" required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Empresa Integradora</label>
                                                <?php $datos = listadoEmpresasIntegradoras();?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Categoria</label>
                                                <?php listadoCategorias();?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Número de animales</label>
                                                    <input type="number" name="numero" id="numero" <?php if($_POST){echo "value='$numero'";}?> class="form-control" min="0" value="0" required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Peso tara</label>
                                                    <input type="number" name="tara" id="tara" <?php if($_POST){echo "value='$tara'";}?> class="form-control" min="0" value="0" step="0.01"required>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Peso con animales</label>
                                                    <input type="number" name="peso_animales" id="peso_animales" <?php if($_POST){echo "value='$peso_animales'";}?> class="form-control" min="0" value="0" required>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Matadero</label>
                                                <?php $datos = listadoMataderos();?>  
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Empresa Transporte</label>
                                                <?php $datos = listadoEmpresasTransportes();?>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Subir Ticket <small>(Formato jpg)</small></label>
                                                <input type="file" name="ticket" accept=".jpg" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Subir Guía <small>(Formato jpg)</small></label>
                                                <input type="file" name="guia" accept=".jpg" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="explotaciones">

                                    </div>
                                    <div class="row" id="transporte">
                                        
                                    </div>
                                    <div class="row" id="datos_animales"></div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5>Si la carga lleva más de una subcarga <span class="btn boton btn-info" id="masSubcargas"> pulse aquí</span></h5>
                                        </div>
                                    </div>
                                    <div id="subcargas"></div> 
                                    
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
         $('#masSubcargas').click(function(){
            var url = "cambiar.php";
            var parametros = {
                "subcargas" : 'subcarga',
            };
            $.ajax({
                data: parametros,
                url: url,
                type: 'post',
                beforeSend: function () {//elemento que queramos poner mientras ajax carga
                    $("#subcargas").html("Procesando, espere por favor...");
                },
                success: function (response) {//resultado de la función
                    $("#subcargas").html(response);
                }
            });
        });
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
            //alert("hola");
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