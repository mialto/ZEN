<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(2, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    cabecera('Panel del control');
    navegador();
    ?>
   
    <div class="container-fluid">
        <div class="row">
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">INICIO</h1>
                        </div>
                    </div>
                    <div class="row">
                        
                       
                        <!-- /.col-lg-12 -->
                        
                    </div><!-- /.row -->
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