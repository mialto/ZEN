<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(2, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    if($_GET){
        $id = $_GET['id'];
        $datos_usuario = obtenerDatosUsuario($id);
        $telefonos_usuario = obtenerTelefonosUsuario($id);
        $roles_usuario = obtenerRolesUsuario($id);
        $evento = controlEvento($id);
        
        cabecera('Datos de usuario');
        navegador();
        ?>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
            <div class="container-fluid">
                <div class="row">
                    <div id="page-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">Datos de usuario</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a href="index" type="button" class="btn btn-success">Volver</a> <!--<button id="generate-pdf" class="btn btn-danger">Generar PDF</button>-->
                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <br>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Usuario
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body" >
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Nombre</label>
                                                            <input type="text" name="nombre" id="nombre" value="<?=$datos_usuario['nombre'];?>" class="form-control" disabled>   
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                            <input type="email" name="mail" id="mail" class="form-control" value="<?=$datos_usuario['email'];?>" disabled>
                                                            
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Tipo</label>
                                                        <input type="text" name="roles" id="roles" class="form-control" value="<?=implode(" - ", $roles_usuario);?>" disabled>
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
                                            <div id="cliente">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>CIF</label>
                                                                <input type="text" name="cif" id="cif" value="<?=$datos_usuario['cif'];?>"  class="form-control" disabled>   
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label>Teléfonos</label>
                                                                <input type="text" name="telefono1" id="telefono1" value="<?=implode(" - ", $telefonos_usuario);?>" class="form-control" disabled>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                            <label>País</label>
                                                                <input type="text" name="pais" id="pais" value="<?=$datos_usuario['pais'];?>" class="form-control" disabled>   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Población</label>
                                                                <input type="text" name="poblacion" id="poblacion" value="<?=$datos_usuario['poblacion'];?>" class="form-control" disabled>    
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>Provincia</label>
                                                                <input type="text" name="provincia" id="provincia" value="<?=$datos_usuario['provincia'];?>" class="form-control" disabled>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label>CP</label>
                                                                <input type="text" name="cp" id="cp" value="<?=$datos_usuario['cp'];?>" class="form-control" disabled>   
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                            <label>Dirección</label>
                                                                <input type="text" name="direccion" id="direccion" value="<?=$datos_usuario['direccion'];?>" class="form-control" disabled>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                    <a href="editarusuario?id=<?=$id?>" type="button" class="btn btn-warning ">Editar Usuario</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                    <?php 
                                   
                                    ?>
                                    
                                </div>
                                <!-- /.col-lg-12 -->
                            </div>
                    
                        </div><!-- /.container-fluid -->
                    </div><!-- IMPORTANT -->
                </div><!-- IMPORTANT -->
            </div><!-- IMPORTANT -->
        </div><!-- /#wrapper este siempre tiene q estar q abre en el navegador-->       

<script>
    $(document).ready(function(){
        $('#generate-pdf').click(function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Ajustes para márgenes
            const margenSuperior = 30; // Margen superior en mm
            const margenInferior = 30; // Puedes ajustar el margen inferior si es necesario
            
            doc.html(document.querySelector("#contenido"), {
                callback: function(doc) {
                    // Este callback se ejecuta una vez que se ha terminado de agregar el contenido HTML al PDF.
                    doc.save('documento.pdf');
                },
                x: 10, // Margen izquierdo
                y: margenSuperior, // Margen superior
                margin: [margenSuperior, 0, margenInferior, 0], // [top, right, bottom, left]
                windowWidth: document.querySelector("#contenido").scrollWidth,
                width: doc.internal.pageSize.getWidth() - 20 // Ajuste del ancho para incluir márgenes laterales
            });
        });
    });
</script>
        <?php
        pie();
    }
    
}else{
    header('Location: ../index.php');
}