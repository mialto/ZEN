<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    cabecera('Cargas');
    navegador();
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cargas</h1>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            <div class="row">
                <div class="col-lg-12">
                    <a href="cargacrear" type="button" class="btn btn-success">Crear carga</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Cargas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Provincia</th>
                                            <th>Población</th>
                                            <th>Empresa integradora</th>
                                            <th>Raza</th>
                                            <th>Nº Animales</th>
                                            <th>Peso medio</th>
                                            <th>Empresa de transportes</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        cargas($_SESSION['id']); 
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
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