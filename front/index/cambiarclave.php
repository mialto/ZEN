<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(3, $_SESSION['roles']) || isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    cabecera('Cambiar contraseña');
    navegador();
    $id = $_SESSION['id'];
    if($_POST){
        $pass = base64_encode($_POST['pass']);
        $id = cambiarClave($id, $pass);
        ?>
        <script>
        alert('contraseña cambiara con exito');
        window.location ="index";</script>
        <?php
    }
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Cambiar contraseña</h1>
                </div>
            </div>
            <div class="row">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Password <small>8 digitos, una mayuscula una minuscula, un número y un caracter especial</small></label>
                                <input type="text" name="pass" id="pass" class="form-control" <?php if($_POST){echo "value='$mail'";}?> pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required> 
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
            <?php
            ?>

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