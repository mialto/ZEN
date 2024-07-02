<?php 
include ('./functions/functions.php');

if(isset($_POST['id_transportes'])){
    $idTransportes = $_POST['id_transportes'];
?>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Camión</label>
            <?php $datos = listadoCamiones($idTransportes);?>  
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Camionero</label>
            <?php $datos = listadoCamioneros($idTransportes);?>  
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <div id="resultados"></div>
        </div>
    </div>
<?php    
}elseif(isset($_POST['id_empresa'])){
    $idEmpresa = $_POST['id_empresa'];
    ?>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Explotacion</label>
            <?php $datos = listadoExplotaciones($idEmpresa);?>
        </div>
    </div>
    <?php
}elseif(isset($_POST['categoria']) && $_POST['categoria'] == "Con norma" || isset($_POST['categoria']) && $_POST['categoria'] == "Reproductoras con norma"){
    ?>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Alimentacion</label>
            <?php $datos = selectAlimentacion();?>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label>Tipo Racial</label>
            <?php $datos = listadoRazas();?>
        </div>
    </div>
    <?php
}elseif(isset($_POST['subcargas'])){
    ?>
    <div class="row">
        <div class="-col-lg-12">
            <b>Es obligatorio marcar la explotación para que se guarde la subcarga (aunque sea la misma)</b>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Ticket <small>(Formato jpg)</small></label>
                <input type="file" name="ticket2" accept=".jpg" class="form-control">
                <input type="text" name="subcargas" value="si" class="form-control" style="display:none">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Guía <small>(Formato jpg)</small></label>
                <input type="file" name="guia2" accept=".jpg" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Explotacion || REGA</label>
                <?php $datos = listadoExplotaciones(0, 0, 2);?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Ticket <small>(Formato jpg)</small></label>
                <input type="file" name="ticket3" accept=".jpg" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Guía <small>(Formato jpg)</small></label>
                <input type="file" name="guia3" accept=".jpg" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Explotacion || REGA</label>
                <?php $datos = listadoExplotaciones(0, 0, 3);?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Ticket <small>(Formato jpg)</small></label>
                <input type="file" name="ticket4" accept=".jpg" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Guía <small>(Formato jpg)</small></label>
                <input type="file" name="guia4" accept=".jpg" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Explotacion || REGA</label>
                <?php $datos = listadoExplotaciones(0, 0, 4);?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Ticket <small>(Formato jpg)</small></label>
                <input type="file" name="ticket5" accept=".jpg" class="form-control">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Subir Guía <small>(Formato jpg)</small></label>
                <input type="file" name="guia5" accept=".jpg" class="form-control">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Explotacion || REGA</label>
                <?php $datos = listadoExplotaciones(0, 0, 5);?>
            </div>
        </div>
    </div>
    
    <?php
}
?>
<script>
    $('.explotaciones').selectpicker();
</script>
<?php
?>