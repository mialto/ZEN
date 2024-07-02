<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(3, $_SESSION['roles']) || isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    cabecera('Inicio');
    navegador();
    $id = $_SESSION['id'];
    $datos_usuario = obtenerDatosUsuario($id);
    $telefonos_usuario = obtenerTelefonosUsuario($id);
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Estos son tus datos</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h4>Nombre</h4>
                    <?=$datos_usuario['nombre'];?>
                </div>
                <div class="col-lg-3">
                    <h4>Email</h4>
                    <?=$datos_usuario['email'];?>
                </div>
                <div class="col-lg-3">
                    <h4>CIF</h4>
                    <?=$datos_usuario['cif'];?>
                </div>
                <div class="col-lg-3">
                    <h4>Teléfono</h4>
                    <?php 
                    if(isset($telefonos_usuario)){
                        foreach ($telefonos_usuario as $telefono) {
                        echo $telefono . "<br>";
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <h4>Provincia</h4>
                    <?=$datos_usuario['provincia'];?>
                </div>
                <div class="col-lg-3">
                    <h4>Población</h4>
                    <?=$datos_usuario['poblacion'];?>
                </div>
                <div class="col-lg-3">
                    <h4>CP</h4>
                    <?=$datos_usuario['cp'];?>
                </div>
                <div class="col-lg-3">
                    <h4>Direccción</h4>
                    <?=$datos_usuario['direccion'];?>
                </div>
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