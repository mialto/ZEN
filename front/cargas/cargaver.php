<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('./functions/validaciones.php');
    $id = $_GET['id'];
    $datos = datosCarga($id);
    $datosSub = datosSubcarga($id);
    if($datos['id_corredor'] != $_SESSION['id']){
        header('Location: index.php');
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
                                <h1 class="page-header">Ficha de la carga <?=$id?></h1>
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
                            </div>
                        </div>
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Fecha de la carga</label>
                                                    <input type="date" value="<?=$datos['fecha']?>" class="form-control" readonly>
                                                       
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Provincia Origen</label>
                                                <input type="text" value="<?=$datos['provincia']?>" class="form-control" readonly>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Población</label>
                                                <input type="text" value="<?=$datos['poblacion']?>" class="form-control" readonly>   
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Empresa Integradora</label>
                                                <input type="text" value="<?=$datos['nombre_empresa']?>" class="form-control" readonly>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Raza</label>
                                                <input type="text" value="<?=$datos['raza']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Número de animales</label>
                                                <input type="text" value="<?=$datos['num_animales']?>" class="form-control" readonly>  
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Categoria</label>
                                                <input type="text" value="<?=$datos['categoria']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Alimentación</label>
                                                <input type="text" value="<?=$datos['alimentacion']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Peso tara</label>
                                                <input type="text" value="<?=$datos['peso_tara']?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Peso con animales</label>
                                                <input type="text" value="<?=$datos['peso_con_animales']?>" class="form-control" readonly>   
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Peso medio</label>
                                                <input type="text" value="<?=$datos['peso_medio']?>" class="form-control" readonly>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-lg-3">
                                        <div class="form-group">
                                                <label>Matadero</label>
                                                <input type="text" value="<?=$datos['nombre_matadero']?>" class="form-control" readonly> 
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Empresa Transporte</label>
                                                <input type="text" value="<?=$datos['nombre_transportes']?>" class="form-control" readonly>  
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Camión</label>
                                                <input type="text" value="<?=$datos['matricula']?>" class="form-control" readonly>  
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Camionero</label>
                                                <input type="text" value="<?=$datos['nombre_camionero'] . " " . $datos['apellidos']?>" class="form-control" readonly>  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h3>Datos de Subcargas</h3>
                                        </div>
                                    </div>
                                    <?php
                                    pintarSubcargas($datosSub);
                                    ?>
                                    <div class="row">
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <div id="resultados"></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row" id="transporte">
                                        
                                    </div>
                                        
                                </form>
                            </div>
                        </div>
                        
                   
                    </div><!-- /.container-fluid -->
                </div><!-- IMPORTANT -->
            </div><!-- IMPORTANT -->
        </div><!-- IMPORTANT -->
    </div><!-- /#wrapper este siempre tiene q estar q abre en el navegador-->
    <?php
    pie();
}else{
    header('Location: ../index.php');
}