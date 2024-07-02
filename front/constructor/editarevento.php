<?php
session_start();
if(isset($_SESSION['acceso']) && in_array(3, $_SESSION['roles']) || isset($_SESSION['acceso']) && in_array(4, $_SESSION['roles'])){
    include ('../layout/layout.php');
    include ('./functions/functions.php');
    cabecera('Inicio');
    navegador();
    $id = $_SESSION['id'];
    $evento = controlEvento($id);
    if($evento != 1){
        ?>
        <script>
            window.location='../index/';
        </script>
        <?php
    }
    $barra = datosBarraLibre($id);
    $ceremonia = datosCeremonia($id);
    $coctel = datosCoctel($id);
    $banquete = datosBanquete($id);
    //$datos = datosEvento($id);
    /*echo "<pre>" . print_r($barra, true) . "</pre>";
    echo "<pre>" . print_r($ceremonia, true) . "</pre>";
    echo "<pre>" . print_r($coctel, true) . "</pre>";
    echo "<pre>" . print_r($banquete, true) . "</pre>";*/
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Formulario del evento</h1>
                </div>
            </div>
            <form action="./modificarevento.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-3">
                        <h2>¿En qué momentos de la boda estaremos?</h2>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="ceremonia" name="ceremonia" value="Ceremonia" <?= is_array($ceremonia) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="ceremonia"> Ceremonia </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="coctel" name="coctel" value="Cóctel" <?= is_array($coctel) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="coctel"> Cóctel</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="banquete" name="banquete" value="Banquete" <?= is_array($banquete) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="banquete"> Banquete</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="barra" name="barra" value="Barra libre" <?= is_array($barra) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="barra"> Barra libre</label>
                        </div>
                    </div>
                    <div class="col-lg-3 ceremonia">
                    </div> 
                </div>
                
                <div class="row" id="ceremonia_form" style="display:none">
                    <h3>Ceremonia</h3>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="lugarCeremonia">Espacio de la ceremonia</label>
                            <select class="form-control" id="lugarCeremonia" name="lugarCeremonia">
                                <option value="Exterior" <?= $ceremonia['espacio'] == 'Exterior' ? 'selected' : ''; ?>>Exterior</option>
                                <option value="Interior" <?= $ceremonia['espacio'] == 'Interior' ? 'selected' : ''; ?>>Interior</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="entradaConyuge1">Entrada del cónyuge 1</label>
                            <input type="text" class="form-control" id="entradaConyuge1" name="entradaConyuge1" placeholder="Música Entrada cónyuge 1" value="<?=$ceremonia['entrada_conyuge1'];?>">
                        </div>
                        <div class="form-group">
                            <label for="musicaConyuge1">Archivo de música para la entrad del cónyuge 1</label>
                            <?php 
                                if($ceremonia['archivo_entrada_conyuge1'] != ''){
                                    echo "<p>Su musica para entrada del cónyuge 1 es: <a href='../../assets/archivos/$id/" . $ceremonia['archivo_entrada_conyuge1'] . "' target='_blank'>Escuchar</a></p>";
                                }
                            ?>
                            <input type="file" class="form-control-file" id="musicaConyuge1" name="musicaConyuge1">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="entradaConyuge2">Entrada del cónyuge 2</label>
                            
                            <input type="text" class="form-control" id="entradaConyuge2" name="entradaConyuge2" placeholder="Música Entrada cónyuge 2" value="<?=$ceremonia['entrada_conyuge2'];?>">
                        </div>
                        <div class="form-group">
                            <label for="musicaConyuge2">Archivo de música para la entrada del cónyuge 2</label>
                            <?php 
                                if($ceremonia['archivo_entrada_conyuge2'] != ''){
                                    echo "<p>Su musica para entrada del cónyuge 2 es: <a href='../../assets/archivos/$id/" . $ceremonia['archivo_entrada_conyuge2'] . "' target='_blank'>Escuchar</a></p>";
                                }
                            ?>
                            <input type="file" class="form-control-file" id="musicaConyuge2" name="musicaConyuge2">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="salidaCeremonia">Salida de la ceremonia</label>
                           
                            <input type="text" class="form-control" id="salidaCeremonia" name="salidaCeremonia" placeholder="Salida de la ceremonia" value="<?=$ceremonia['salida_ceremonia'];?>">
                        </div>
                        <div class="form-group">
                            <?php 
                                if($ceremonia['archivo_entrada_conyuge2'] != ''){
                                    echo "<p>Su musica para la salida de la ceremonia es: <a href='../../assets/archivos/$id/" . $ceremonia['archivo_salida_ceremonia'] . "' target='_blank'>Escuchar</a></p>";
                                }
                            ?>
                            <label for="musicaSalida">Archivo de música de para la salida de la ceremonia</label>
                            <input type="file" class="form-control-file" id="musicaSalida" name="musicaSalida">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="infoAdicional">Información adicional</label>
                            <input type="text" class="form-control" id="infoAdicional" name="informacionAdicional" placeholder="Información adicional" value="<?=$ceremonia['informacion_adicional'];?>">
                        </div>
                        <div class="form-group">
                            <label for="musicaAdicional">Archivo de música adicional</label>
                            <?php 
                                if($ceremonia['archivo_entrada_conyuge2'] != ''){
                                    echo "<p>Su musica para la salida de la ceremonia es: <a href='../../assets/archivos/$id/" . $ceremonia['archivo_informacion_adicional'] . "' target='_blank'>Escuchar</a></p>";
                                }
                            ?>
                            <input type="file" class="form-control-file" id="musicaAdicional" name="musicaAdicional">
                        </div>
                    </div>
                    <!---->
                    
                    <!---->
                    <hr>
                </div>
                <div class="row" id="coctel_form" style="display:none">
                    <h3>Cóctel</h3>
                    <div class="col-lg-6">
                        <p>Te recomendamos una de estas playlist. Marca la que quieras que suene en tu boda. Si tiene las tuya personalizada incluye el enlace en el área de texto</p>
                        <?php 
                        $listasMusica = listasMusica();
                        $coctelLista = explode("-", $coctel['listas']);
                        foreach($listasMusica as $listaMusica){
                            echo '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="lista_' . $listaMusica['id'] . '" name="lista_[]" value="' . $listaMusica['id']. '"';
                            comprobarListas($coctelLista, $listaMusica);
                            echo '>
                            <label class="form-check-label" for="lista_' . $listaMusica['id'] . '"> <a href="' . $listaMusica['enlace'] . '">' . $listaMusica['nombre']     . '</a></label>
                        </div>';
                        }
                        ?>
                        <div class="form-group">
                            <label for="momento_coctel">¿Hay algún momento concreto donde quieras elegir alguna cancion personalizada?</label>
                            <input type="text" class="form-control" id="momento_coctel" name="momento" placeholder="Momento en el coctel" value="<?=$coctel['momento'];?>">
                        </div>
                        <div class="form-group">
                            <label for="musica_momento_coctel">Archivo de música para el momento</label>
                            <?php 
                                if($ceremonia['archivo_entrada_conyuge2'] != ''){
                                    echo "<p>Su música para su momento personalizado: <a href='../../assets/archivos/$id/" . $coctel['archivo_momento'] . "' target='_blank'>Escuchar</a></p>";
                                }
                            ?>
                            <input type="file" class="form-control-file" id="musica_momento_coctel" name="musica_momento_coctel">
                        </div>
                    </div>
                    <hr>
                </div>
                <!---->
                <div class="row" id="banquete_form" style="display:none">
                    <h3>Banquete</h3>
                    <div class="col-lg-6">
                        <p>Te recomendamos una de estas playlist. Marca la que quieras que suene en tu boda. Si tiene las tuya personalizada incluye el enlace en el área de texto</p>
                        <?php 
                        $listasMusica = listasMusica();
                        $banqueteLista = explode("-", $banquete['listas']);
                        foreach($listasMusica as $listaMusica){
                            echo '<div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="lista_' . $listaMusica['id'] . '" name="lista_banquete_[]" value="' . $listaMusica['id']. '"';
                            comprobarListas($banqueteLista, $listaMusica);
                            echo '>
                            <label class="form-check-label" for="lista_' . $listaMusica['id'] . '"> <a href="' . $listaMusica['enlace'] . '">' . $listaMusica['nombre']     . '</a></label>
                        </div>';
                        }
                        ?>
                        <div class="form-group">
                            <label for="momento_coctel">¿Hay algún momento del banquete concreto donde quieras elegir alguna cancion personalizada?</label>
                            <input type="text" class="form-control" id="momento_coctel" name="momento_banquete" placeholder="Momento en el banquete" value="<?=$banquete['momento'];?>">
                        </div>
                        <div class="form-group">
                            <label for="musica_momento_coctel">Archivo de música para el momento</label>
                            <?php 
                                if($ceremonia['archivo_entrada_conyuge2'] != ''){
                                    echo "<p>Su música para su momento personalizado: <a href='../../assets/archivos/$id/" . $banquete['archivo_momento'] . "' target='_blank'>Escuchar</a></p>";
                                }
                            ?>
                            <input type="file" class="form-control-file" id="musica_momento_banquete" name="musica_momento_banquete">
                        </div>
                    </div>
                    <hr>
                </div>
                <!---->
                <div class="row" id="barra_form" style="display:none">
                    <h3>Barra libre</h3>
                    <div class="col-lg-4">
                        <p>¿Tenéis baile nupcial?</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="baile_si" name="baile" value="Con baile" <?=$barra['hay_baile_nupcial'] == 'Con baile' ? ' checked' : ''; ?> required>
                            <label class="form-check-label" for="baile_si"> Sí</label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" id="baile_no" name="baile" value="Sin baile" <?=$barra['hay_baile_nupcial'] == 'Sin baile' ? ' checked' : ''; ?>>
                            <label class="form-check-label" for="baile_no"> No</label>
                        </div>
                        <div class="form-group">
                            <label for="nombreBaileNupcial"></label>
                            <input type="text" class="form-control" id="nombreBaileNupcial" name="nombre_baile" placeholder="Nombre baile nupcial" value="<?=$barra['baile_nupcial'];?>">
                        </div>
                        <div class="form-group">
                            <label for="musica_baile_nupcial">Musica baile nupcial</label>
                            <?php 
                                if($ceremonia['archivo_entrada_conyuge2'] != ''){
                                    echo "<p>Su música para su momento personalizado: <a href='../../assets/archivos/$id/" . $barra['archivo_baile_nupcial'] . "' target='_blank'>Escuchar</a></p>";
                                }
                            ?>
                            <input type="file" class="form-control-file" id="musica_baile_nupcial" name="musica_baile_nupcial">
                        </div>
                        <hr>
                        <p>¿Queréis que en la barra libre suenen algunas canciones imprescindibles para vosotros?<br>
                        Haz una lista de maximo 30 canciones que no pueden faltar</p>
                        <div class="form-group">
                            <textarea class="form-control" rows="10" name="canciones_no_falten"><?=$barra['imprescindibles'];?></textarea>
                        </div>
                        <p>Algunas canciones que no quieres que suenen</p>
                        <div class="form-group">
                            <textarea class="form-control" rows="10" name="canciones_no_quieren"><?=$barra['no_suenen'];?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h4>VAMOS A ASIGNARTE UN DJ</h4>
                        <p>¿Te gusta que el DJ anime y hable por el micro?</p>
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="djanima" id="djanima1" value="Sí" <?=$barra['dj_habla'] == 'Sí' ? 'checked' : ''; ?>>Sí
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="djanima" id="djanima2" value="No" <?=$barra['dj_habla'] == 'No' ? 'checked' : ''; ?>>No
                                </label>
                            </div>
                        </div>
                        <p>¿Prefieres mashups/remixes o canciones originales?</p>
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tipo_musica" id="tipo_musica_1" value="Remixes/mashups" <?=$barra['tipo_musica'] == 'Remixes/mashups' ? 'checked' : ''; ?>>Remixes/mashups
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tipo_musica" id="tipo_musica_2" value="Originales" <?=$barra['tipo_musica'] == 'Originales' ? 'checked' : ''; ?>>Originales
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tipo_musica" id="tipo_musica_3" value="Ambas" <?=$barra['tipo_musica'] == 'Ambas' ? 'checked' : ''; ?>>Ambas
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="tipo_musica" id="tipo_musica_4" value="Que el DJ haga su magia" <?=$barra['tipo_musica'] == 'Que el DJ haga su magia' ? 'checked' : ''; ?>>Que el Dj haga su magia
                                </label>
                            </div>
                        </div>
                        <p>¿Cuál es la edad media de los invitados?</p>
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="edad_media" id="edad_media_1" value="20-30" <?=$barra['edad_media'] == '20-30' ? 'checked' : ''; ?>>20-30
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="edad_media" id="edad_media_2" value="30-40" <?=$barra['edad_media'] == '30-40' ? 'checked' : ''; ?>>30-40
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="edad_media" id="edad_media_3" value="40-50" <?=$barra['edad_media'] == '40-50' ? 'checked' : ''; ?>>40-50
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="edad_media" id="edad_media_4" value="50-60" <?=$barra['edad_media'] == '50-60' ? 'checked' : ''; ?>>50-60
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="edad_media" id="edad_media_5" value="60-70" <?=$barra['edad_media'] == '60-70' ? 'checked' : ''; ?>>60-70
                                </label>
                            </div>
                        </div>
                        <p>¿Preferencias musicales? Marca las opciones que más te gusten</p>
                        <div class="row">
                            <?php  $estiloMusica = explode(", ", $barra['estilo_musical']);?>
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="pop" name="preferenciaMusical[]" value="Pop" <?=in_array('Pop', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="pop"> Pop</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="rock" name="preferenciaMusical[]" value="Rock" <?=in_array('Rock', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="rock"> Rock</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="indie" name="preferenciaMusical[]" value="Indie" <?=in_array('Indie', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="indie"> Indie</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="electronica" name="preferenciaMusical[]" value="Electrónica" <?=in_array('Electrónica', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="electronica"> Electrónica</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="latino" name="preferenciaMusical[]" value="Latino" <?=in_array('Latino', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="latino"> Latino</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="urbano" name="preferenciaMusical[]" value="Urbano" <?=in_array('Urbano', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="urbano"> Urbano</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="rap" name="preferenciaMusical[]" value="Rap" <?=in_array('Rap', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="rap"> Rap</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="techno" name="preferenciaMusical[]" value="Techno" <?=in_array('Techno', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="techno"> Techno</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="flamenco" name="preferenciaMusical[]" value="Flamenco" <?=in_array('Flamenco', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="flamenco"> Flamenco</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="otros" name="preferenciaMusical[]" value="Otros" <?=in_array('Otros', $estiloMusica) ? " checked" : "";?>>
                                    <label class="form-check-label" for="otros"> Otros</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="djadicional">¿Qué más debemos saber acerca del DJ?</label>
                            <input type="text" class="form-control" id="djadicional" name="djadicional" value="<?=$barra['nota_adicional_dj'];?>">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <p>Tenéis sello/logotipo de boda para incluirlo en las plantillas de fotomatón/espejo mágico/videomatón</p>
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="logo_boda" id="logo_boda_1" value="Sí" <?=$barra['logotipo'] == 'Sí' ? 'checked' : ''; ?>>Sí
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="logo_boda" id="logo_boda_2" value="No" <?=$barra['logotipo'] == 'No' ? 'checked' : ''; ?>>No
                                </label>
                            </div>
                        </div>
                        <div id="logo_boda_si" style="display: none;">
                            <div class="form-group">
                                <label for="tengo_logo_boda"></label>
                                <input type="text" class="form-control" id="tengo_logo_boda" name="tengo_logo_boda" placeholder="" value="<?=$barra['texto_logotipo'];?>">
                            </div>
                            <div class="form-group">
                                <label for="mi_logo_de_boda">Sube tu logo de boda</label>
                                <?php 
                                if($ceremonia['archivo_entrada_conyuge2'] != ''){
                                    echo "<p>Archivo del logo: <a href='../../assets/archivos/$id/" . $barra['archivo_logotipo'] . "' target='_blank'>Abrur</a></p>";
                                }
                            ?>
                                <input type="file" class="form-control-file" id="mi_logo_de_boda" name="mi_logo_de_boda">
                            </div>
                        </div>
                        <div id="logo_boda_no" style="display: none;">
                            <p>Indicanos los nombres que queréis que aparezcan y diseñaremos uno</p>
                            <div class="form-group">
                                <textarea class="form-control" rows="10" name="directrices_logo"><?=$barra['indicaciones_logotipo']?></textarea>
                            </div>
                        </div>
                        <hr>
                        <p>¿Queréis compartir vuestro Instagram con nosotros para poder mencionaros en alguna Storie/publicación si fuese necesario?</p>
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="insta" id="insta_1" value="Sí" <?=$barra['tiene_instagram'] == 'Sí' ? 'checked' : ''; ?>>Sí
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="insta" id="insta_2" value="No" <?=$barra['tiene_instagram'] == 'No' ? 'checked' : ''; ?>>No
                                </label>
                            </div>
                        </div>
                        <div id="insta_si" style="display: none;">
                            <div class="form-group">
                                <label for="insta_usuario">Dinos tu instagram</label>
                                <input type="text" class="form-control" id="insta_usuario" name="insta_usuario" placeholder="" value="<?=$barra['instagram'];?>">
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                    
                
                <div class="row">
                    <div class="col-lg-3">
                        <input type="submit" value="Enviar" class="btn btn-primary">
                    </div>
                </div>
            </form>  
        </div>
    </div>

    <script>
        // Función para mostrar u ocultar el div correspondiente cuando se marque o desmarque un checkbox
        function toggleFormVisibility() {
            const checkboxId = this.id || this.getAttribute('id'); // Modificado para soportar llamadas directas
            const correspondingFormId = `${checkboxId}_form`;
            const correspondingForm = document.getElementById(correspondingFormId);
            if (correspondingForm) {
                correspondingForm.style.display = this.checked ? 'block' : 'none';
            }
        }

        $(document).ready(function() {
            // Obtener los checkboxes y los divs correspondientes
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            // Agregar un event listener a cada checkbox
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', toggleFormVisibility);
                // Llamada directa para establecer la visibilidad inicial basada en el estado del checkbox
                toggleFormVisibility.call(checkbox);
            });

            $('input[name="logo_boda"]').change(function() {
                var valor = $(this).val();
                if (valor === 'Sí') {
                    $('#logo_boda_si').show();
                    $('#logo_boda_no').hide();
                    $('#logo_boda_no').show();
                } else {
                    $('#logo_boda_si').hide();
                    $('#logo_boda_no').show();
                    $('#logo_boda_si').show();
                }
            }).change(); // Añade .change() al final para disparar el evento al cargar

            $('input[name="insta"]').change(function() {
                var valor = $(this).val();
                if (valor === 'Sí') {
                    $('#insta_si').show();
                    
                } else {
                    $('#insta_si').hide();
                    $('#insta_si').show();
                    
                }
            }).change(); // Añade .change() al final para disparar el evento al cargar
        });

    </script>

<?php
    pie();
}else{
    ?>
    <script>
        window.location='../../';
    </script>
    <?php
}