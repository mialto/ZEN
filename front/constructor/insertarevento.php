<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(3, $_SESSION['roles']) || isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    include ('../../app/validacionesgenerales.php');
    //include ('../../app/functions.php');

    //cabecera('Constructor de eventos');
    //navegador();
    $id = $_SESSION['id'];
    if($_POST){
        //echo "<br><br><br><br><br><br><br><br><br><br<<pre>" . print_r($_POST, true) . "</pre>";
        //controlamos el formulario de ceremonia
        $fecha = $_POST['fecha_evento'];
        evento($id);
        if($_POST['ceremonia']=="Ceremonia"){
            //creamos las variables para la insercion en la BBDD
            $lugarCeremonia = "";
            $entradaConyuge1 = "";
            $archivoConyuge1 = "";
            $entradaConyuge2 = "";
            $archivoConyuge2 = "";
            $salidaCeremonia = "";
            $archivoSalida = "";
            $informacionAdicional = "";
            $archivoInformacionAdicional = "";
            //control de los archivos para guardarlos en la carpeta
            if (isset($_FILES['musicaConyuge1']) && $_FILES['musicaConyuge1']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['musicaConyuge1']['tmp_name'];
                $fileName = $_FILES['musicaConyuge1']['name'];
                $fileSize = $_FILES['musicaConyuge1']['size'];
                $fileType = $_FILES['musicaConyuge1']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName;
                //el newFileName es lo que guararíamos en la base de datos
                $archivoConyuge1 = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id . "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
            }
            if (isset($_FILES['musicaConyuge2']) && $_FILES['musicaConyuge2']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['musicaConyuge2']['tmp_name'];
                $fileName = $_FILES['musicaConyuge2']['name'];
                $fileSize = $_FILES['musicaConyuge2']['size'];
                $fileType = $_FILES['musicaConyuge2']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName;
                //el newFileName es lo que guararíamos en la base de datos
                $archivoConyuge2 = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id. "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
            }
            if (isset($_FILES['musicaSalida']) && $_FILES['musicaSalida']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['musicaSalida']['tmp_name'];
                $fileName = $_FILES['musicaSalida']['name'];
                $fileSize = $_FILES['musicaSalida']['size'];
                $fileType = $_FILES['musicaSalida']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName . '.' . $fileExtension;
                //el newFileName es lo que guararíamos en la base de datos
                $archivoSalida = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id. "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
            }
            if (isset($_FILES['musicaAdicional']) && $_FILES['musicaAdicional']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['musicaAdicional']['tmp_name'];
                $fileName = $_FILES['musicaAdicional']['name'];
                $fileSize = $_FILES['musicaAdicional']['size'];
                $fileType = $_FILES['musicaAdicional']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName;
                //el newFileName es lo que guararíamos en la base de datos
                $archivoInformacionAdicional = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id. "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
                
            }
            //los campos de texto
            if(isset($_POST['lugarCeremonia']) && !empty($_POST['lugarCeremonia'])) {
                $lugarCeremonia = sanearCadena($_POST['lugarCeremonia']);
            }
            if(isset($_POST['entradaConyuge1']) && !empty($_POST['entradaConyuge1'])) {
                $entradaConyuge1 = sanearCadena($_POST['entradaConyuge1']);
            }
            if(isset($_POST['entradaConyuge2']) && !empty($_POST['entradaConyuge2'])) {
                $entradaConyuge2 = sanearCadena($_POST['entradaConyuge2']);
            }
            if(isset($_POST['salidaCeremonia']) && !empty($_POST['salidaCeremonia'])) {
                $salidaCeremonia = sanearCadena($_POST['salidaCeremonia']);
            }
            if(isset($_POST['informacionAdicional']) && !empty($_POST['informacionAdicional'])) {
                $informacionAdicional = sanearCadena($_POST['informacionAdicional']);
            }
            guardarCeremonia($id, $lugarCeremonia, $entradaConyuge1, $archivoConyuge1, $entradaConyuge2, $archivoConyuge2, $salidaCeremonia, $archivoSalida, $informacionAdicional, $archivoInformacionAdicional);
        }else{
            guardarCeremonia($id, "", "", "", "", "", "", "", "", "");
        }
        //fin de ceremonia
        
        if($_POST['coctel']=="Cóctel"){
            //validaciones para coctel
            $momento = "";
            $musicaMomentoCoctel = "";
            $listasMusica = "";
            if(isset($_POST['lista_'])) {
                // Recorre el array de checkboxes marcados
                foreach($_POST['lista_'] as $opcion) {
                    $listasMusica .= $opcion . "-";
                }
            }
            if(isset($_POST['momento']) && !empty($_POST['momento'])) {
                $momento = sanearCadena($_POST['momento']);
            }
            if (isset($_FILES['musica_momento_coctel']) && $_FILES['musica_momento_coctel']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['musica_momento_coctel']['tmp_name'];
                $fileName = $_FILES['musica_momento_coctel']['name'];
                $fileSize = $_FILES['musica_momento_coctel']['size'];
                $fileType = $_FILES['musica_momento_coctel']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName;
                //el newFileName es lo que guararíamos en la base de datos
                $musicaMomentoCoctel = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id. "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
                
            }
            guardarCoctel($id, $momento, $listasMusica, $musicaMomentoCoctel);
        }else{
            guardarCoctel($id, "", "", "");
        }
        
        //fin de coctel

        if($_POST['banquete']=="Banquete"){
            //validaciones para banquete
            $momento = "";
            $musicaMomentoBanquete = "";
            $listasMusica = "";
            if(isset($_POST['lista_banquete_'])) {
                // Recorre el array de checkboxes marcados
                foreach($_POST['lista_banquete_'] as $opcion) {
                    $listasMusica .= $opcion . "-";
                }
            }
            if(isset($_POST['momento_banquete']) && !empty($_POST['momento_banquete'])) {
                $momento = sanearCadena($_POST['momento_banquete']);
            }
            if (isset($_FILES['musica_momento_banquete']) && $_FILES['musica_momento_banquete']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['musica_momento_banquete']['tmp_name'];
                $fileName = $_FILES['musica_momento_banquete']['name'];
                $fileSize = $_FILES['musica_momento_banquete']['size'];
                $fileType = $_FILES['musica_momento_banquete']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName;
                //el newFileName es lo que guararíamos en la base de datos
                $musicaMomentoBanquete = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id. "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
                
            }
            guardarBanquete($id, $momento, $listasMusica, $musicaMomentoBanquete);
        }else{
            guardarBanquete($id, "", "", "");
        }
        //fin de banquete

        if($_POST['barra']=="Barra libre"){
            $baile = $_POST['baile'];
            $nombre_baile = "";
            $archivo_baile ="";
            $musica_baile_nupcial= "";
            $imprescindibles = "";
            $no_suenen = "";
            $djanima = "";
            $tipo_musica = "";
            $edad_media = "";
            $preferencias_musicales = "";
            $djadicional = "";
            $logo_boda = "";
            $tengo_logo_boda = "";
            $archivo_logo_boda = "";
            $directrices_logo = "";
            $insta = "";
            $insta_usuario = "";
            

            //Baile nupcial (1ª columna)
            if(isset($_POST['nombre_baile']) && !empty($_POST['nombre_baile'])) {
                $nombre_baile = sanearCadena($_POST['nombre_baile']);
            }
            if (isset($_FILES['musica_baile_nupcial']) && $_FILES['musica_baile_nupcial']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['musica_baile_nupcial']['tmp_name'];
                $fileName = $_FILES['musica_baile_nupcial']['name'];
                $fileSize = $_FILES['musica_baile_nupcial']['size'];
                $fileType = $_FILES['musica_baile_nupcial']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName;
                //el newFileName es lo que guararíamos en la base de datos
                $musica_baile_nupcial = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id. "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
                
            }
            if(isset($_POST['canciones_no_falten']) && !empty($_POST['canciones_no_falten'])) {
                $imprescindibles = sanearCadena($_POST['canciones_no_falten']);
                $imprescindibles = nl2br($imprescindibles);
            }
            if(isset($_POST['canciones_no_quieren']) && !empty($_POST['canciones_no_quieren'])) {
                $no_suenen = sanearCadena($_POST['canciones_no_quieren']);
                $no_suenen = nl2br($no_suenen);
            }

            //2ª columna
            if(isset($_POST['djanima']) && !empty($_POST['djanima'])) {
                $djanima = sanearCadena($_POST['djanima']);
            }
            if(isset($_POST['tipo_musica']) && !empty($_POST['tipo_musica'])) {
                $tipo_musica = sanearCadena($_POST['tipo_musica']);
            }
            if(isset($_POST['edad_media']) && !empty($_POST['edad_media'])) {
                $edad_media = sanearCadena($_POST['edad_media']);
            }
            if (isset($_POST['preferenciaMusical'])) {
                // Si se han marcado opciones, recolectarlas en una cadena separada por comas
                $preferencias_musicales = implode(', ', $_POST['preferenciaMusical']);
                // $opcionesSeleccionadas contendrá una cadena con todas las opciones seleccionadas separadas por comas
            } else {
                // Si no se han marcado opciones, asignar un valor predeterminado o mostrar un mensaje de error
                $preferencias_musicales = 'Ninguna opción seleccionada';
            }
            if(isset($_POST['djadicional']) && !empty($_POST['djadicional'])) {
                $djadicional = sanearCadena($_POST['djadicional']);
            }

            //3ªcolumna
            if(isset($_POST['logo_boda']) && !empty($_POST['logo_boda'])) {
                $logo_boda = sanearCadena($_POST['logo_boda']);
            }
            if(isset($_POST['tengo_logo_boda']) && !empty($_POST['tengo_logo_boda'])) {
                $tengo_logo_boda = sanearCadena($_POST['tengo_logo_boda']);
            }
            if (isset($_FILES['mi_logo_de_boda']) && $_FILES['mi_logo_de_boda']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['mi_logo_de_boda']['tmp_name'];
                $fileName = $_FILES['mi_logo_de_boda']['name'];
                $fileSize = $_FILES['mi_logo_de_boda']['size'];
                $fileType = $_FILES['mi_logo_de_boda']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));
                $newFileName = $id . "-" . time() . "-" . $fileName;
                //el newFileName es lo que guararíamos en la base de datos
                $archivo_logo_boda = $newFileName;
                $uploadFileDir = '../../assets/archivos/' . $id. "/";
                $dest_path = $uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTmpPath, $dest_path)){
                    echo 'File is successfully uploaded.';
                }
                else{
                    echo 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
                }
                
            }
            if(isset($_POST['directrices_logo']) && !empty($_POST['directrices_logo'])) {
                $directrices_logo = sanearCadena($_POST['directrices_logo']);
                $directrices_logo = nl2br($no_suenen);
            }
            if(isset($_POST['insta']) && !empty($_POST['insta'])) {
                $insta = sanearCadena($_POST['insta']);
            }
            if(isset($_POST['insta_usuario']) && !empty($_POST['insta_usuario'])) {
                $insta_usuario = sanearCadena($_POST['insta_usuario']);
            }
            guardarBarra($id, $baile, $nombre_baile, $musica_baile_nupcial, $imprescindibles, $no_suenen, $djanima, $tipo_musica, $edad_media, $preferencias_musicales, $djadicional, $logo_boda,
            $tengo_logo_boda, $archivo_logo_boda, $directrices_logo, $insta, $insta_usuario);

        }else{
            guardarBarra($id, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");
        }
        //fin barra libre
        ?>
        <script>
            window.location='../index';
        </script>
        <?php
    }
}else{
    ?>
    <script>
        window.location='../../';
    </script>
    <?php
}