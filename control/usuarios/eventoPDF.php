<?php
require('../../app/fpdf/fpdf.php');
include('../../app/conexion.php');
include('../../app/functions.php');
if($_GET){
header('Content-Type: text/html; charset=utf-8');
$id = $_GET['id'];
$datos_usuario = obtenerDatosUsuario($id);
$telefonos_usuario = obtenerTelefonosUsuario($id);
$barra = datosBarraLibre($id);
$ceremonia = datosCeremonia($id);
$coctel = datosCoctel($id);
$banquete = datosBanquete($id);
$nombre=rand() . "-" . $datos_usuario['nombre'] . ".pdf";
$listas = obtenerListasPDF($coctel['listas']);
$listasBanquete = obtenerListasPDF($banquete['listas']);
$cabecera = "<b>Evento de " . $datos_usuario['nombre'] . "</b><br><br>";
$datos_usuario = utf8_decode("<p>Email: " . $datos_usuario['email'] . "<br>
cif: " . $datos_usuario['cif'] . "<br>
pais: " . $datos_usuario['pais'] . "<br>
ciudad: " . $datos_usuario['poblacion'] . "<br>
cp: " . $datos_usuario['cp'] . "<br>
Direccion: " . $datos_usuario['direccion'] . "<br>
<p>Fecha de la boda: " . $datos_usuario['fecha_boda'] . "<br>
Lugar de la boda:" . $datos_usuario['lugar_boda'] . "</p><hr>");
$cabeceraCeremonia ="<br><br><b>Ceremonia</b><br><br>";
$ceremonia = utf8_decode("
Espacio: " . $ceremonia['espacio'] . "<br>
Entrada Conyuge 1: " . $ceremonia['entrada_conyuge1'] . "<br>
Archivo entrada conyuge 1: " . $ceremonia['archivo_entrada_conyuge1'] . "<br>
Entrada Conyuge 2: " . $ceremonia['entrada_conyuge2'] . "<br>
Archivo entrada conyuge 2: " . $ceremonia['archivo_entrada_conyuge2'] . "<br>
Salida ceremonia: " . $ceremonia['salida_ceremonia'] . "<br>
Archivo salida ceremonia: " . $ceremonia['archivo_salida_ceremonia'] . "<br>
Informacion adicional: " . $ceremonia['informacion_adicional'] . "<br>
Archivo informacion adicional: " . $ceremonia['archivo_informacion_adicional'] . "<br>");
$cabeceraCoctel ="<br><br><b>Coctel</b><br><br>";
$coctel = utf8_decode("
Momento: " . $coctel['momento'] . "<br>
Archivo momento: " . $coctel['archivo_momento'] . "<br>
<b>Listas de musica:</b><br>");
$cabeceraBanquete ="<br><br><b>Banquete</b><br><br>";
$banquete = utf8_decode("
Momento: " . $banquete['momento'] . "<br>
Archivo momento: " . $banquete['archivo_momento'] . "<br>
<b>Listas de musica:</b><br>");
//segunda pagina
$cabeceraBarra ="<br><br><b>Barra libre</b><br><br>";
$barra = utf8_decode("
Hay baile nupcial: " . $barra['hay_baile_nupcial'] . "<br>
Baile nupcial: " . $barra['baile_nupcial'] . "<br>
Archivo baile nupcial: " . $barra['archivo_baile_nipcial'] . "<br>
Imprescindibles: " . $barra['imprescindibles'] . "<br>
Que no suenen: " . $barra['no_suenen'] . "<br>
Dj habla: " . $barra['dj_habla'] . "<br>
Tipo de musica: " . $barra['tipo_musica'] . "<br>
Estilo musical: " . $barra['estilo_musical'] . "<br>
Edad media: " . $barra['edad_media'] . "<br>
Nota adicional para el DJ: " . $barra['nota_adicional_dj'] . "<br>
Logotipo: " . $barra['logotipo'] . "<br>
Texto del logotipo: " . $barra['texto_logotipo'] . "<br>
Archivo logotipo: " . $barra['archivo_logotipo'] . "<br>
Indicaciones logotipo: " . $barra['indicaciones-logotipo'] . "<br>
Tiene Instagram: " . $barra['tiene_instagram'] . "<br>
Instagram: " . $barra['instagram'] . "<br>");

    class PDF extends FPDF
    {
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';

    function WriteHTML($html)
    {
        // Intérprete de HTML
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                else
                    $this->Write(5,$e);
            }
            else
            {
                // Etiqueta
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    // Extraer atributos
                    $a2 = explode(' ',$e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag,$attr);
                }
            }
        }
    }

    function OpenTag($tag, $attr)
    {
        // Etiqueta de apertura
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='BR')
            $this->Ln(5);
    }

    function CloseTag($tag)
    {
        // Etiqueta de cierre
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF = '';
    }

    function SetStyle($tag, $enable)
    {
        // Modificar estilo y escoger la fuente correspondiente
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }

    function PutLink($URL, $txt)
    {
        // Escribir un hiper-enlace
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    }
    $pdf = new PDF();
    // Primera página
    $pdf->AddPage();
    $pdf->SetFont('Arial','',20);
    //$pdf->Write(5,'Para saber qué hay de nuevo en este tutorial, pulse ');
    $pdf->SetFont('','U');
    $link = $pdf->AddLink();
    //$pdf->Write(5,'aquí',$link);
    $pdf->WriteHTML($cabecera);
    $pdf->SetFont('Arial','',9);
    $pdf->WriteHTML($datos_usuario);
    $pdf->SetFont('Arial','',15);
    $pdf->WriteHTML($cabeceraCeremonia);
    $pdf->SetFont('Arial','',9);
    $pdf->WriteHTML($ceremonia);
    $pdf->SetFont('Arial','',15);
    $pdf->WriteHTML($cabeceraCoctel);
    $pdf->SetFont('Arial','',9);
    $pdf->WriteHTML($coctel);
    $pdf->WriteHTML($listas);
    $pdf->SetFont('Arial','',15);
    $pdf->WriteHTML($cabeceraBanquete);
    $pdf->SetFont('Arial','',9);
    $pdf->WriteHTML($banquete);
    $pdf->WriteHTML($listasBanquete);
    $pdf->SetFont('');
    // Segunda página
    $pdf->AddPage();
    $pdf->SetLink($link);
    //$pdf->Image('logo.png',10,12,30,0,'','http://www.fpdf.org');
    //$pdf->SetLeftMargin(45);
    //$pdf->SetFontSize(14);
    $pdf->SetFont('Arial','',15);
    $pdf->WriteHTML($cabeceraBarra);
    $pdf->SetFont('Arial','',9);
    $pdf->WriteHTML($barra);
    $pdf->Output($nombre,"F");
}
?>