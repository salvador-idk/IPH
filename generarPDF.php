<?php
require_once('fpdf/fpdf.php');
require_once('fpdi/src/autoload.php');
require("conexion.php");

use \setasign\Fpdi\Fpdi;

$pdf = new FPDI();


//HECHO PROBABLEMENTE DELICTIVO
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoIPH'])) {
    $pdf->line(0, 0, 300, 400);
}

// now write some text above the imported page 
$pdf->SetFont('Arial', '', '9');
$pdf->SetTextColor(0, 0, 0);

//FECHA REGISTRO
$fechaderecha = date('d,m,Y', strtotime($_POST['linea1']));
$fechad = str_split(str_replace(",", "", $fechaderecha));
for ($i = 0; $i < count($fechad); $i++) {
    $pdf->SetXY(150 + ($i * 4.1), 20);
    $pdf->Write(0, $fechad[$i]);
}



//HORA REGISTRO
$horad = str_split(str_replace(":", "", $_POST['linea2']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(182.5 + ($i * 4.1), 20);
    } else {
        $pdf->SetXY(182 + ($i * 4.1), 20);
    }
    $pdf->Write(0, $horad[$i]);
}


//set position in pdf document
//inicio de la pagina 1
//FECHA
$fechaderecha = date('d,m,Y', strtotime($_POST['linea1']));
$fechad = str_split(str_replace(",", "", $fechaderecha));
for ($i = 0; $i < count($fechad); $i++) {
    $pdf->SetXY(25 + ($i * 4.1), 69.5);
    $pdf->Write(0, $fechad[$i]);
}   



//HORA
$horad = str_split(str_replace(":", "", $_POST['linea2']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(81.8 + ($i * 4.1), 69);
    } else {
        $pdf->SetXY(85 + ($i * 4.1), 69);
    }
    $pdf->Write(0, $horad[$i]);
}
//No. EXPEDIENTE
$expd = str_split(str_replace("", "", $_POST['linea3']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(141.6 + ($i * 4.1), 69);
    $pdf->Write(0, $expd[$i]);
}
//Equis en el cuadrito A
if (isset($_POST["anexoA"])) {
    $pdf->SetXY(65, 83.2);
    $pdf->Write(0, 'X');
}
//Detenciones
$detd = str_split(str_replace("", "", $_POST['linea15']));
for ($i = 0; $i < count($detd); $i++) {
    $pdf->SetXY(73.5 + ($i * 4.1), 83);
    $pdf->Write(0, $detd[$i]);
}

//Equis en el cuadrito B
if (isset($_POST["anexoB"])) {
    $pdf->SetXY(65, 89.5);
    $pdf->Write(0, 'X');
}
//Informe del uso de la fuerza
$infd = str_split(str_replace("", "", $_POST['linea16']));
for ($i = 0; $i < count($infd); $i++) {
    $pdf->SetXY(73.5 + ($i * 4.1), 89.7);
    $pdf->Write(0, $infd[$i]);
}

//Equis en el cuadrito C
if (isset($_POST["anexoC"])) {
    $pdf->SetXY(65, 95.5);
    $pdf->Write(0, 'X');
}
//Inspeccion de vehiculo
$insd = str_split(str_replace("", "", $_POST['linea17']));
for ($i = 0; $i < count($insd); $i++) {
    $pdf->SetXY(73.5 + ($i * 4.1), 95.7);
    $pdf->Write(0, $insd[$i]);
}

//Equis en el cuadrito D
if (isset($_POST["anexoD"])) {
    $pdf->SetXY(65, 103.3);
    $pdf->Write(0, 'X');
}
//Inventario de armas y objetos
$invd = str_split(str_replace("", "", $_POST['linea18']));
for ($i = 0; $i < count($invd); $i++) {
    $pdf->SetXY(73.5 + ($i * 4.1), 103.3);
    $pdf->Write(0, $invd[$i]);
}

//Equis en el cuadrito E
if (isset($_POST["anexoE"])) {
    $pdf->SetXY(182, 83.3);
    $pdf->Write(0, 'X');
}
//Entrevistas
$entd = str_split(str_replace("", "", $_POST['linea19']));
for ($i = 0; $i < count($entd); $i++) {
    $pdf->SetXY(190 + ($i * 4.1), 83.3);
    $pdf->Write(0, $entd[$i]);
}

//Equis en el cuadrito F
if (isset($_POST["anexoF"])) {
    $pdf->SetXY(182, 89.5);
    $pdf->Write(0, 'X');
}
//Entrega-recepci&oacuten del lugar de la intervenci&oacuten
$entrd = str_split(str_replace("", "", $_POST['linea20']));
for ($i = 0; $i < count($entrd); $i++) {
    $pdf->SetXY(190 + ($i * 4.1), 89.5);
    $pdf->Write(0, $entrd[$i]);
}

//Equis en el cuadrito G
if (isset($_POST["anexoG"])) {
    $pdf->SetXY(182, 95.7);
    $pdf->Write(0, 'X');
}


//Continuacion de la narrativa de los hechos y/i entrevista
/*$cond = str_split(str_replace("", "", $_POST['linea21']));
for ($i = 0; $i < count($cond); $i++) {
    $pdf->SetXY(190 + ($i * 4.1), 95.7);
    $pdf->Write(0, $cond[$i]);
}
*/
//¿Anexa documentacion complementaria?
//Equis en documentacion
if (isset($_POST["doc"])) {
    $pdf->SetXY(49, 110.8);
    $pdf->Write(0, 'X');
} else {
    $pdf->SetXY(49, 123);
    $pdf->Write(0, 'X');
}
//Equis en Fotografia
if (isset($_POST["anexoFO"])) {
    $pdf->SetXY(122, 110.8);
    $pdf->Write(0, 'X');
}
//Equis en audio
if (isset($_POST["anexoAU"])) {
    $pdf->SetXY(182, 110.8);
    $pdf->Write(0, 'X');
}
//Equis en video
if (isset($_POST["anexoVI"])) {
    $pdf->SetXY(122, 116.7);
    $pdf->Write(0, 'X');
}
//Equis en Comprobante Medico
if (isset($_POST["anexoCM"])) {
    $pdf->SetXY(182, 116.8);
    $pdf->Write(0, 'X');
}
//Equis en Otro
if (isset($_POST["anexoOT"])) {
    $pdf->SetXY(122, 122.8);
    $pdf->Write(0, 'X');
}
//(¿Cual?)
$pdf->SetXY(142, 122.8);
$pdf->Write(0, $_POST['linea22']);



//DATOS DE QUIEN REALIZA LA PUESTA A DISPOSICION
//Primer apellido
$pdf->SetXY(40, 134);
$pdf->Write(0, $_POST['linea4']);
//Segundo apellido
$pdf->SetXY(40, 139);
$pdf->Write(0, $_POST['linea5']);
//Nombre(s)
$pdf->SetXY(40, 144);
$pdf->Write(0, $_POST['linea6']);
//Adscripcion   
$pdf->SetXY(40, 149);
$pdf->Write(0, $_POST['linea7']);
//Cargo/Grado
$pdf->SetXY(40, 154);
$pdf->Write(0, $_POST['linea8']);

//FISCALIA/AUTORIDAD QUE RECIBE LA PUESTA A DISPOSICION
//Primer apellido
$pdf->SetXY(40, 170);
$pdf->Write(0, $_POST['linea9']);
//Segundo apellido
$pdf->SetXY(40, 175.5);
$pdf->Write(0, $_POST['linea10']);
//Nombre(s) apellido
$pdf->SetXY(40, 180.6);
$pdf->Write(0, $_POST['linea11']);
//Fiscalia/Autoridad
$pdf->SetXY(40, 185.7);
$pdf->Write(0, $_POST['linea12']);
//Adscripcion
$pdf->SetXY(40, 190.6);
$pdf->Write(0, $_POST['linea13']);
//Cargo
$pdf->SetXY(40, 195.6);
$pdf->Write(0, $_POST['linea14']);


//inicio de la pagina 2
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(2);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoIPH'])) {
    $pdf->line(0, 0, 300, 400);
}


//SECCION 2. PRIMER RESPONDIENTE
//Primer apellido
$pdf->SetXY(31, 21);
$pdf->Write(0, $_POST['linea4']);
//Segundo apellido
$pdf->SetXY(88, 21);
$pdf->Write(0, $_POST['linea5']);
//Nombre(s)
$pdf->SetXY(150, 21);
$pdf->Write(0, $_POST['linea6']);
//Guardia Nacional
if (isset($_POST["anexoGN"])) {
    $pdf->SetXY(12, 41.5);
    $pdf->Write(0, 'X');
}
//Policia Federal Ministerial
if (isset($_POST["anexoPFM"])) {
    $pdf->SetXY(12, 47);
    $pdf->Write(0, 'X');
}
//Policia Ministerial
if (isset($_POST["anexoPM"])) {
    $pdf->SetXY(81.2, 36.1);
    $pdf->Write(0, 'X');
}
$pdf->SetXY(118, 36.1);
$pdf->Write(0, $_POST['linea26']);


//Policia Mando Unico
if (isset($_POST["anexoPMU"])) {
    $pdf->SetXY(81.2, 41.7);
    $pdf->Write(0, 'X');
}
$pdf->SetXY(118, 41.7);
$pdf->Write(0, $_POST['linea27']);

//Policia Estatal
if (isset($_POST["anexoPE"])) {
    $pdf->SetXY(81.2, 46.7);
    $pdf->Write(0, 'X');
}
$pdf->SetXY(118, 46.7);
$pdf->Write(0, $_POST['linea28']);

//Policia Municipal
if (isset($_POST["anexoPMUN"])) {
    $pdf->SetXY(81.2, 51.8);
    $pdf->Write(0, 'X');
}
$pdf->SetXY(118, 51.8);
$pdf->Write(0, $_POST['linea29']);

//Cual es su grado o cargo
$pdf->SetXY(118, 57);
$pdf->Write(0, $_POST['linea32']);

//¿Cúal es su grado o cargo?
$pdf->SetXY(89, 64.3);
$pdf->Write(0, $_POST['linea30']);

//¿En que unidad arrib&oacute al lugar de la intervenci&oacuten?
$pdf->SetXY(89, 70);
$pdf->Write(0, $_POST['linea31']);

//Guardia Nacional
if (isset($_POST["anexoNA"])) {
    $pdf->SetXY(190, 70);
    $pdf->Write(0, 'X');
}

//Equis en arribo elemento
if (isset($_POST["anexoI"])) {
    $pdf->SetXY(97.5, 76);
    $pdf->Write(0, 'X');

    $cuantosd = str_split(str_replace("", "", $_POST['linea33']));
    for ($i = 0; $i < count($cuantosd); $i++) {
        $pdf->SetXY(122 + ($i * 4.1), 76);
        $pdf->Write(0, $cuantosd[$i]);
    }
} else {
    $pdf->SetXY(190, 76);
    $pdf->Write(0, 'X');
}



//SECCION 3. CONOCIMIENTO DEL ECHO Y SEGUIMIENTO DE LA ACTUACION DE LA AUTORIDAD
//Denuncia
if (isset($_POST["den"])) {
    $pdf->SetXY(49.5, 104);
    $pdf->Write(0, 'X');
}
//Flagrancia
if (isset($_POST["flaG"])) {
    $pdf->SetXY(93.5, 104);
    $pdf->Write(0, 'X');
}
//Localizacion
if (isset($_POST["loc"])) {
    $pdf->SetXY(134, 104);
    $pdf->Write(0, 'X');
}
//Mandamiento judicial
if (isset($_POST["manJ"])) {
    $pdf->SetXY(190, 104);
    $pdf->Write(0, 'X');
}
//Llamada de emergencia
if (isset($_POST["LlamadaEM"])) {
    $pdf->SetXY(49.5, 109);
    $pdf->Write(0, 'X');
}
//Descubrimiento
if (isset($_POST["des"])) {
    $pdf->SetXY(93.5, 109);
    $pdf->Write(0, 'X');
}
//Aportacion
if (isset($_POST["apo"])) {
    $pdf->SetXY(134, 109);
    $pdf->Write(0, 'X');
}
//911 No.
$nueveonced = str_split(str_replace("", "", $_POST['linea34']));
for ($i = 0; $i < count($nueveonced); $i++) {
    $pdf->SetXY(24.5 + ($i * 4.1), 113.8);
    $pdf->Write(0, $nueveonced[$i]);
}

//SECCION 3 CONOCIMIENTO DEL HECHO Y SEGUIMIENTO DE LA ACTUACION DE LA AUTORIDAD
//Apartado 3.2 Seguimiento de la actuacion de la autoridad
//FECHA
$fechaderecha = date('d,m,Y', strtotime($_POST['linea35']));
$fechad = str_split(str_replace(",", "", $fechaderecha));
for ($i = 0; $i < count($fechad); $i++) {
    $pdf->SetXY(45 + ($i * 4.1), 134.5);
    $pdf->Write(0, $fechad[$i]);
}


//HORA
$horad = str_split(str_replace(":", "", $_POST['linea36']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(45 + ($i * 4.1), 144);
    } else {
        $pdf->SetXY(49 + ($i * 4.1), 144);
    }
    $pdf->Write(0, $horad[$i]);
}
//FECHA
if (isset($_POST["linea37"])) {
    $fechaderecha = date('d,m,Y', strtotime($_POST['linea37']));
    $fechad = str_split(str_replace(",", "", $fechaderecha));
    for ($i = 0; $i < count($fechad); $i++) {
        $pdf->SetXY(138 + ($i * 4.1), 134.5);
        $pdf->Write(0, $fechad[$i]);
    }
}

//HORA
$horad = str_split(str_replace(":", "", $_POST['linea38']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(138 + ($i * 4.1), 144);
    } else {
        $pdf->SetXY(142 + ($i * 4.1), 144);
    }
    $pdf->Write(0, $horad[$i]);
}

//SECCION 4. LUGAR DE LA INTERVENCIÓN
//Calle/Tramo carretero
$pdf->SetXY(49, 176);
$pdf->Write(0, $_POST['linea39']);
//No. exterior
$pdf->SetXY(35.5, 182);
$pdf->Write(0, $_POST['linea40']);
//No. interior
$pdf->SetXY(109.5, 182);
$pdf->Write(0, $_POST['linea41']);
//No. interior
$pdf->SetXY(178, 182);
$pdf->Write(0, $_POST['linea42']);
//Colonia/Localidad
$pdf->SetXY(49, 188);
$pdf->Write(0, $_POST['linea43']);
//Municipio/Demarcación territorial
$pdf->SetXY(49, 194.7);
$pdf->Write(0, $_POST['linea44']);
//Entidad federativa
$pdf->SetXY(49, 200.7);
$pdf->Write(0, $_POST['linea45']);
//Referencias
$pdf->SetXY(49, 206.7);
$pdf->Write(0, $_POST['linea46']);
//Latitud
$latd = str_split(str_replace(".", "", $_POST['linea47']));
for ($i = 0; $i < count($latd); $i++) {
    if ($i < 2) {
        $pdf->SetXY(24.4 + ($i * 4.1), 218);
    } else {
        $pdf->SetXY(29 + ($i * 4.1), 218);
    }
    $pdf->Write(0, $latd[$i]);
}
//Longitud
$lond = str_split(str_replace(".", "", $_POST['linea48']));
for ($i = 0; $i < count($lond); $i++) {
    if ($i < 3) {
        $pdf->SetXY(93.8 + ($i * 4.1), 218);
    } else {
        $pdf->SetXY(97.5 + ($i * 4.1), 218);
    }
    $pdf->Write(0, $lond[$i]);
}


//inicio de la pagina 3
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(3);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoIPH'])) {
    $pdf->line(0, 0, 300, 400);
}


//Equis en realizo la inspeccion del lugar?
if (isset($_POST["ins"])) {
    $pdf->SetXY(162, 200);
    $pdf->Write(0, 'X');
} else {
    $pdf->SetXY(198, 200);
    $pdf->Write(0, 'X');
}
//Equis en objeto relacionado con los hechos
if (isset($_POST["obj"])) {
    $pdf->SetXY(162, 206.2);
    $pdf->Write(0, 'X');
} else {
    $pdf->SetXY(198, 206.2);
    $pdf->Write(0, 'X');
}
//Equis en preservo el lugar de la intervencion
if (isset($_POST["pre"])) {
    $pdf->SetXY(162, 212.4);
    $pdf->Write(0, 'X');
} else {
    $pdf->SetXY(198, 212.4);
    $pdf->Write(0, 'X');
}
//Equis en Llevo a cabo la priorizacion en el lugar de la intervencion
if (isset($_POST["pri"])) {
    $pdf->SetXY(162, 218.6);
    $pdf->Write(0, 'X');
} else {
    $pdf->SetXY(198, 218.6);
    $pdf->Write(0, 'X');
}
//Equis en sociales
if (isset($_POST["soc"])) {
    $pdf->SetXY(85.3, 225);
    $pdf->Write(0, 'X');
}
//Equis en naturrales
if (isset($_POST["nat"])) {
    $pdf->SetXY(126.5, 225);
    $pdf->Write(0, 'X');
}
//Especifique
$pdf->SetXY(36, 231);
$pdf->Write(0, $_POST["linea49"]);



// inicio de la pagina 4
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(4);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoIPH'])) {
    $pdf->line(0, 0, 300, 400);
}





//Apartado 5. Descripción de los echos y actuación de la autoridad
//narrativa de los hechos
$posicion = 31;
$narrd = explode("\n", $_POST['narrativaHech'], 110);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 110);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 7;
    }
}






// inicio de Anexo A
//Detenciones
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(5);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoA'])) {
    $pdf->line(0, 0, 300, 400);
}


$deted = str_split(str_replace("", "", $_POST['linea51']));
for ($i = 0; $i < count($deted); $i++) {
    $pdf->SetXY(37 + ($i * 4.1), 15);
    $pdf->Write(0, $deted[$i]);
}
$numd = str_split(str_replace("", "", $_POST['linea52']));
for ($i = 0; $i < count($numd); $i++) {
    $pdf->SetXY(146 + ($i * 4.1), 15);
    $pdf->Write(0, $numd[$i]);
}


//Apartado A.1 fecha y hora de la detencion
//FECHA
if (isset($_POST["anexoA"])) {
    $fechaderecha = date('d,m,Y', strtotime($_POST['linea53']));
    $fechad = str_split(str_replace(",", "", $fechaderecha));
    for ($i = 0; $i < count($fechad); $i++) {
        $pdf->SetXY(24.8 + ($i * 4.1), 31.5);
        $pdf->Write(0, $fechad[$i]);
    }
}

//HORA
$horad = str_split(str_replace(":", "", $_POST['linea54']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(90 + ($i * 4.1), 31.5);
    } else {
        $pdf->SetXY(94 + ($i * 4.1), 31.5);
    }
    $pdf->Write(0, $horad[$i]);
}

//Apartado A.2 Datos generales de la persona detenida
//Primer apellido
$pdf->SetXY(28, 45);
$pdf->Write(0, $_POST['linea55']);

//Segundo apellido
$pdf->SetXY(88, 45);
$pdf->Write(0, $_POST['linea56']);

//Nombre(s)
$pdf->SetXY(155, 45);
$pdf->Write(0, $_POST['linea57']);

//Apodo o alias
$pdf->SetXY(37, 54);
$pdf->Write(0, $_POST['linea58']);

//Equis en Nacionalidad
//mexicana
if (isset($_POST["mex"])) {
    $pdf->SetXY(73, 60.5);
    $pdf->Write(0, 'X');
}
//extranjera
if (isset($_POST["ext"])) {
    $pdf->SetXY(134, 60.5);
    $pdf->Write(0, 'X');
}
//¿Cual?
$pdf->SetXY(166, 60.5);
$pdf->Write(0, $_POST['linea59']);

//Sexo
//mujer
if (isset($_POST["muj"])) {
    $pdf->SetXY(73, 66);
    $pdf->Write(0, 'X');
}
//hombre
if (isset($_POST["hom"])) {
    $pdf->SetXY(134, 66);
    $pdf->Write(0, 'X');
}


//Fecha de nacimiento
if (isset($_POST["anexoA"])) {
    $fechadenacimiento = date('d,m,Y', strtotime($_POST['nac']));
    $fechad = str_split(str_replace(",", "", $fechadenacimiento));
    for ($i = 0; $i < count($fechad); $i++) {
        $pdf->SetXY(61 + ($i * 4.1), 71.7);
        $pdf->Write(0, $fechad[$i]);
    }
}

//Edad
$edadd = str_split(str_replace("", "", $_POST['edad']));
for ($i = 0; $i < count($edadd); $i++) {
    $pdf->SetXY(130 + ($i * 4.1), 71.7);
    $pdf->Write(0, $edadd[$i]);
}

//ine
if (isset($_POST["ine"])) {
    $pdf->SetXY(89.5, 81.5);
    $pdf->Write(0, 'X');
}
//licencia
if (isset($_POST["lice"])) {
    $pdf->SetXY(114, 81.5);
    $pdf->Write(0, 'X');
}
//pasaporte
if (isset($_POST["pas"])) {
    $pdf->SetXY(142, 81.5);
    $pdf->Write(0, 'X');
}
//Otro
$pdf->SetXY(161, 81.5);
$pdf->Write(0, $_POST['linea60']);
//No
if (isset($_POST["no"])) {
    $pdf->SetXY(198, 81.5);
    $pdf->Write(0, 'X');
}
//No. de identificacion
$ided = str_split(str_replace("", "", $_POST['linea61']));
for ($i = 0; $i < count($ided); $i++) {
    $pdf->SetXY(45 + ($i * 4.1), 87.5);
    $pdf->Write(0, $ided[$i]);
}
// Domicilio de la persona detenida
//Calle/Tramo carretero
$pdf->SetXY(49, 99);
$pdf->Write(0, $_POST['linea62']);
//No. exterior
$pdf->SetXY(35.5, 105);
$pdf->Write(0, $_POST['linea63']);
//No. interior
$pdf->SetXY(109.5, 105);
$pdf->Write(0, $_POST['linea64']);
//No. interior
$pdf->SetXY(178, 105);
$pdf->Write(0, $_POST['linea65']);
//Colonia/Localidad
$pdf->SetXY(49, 111);
$pdf->Write(0, $_POST['linea66']);
//Municipio/Demarcación territorial
$pdf->SetXY(49, 117.7);
$pdf->Write(0, $_POST['linea67']);
//Entidad federativa
$pdf->SetXY(49, 123.7);
$pdf->Write(0, $_POST['linea68']);
//Referencias
$pdf->SetXY(49, 129.7);
$pdf->Write(0, $_POST['linea69']);

//Equis en ¿La persona detenida presenta lesiones visibles?
//Si
if (isset($_POST["lesionessi"])) {
    $pdf->SetXY(89.5, 176.3);
    $pdf->Write(0, 'X');
}
//No
if (isset($_POST["lesionesno"])) {
    $pdf->SetXY(105.5, 176.3);
    $pdf->Write(0, 'X');
}

//Equis en ¿manifiesta tener algun padecimiento?
if (isset($_POST["ManifiestaSi"])) {
    $pdf->SetXY(89.5, 181.8);
    $pdf->Write(0, 'X');

    //(¿Cual?)
    $pdf->SetXY(113, 181.8);
    $pdf->Write(0, $_POST['linea70']);
}
if (isset($_POST["ManifiestaNo"])) {
    $pdf->SetXY(194, 181.8);
    $pdf->Write(0, 'X');
}

//Equis en ¿La persona detenida se identificó como miembro de algún grupo vulnerable?
if (isset($_POST["vulnerableSi"])) {
    $pdf->SetXY(126, 186.8);
    $pdf->Write(0, 'X');

    //(¿Cual?)
    $pdf->SetXY(142, 186.8);
    $pdf->Write(0, $_POST['linea71']);
}



//Equis en ¿La persona detenida se identificó como integrante de algún grupo delictivo?
if (isset($_POST["delictivoSi"])) {
    $pdf->SetXY(126, 192.4);
    $pdf->Write(0, 'X');

    //(¿Cual?)
    $pdf->SetXY(140, 192.4);
    $pdf->Write(0, $_POST['linea72']);
}
if (isset($_POST["delictivoNo"])) {
    $pdf->SetXY(194, 192.4);
    $pdf->Write(0, 'X');
}

//Apartado A.3 Datos del familiar o persona de confianza señalado por la persona detenida
//Primer apellido
$pdf->SetXY(28, 203);
$pdf->Write(0, $_POST['linea73']);

//Segundo apellido
$pdf->SetXY(88, 203);
$pdf->Write(0, $_POST['linea74']);

//Nombre(s)
$pdf->SetXY(155, 203);
$pdf->Write(0, $_POST['linea75']);

//No. telefonico
$expd = str_split(str_replace("-", "", $_POST['linea76']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(36.4 + ($i * 4.1), 213.3);
    $pdf->Write(0, $expd[$i]);
}

//No proporcionado
if (isset($_POST['No_tel'])) {
    $pdf->SetXY(154.5, 212.5);
    $pdf->Write(0, 'x');
}




//Inicia pagina 6
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(6);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoA'])) {
    $pdf->line(0, 0, 300, 400);
}



//Apartado A.4 Constancia de lectura de derechos de la persona detenida
//Articulo 20 apartado B de la constitucion politica de los Estados Unidos Mexicanos y articulo 152 del Codigo Nacional de Procedimeintos Penales
//¿Le informo sus derechos a la persona detenida?
if (isset($_POST['sider'])) {
    $pdf->SetXY(90, 90);
    $pdf->Write(0, 'X');
}
if (isset($_POST['noder'])) {
    $pdf->SetXY(105.5, 90);
    $pdf->Write(0, 'X');
}

//Apartado A.5 Inspecci&oacuten a la persona detenida
//¿Le encontro algun objeto relacionado con los hechos?
if (isset($_POST["obj"])) {
    $pdf->SetXY(32.5, 117);
    $pdf->Write(0, 'X');
}
if (isset($_POST['objno'])) {
    $pdf->SetXY(97.5, 117);
    $pdf->Write(0, 'X');
}

//¿Recolecto pertenencias de la persona detenida?
if (isset($_POST['tabla'])) {
    $pdf->SetXY(97.5, 122);
    $pdf->Write(0, 'X');
}
if (isset($_POST['pertenenciasNo'])) {
    $pdf->SetXY(166, 122);
    $pdf->Write(0, 'X');
}

//Tabla
//pertenencia 1
$pdf->SetXY(24, 133);
$pdf->Write(0, $_POST['linea77']);
//Descripcion 1
$pdf->SetXY(81, 133);
$pdf->Write(0, $_POST['linea78']);
//Destino que se le dio1
$pdf->SetXY(158, 133);
$pdf->Write(0, $_POST['linea79']);

//pertenencia 2
$pdf->SetXY(24, 139);
$pdf->Write(0, $_POST['linea80']);
//Descripcion 2
$pdf->SetXY(81, 139);
$pdf->Write(0, $_POST['linea81']);
//Destino que se le dio2
$pdf->SetXY(158, 139);
$pdf->Write(0, $_POST['linea82']);

//pertenencia 3
$pdf->SetXY(24, 145);
$pdf->Write(0, $_POST['linea83']);
//Descripcion 3
$pdf->SetXY(81, 145);
$pdf->Write(0, $_POST['linea84']);
//Destino que se le dio3
$pdf->SetXY(158, 145);
$pdf->Write(0, $_POST['linea85']);

//pertenencia 4
$pdf->SetXY(24, 151);
$pdf->Write(0, $_POST['linea86']);
//Descripcion 4
$pdf->SetXY(81, 151);
$pdf->Write(0, $_POST['linea87']);
//Destino que se le dio4
$pdf->SetXY(158, 151);
$pdf->Write(0, $_POST['linea88']);

//pertenencia 5
$pdf->SetXY(24, 157);
$pdf->Write(0, $_POST['linea89']);
//Descripcion 5
$pdf->SetXY(81, 157);
$pdf->Write(0, $_POST['linea90']);
//Destino que se le dio5
$pdf->SetXY(158, 157);
$pdf->Write(0, $_POST['linea91']);

//pertenencia 6
$pdf->SetXY(24, 163);
$pdf->Write(0, $_POST['linea92']);
//Descripcion 5
$pdf->SetXY(81, 163);
$pdf->Write(0, $_POST['linea93']);
//Destino que se le dio5
$pdf->SetXY(158, 163);
$pdf->Write(0, $_POST['linea94']);

//pertenencia 7
$pdf->SetXY(24, 169);
$pdf->Write(0, $_POST['linea95']);
//Descripcion 5
$pdf->SetXY(81, 169);
$pdf->Write(0, $_POST['linea96']);
//Destino que se le dio5
$pdf->SetXY(158, 169);
$pdf->Write(0, $_POST['linea97']);

//pertenencia 8
$pdf->SetXY(24, 175);
$pdf->Write(0, $_POST['linea98']);
//Descripcion 5
$pdf->SetXY(81, 175);
$pdf->Write(0, $_POST['linea99']);
//Destino que se le dio5
$pdf->SetXY(158, 175);
$pdf->Write(0, $_POST['linea100']);

//pertenencia 9
$pdf->SetXY(24, 181);
$pdf->Write(0, $_POST['linea101']);
//Descripcion 5
$pdf->SetXY(81, 181);
$pdf->Write(0, $_POST['linea102']);
//Destino que se le dio5
$pdf->SetXY(158, 181);
$pdf->Write(0, $_POST['linea103']);

//pertenencia 10
$pdf->SetXY(24, 187);
$pdf->Write(0, $_POST['linea104']);
//Descripcion 5
$pdf->SetXY(81, 187);
$pdf->Write(0, $_POST['linea105']);
//Destino que se le dio5
$pdf->SetXY(158, 187);
$pdf->Write(0, $_POST['linea106']);

//Apartado A.6 Datos del lugar de la detencion
//¿El lugar de la detencion es el mismo que el de la intervencion?
if (isset($_POST['dire'])) {
    $pdf->SetXY(122.2, 198.6);
    $pdf->Write(0, 'X');
}
if (isset($_POST['direNo'])) {
    $pdf->SetXY(150.2, 198.6);
    $pdf->Write(0, 'X');
}

//Calle/Tramo carretero
$pdf->SetXY(49, 205.7);
$pdf->Write(0, $_POST['linea107']);
//No. exterior
$pdf->SetXY(35.5, 211.7);
$pdf->Write(0, $_POST['linea108']);
//No. interior
$pdf->SetXY(109.5, 211.7);
$pdf->Write(0, $_POST['linea109']);
//No. interior
$pdf->SetXY(178, 211.7);
$pdf->Write(0, $_POST['linea110']);
//Colonia/Localidad
$pdf->SetXY(49, 217.7);
$pdf->Write(0, $_POST['linea111']);
//Municipio/Demarcación territorial
$pdf->SetXY(49, 223.7);
$pdf->Write(0, $_POST['linea112']);
//Entidad federativa
$pdf->SetXY(49, 229.7);
$pdf->Write(0, $_POST['linea113']);
//Referencias
$pdf->SetXY(49, 235.7);
$pdf->Write(0, $_POST['linea114']);

//Inicia pagina 7
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(7);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoA'])) {
    $pdf->line(0, 0, 300, 400);
}

//Apartado A.7 Datos del lugar del traslado de la persona detenida
//Fiscalia/Agencia
if (isset($_POST['fisAge'])) {
    $pdf->SetXY(73.3, 19.2);
    $pdf->Write(0, 'X');
}
//Hospital
if (isset($_POST['hos'])) {
    $pdf->SetXY(114, 19.2);
    $pdf->Write(0, 'X');
}
//Otra dependencia
if (isset($_POST['otraDep'])) {
    $pdf->SetXY(166, 19.2);
    $pdf->Write(0, 'X');
}
//¿Cual?
$pdf->SetXY(40, 24.5);
$pdf->Write(0, $_POST['linea115']);



$posicion = 40;
$narrd = explode("\n", $_POST['linea116']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 90);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 6.5;
    }
}
/*
//Observaciones relacionadas con la detencion
$narrd = str_split($_POST['linea116'], 110);
for ($i = 0; $i < count($narrd); $i++) {
    $pdf->SetXY(12, 40 + ($i * 6));
    $pdf->Write(0, $narrd[$i]);
}
*/
//Apartado A.8 Datos del primer respondiente que realizo la detencion
//Primer apellido
$pdf->SetXY(26, 77.6);
$pdf->Write(0, $_POST['linea117']);

//Segundo apellido
$pdf->SetXY(89, 77.6);
$pdf->Write(0, $_POST['linea118']);

//Nombre(s)
$pdf->SetXY(147, 77.6);
$pdf->Write(0, $_POST['linea119']);

//Adscripcion
$pdf->SetXY(32, 86.5);
$pdf->Write(0, $_POST['linea120']);

//Cargo/Grado
$pdf->SetXY(98, 86.5);
$pdf->Write(0, $_POST['linea121']);

//Primero respondiente 2
//Primer apellido
$pdf->SetXY(26, 92);
$pdf->Write(0, $_POST['linea122']);

//Segundo apellido
$pdf->SetXY(89, 92);
$pdf->Write(0, $_POST['linea123']);

//Nombre(s)
$pdf->SetXY(147, 92);
$pdf->Write(0, $_POST['linea124']);

//Adscripcion
$pdf->SetXY(32, 101);
$pdf->Write(0, $_POST['linea125']);

//Cargo/Grado
$pdf->SetXY(98, 101);
$pdf->Write(0, $_POST['linea126']);


//ANEXO B
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(8);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoB'])) {
    $pdf->line(0, 0, 300, 400);
}

//Apartado B.1 Niveles del uso de la fuerza

//Lesionados Autoridad
if (isset($_POST['lesionadosAut'])) {
    $pdf->SetXY(40.5, 35.2);
    $pdf->Write(0, 'X');
}
//
$expd = str_split(str_replace("", "", $_POST['lesAut']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(49 + ($i * 4.1), 35);
    $pdf->Write(0, $expd[$i]);
}

//Lesionados Persona
if (isset($_POST['lesionadosPer'])) {
    $pdf->SetXY(73, 35.2);
    $pdf->Write(0, 'X');
}
//
$expd = str_split(str_replace("", "", $_POST['lesPer']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(81.5 + ($i * 4.1), 35);
    $pdf->Write(0, $expd[$i]);
}

//Fallecidos Autoridad
if (isset($_POST['fallesidosAut'])) {
    $pdf->SetXY(40.5, 40.8);
    $pdf->Write(0, 'X');
}
//
$expd = str_split(str_replace("", "", $_POST['fallAut']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(49 + ($i * 4.1), 40.5);
    $pdf->Write(0, $expd[$i]);
}

//Fallecidos Persona
if (isset($_POST['fallesidosPer'])) {
    $pdf->SetXY(73, 40.8);
    $pdf->Write(0, 'X');
}
//
$expd = str_split(str_replace("", "", $_POST['fallPer']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(81.5 + ($i * 4.1), 40.5);
    $pdf->Write(0, $expd[$i]);
}

//Reduccion fisica de movimientos
if (isset($_POST['rfm'])) {
    $pdf->SetXY(186, 30.4);
    $pdf->Write(0, 'X');
}
//Utilizacion de armas incapacitantes menos letal
if (isset($_POST['uaiml'])) {
    $pdf->SetXY(186, 35.4);
    $pdf->Write(0, 'X');
}
//Utilizacion de armas de fuego o fuerza letal
if (isset($_POST['uaffl'])) {
    $pdf->SetXY(186, 40.4);
    $pdf->Write(0, 'X');
}

//Describa las conductas (resistencia activa y de alta peligrosidad) que motivaron el uso de la fuerza:
$posicion = 51;
$narrd = explode("\n", $_POST['linea127'], 90);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 110);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (6.5);
    }
}



/*
$narrd = str_split($_POST['linea127'], 120);
for ($i = 0; $i < count($narrd); $i++) {
    $pdf->SetXY(12, 51 + ($i * 6.5));
    $pdf->Write(0, $narrd[$i]);
}*/

//¿Brindo o solicito asistencia medica?
if (isset($_POST["bsamSi"])) {
    $pdf->SetXY(81.5, 131.2);
    $pdf->Write(0, 'X');
}
if (isset($_POST["bsamNo"])) {
    $pdf->SetXY(114, 131.2);
    $pdf->Write(0, 'X');
}

//Explique:
$posicion = 142;
$narrd = explode("\n", $_POST['expl'], 90);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 110);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (6.5);
    }
}

//Apartado B.2 Datos del primer respondiente que realizo el informe del uso de la fuerza, solo si es diferente a quien firmo la puesta la disposicion
//Primer apellido
$pdf->SetXY(26, 198);
$pdf->Write(0, $_POST['linea128']);

//Segundo apellido
$pdf->SetXY(89, 198);
$pdf->Write(0, $_POST['linea129']);

//Nombre(s)
$pdf->SetXY(147, 198);
$pdf->Write(0, $_POST['linea130']);

//Adscripcion
$pdf->SetXY(32, 207);
$pdf->Write(0, $_POST['linea131']);

//Cargo/Grado
$pdf->SetXY(98, 207);
$pdf->Write(0, $_POST['linea132']);

//Primero respondiente 2
//Primer apellido
$pdf->SetXY(26, 213);
$pdf->Write(0, $_POST['linea133']);

//Segundo apellido
$pdf->SetXY(89, 213);
$pdf->Write(0, $_POST['linea134']);

//Nombre(s)
$pdf->SetXY(147, 213);
$pdf->Write(0, $_POST['linea135']);

//Adscripcion
$pdf->SetXY(32, 222);
$pdf->Write(0, $_POST['linea136']);

//Cargo/Grado
$pdf->SetXY(98, 222);
$pdf->Write(0, $_POST['linea137']);


//ANEXO C
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(9);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoC'])) {
    $pdf->line(0, 0, 300, 400);
}

//Apartado C.1 Fecha y hora de la inspección
//FECHA
$fechaderecha = date('d,m,Y', strtotime($_POST['fecC1']));
$fechad = str_split(str_replace(",", "", $fechaderecha));
for ($i = 0; $i < count($fechad); $i++) {
    $pdf->SetXY(24.8 + ($i * 4.1), 33);
    $pdf->Write(0, $fechad[$i]);
}

//Inspeccion de vehiculo
$insd = str_split(str_replace("", "", $_POST['linea17']));
for ($i = 0; $i < count($insd); $i++) {
    $pdf->SetXY(24 + ($i * 4.1), 20);
    $pdf->Write(0, $insd[$i]);
}
//HORA
$horad = str_split(str_replace(":", "", $_POST['horC1']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(81.3 + ($i * 4.1), 33);
    } else {
        $pdf->SetXY(85.3 + ($i * 4.1), 33);
    }
    $pdf->Write(0, $horad[$i]);
}

//Apartado C.2 Datos generales del vehículo inspeccionado
//Tipo
//Terrestre
if (isset($_POST["terrestre"])) {
    $pdf->SetXY(32.5, 53);
    $pdf->Write(0, 'X');
}
//Acuatico
if (isset($_POST["acuatic"])) {
    $pdf->SetXY(65.2, 52.6);
    $pdf->Write(0, 'X');
}
//Aereo
if (isset($_POST['aereo'])) {
    $pdf->SetXY(97.2, 52.6);
    $pdf->Write(0, 'X');
}
//nacional
if (isset($_POST['nacional'])) {
    $pdf->SetXY(158, 52.6);
    $pdf->Write(0, 'X');
}
//extranjero
if (isset($_POST['extranjero'])) {
    $pdf->SetXY(194, 52.6);
    $pdf->Write(0, 'X');
}

//Marca
$pdf->SetXY(24.5, 60);
$pdf->Write(0, $_POST['marca']);
//Submarca
$pdf->SetXY(77, 60);
$pdf->Write(0, $_POST['submarca']);

//Modelo
$expd = str_split(str_replace("", "", $_POST['modelo']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(134 + ($i * 4.1), 59.5);
    $pdf->Write(0, $expd[$i]);
}
//Color
$pdf->SetXY(178, 60);
$pdf->Write(0, $_POST['color']);

//Equis en particular
if (isset($_POST['particular'])) {
    $pdf->SetXY(32.5, 70);
    $pdf->Write(0, 'X');
}
//Equis en transporte publico
if (isset($_POST['tp'])) {
    $pdf->SetXY(109.5, 70);
    $pdf->Write(0, 'X');
}
//Equis en cargo
if (isset($_POST['cargo'])) {
    $pdf->SetXY(158, 70);
    $pdf->Write(0, 'X');
}

//Placa/Matricula
$expd = str_split(str_replace("", "", $_POST['plaMa']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(45.5 + ($i * 4.1), 77);
    $pdf->Write(0, $expd[$i]);
}
//No. de serie
$expd = str_split(str_replace("", "", $_POST['serie1']));
for ($i = 0; $i < count($expd); $i++) {
    $pdf->SetXY(117.5 + ($i * 4.1), 77);
    $pdf->Write(0, $expd[$i]);
}
//Equis en con reporte de robo
if (isset($_POST['reporteRob'])) {
    $pdf->SetXY(49.6, 88.2);
    $pdf->Write(0, 'X');
}
//Equis en sin reporte de robo
if (isset($_POST['srr'])) {
    $pdf->SetXY(118, 88.2);
    $pdf->Write(0, 'X');
}
//Equis en no es posible saberlo
if (isset($_POST['nps'])) {
    $pdf->SetXY(186, 88.2);
    $pdf->Write(0, 'X');
}

$posicion = 100;
$narrd = explode("\n", $_POST['Observaciones'], 90);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 110);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 6;
    }
}
/*
//Observaciones
$narrd = str_split($_POST['obs'], 119);
for ($i = 0; $i < count($narrd); $i++) {
    $pdf->SetXY(12, 100 + ($i * 6));
    $pdf->Write(0, $narrd[$i]);
}

*/
//Destino que se le dio
$narrd = str_split($_POST['dqsld'], 120);
for ($i = 0; $i < count($narrd); $i++) {
    $pdf->SetXY(12, 120 + ($i * 6));
    $pdf->Write(0, $narrd[$i]);
}
//Apartado C.3 Objetos encontrados en el vehiculo inspeccionado
//Encontro objetos relacionados con los hechos
if (isset($_POST['eorclhSi'])) {
    $pdf->SetXY(85.5, 135);
    $pdf->Write(0, 'X');
}
if (isset($_POST['eorclhNo'])) {
    $pdf->SetXY(154.5, 135);
    $pdf->Write(0, 'X');
}

//Apartado C.4 Datos del primer respondiente que realizo la inspeccion, solo si es diferente a quien firmo la puesta a disposicion
//Primer apellido
$pdf->SetXY(26, 145);
$pdf->Write(0, $_POST['linea138']);

//Segundo apellido
$pdf->SetXY(89, 145);
$pdf->Write(0, $_POST['linea139']);

//Nombre(s)
$pdf->SetXY(147, 145);
$pdf->Write(0, $_POST['linea140']);

//Adscripcion
$pdf->SetXY(32, 154);
$pdf->Write(0, $_POST['linea141']);

//Cargo/Grado
$pdf->SetXY(98, 154);
$pdf->Write(0, $_POST['linea142']);

//Primero respondiente 2
//Primer apellido
$pdf->SetXY(26, 161);
$pdf->Write(0, $_POST['linea143']);

//Segundo apellido
$pdf->SetXY(89, 161);
$pdf->Write(0, $_POST['linea144']);

//Nombre(s)
$pdf->SetXY(147, 161);
$pdf->Write(0, $_POST['linea145']);

//Adscripcion
$pdf->SetXY(32, 170);
$pdf->Write(0, $_POST['linea146']);

//Cargo/Grado
$pdf->SetXY(98, 170);
$pdf->Write(0, $_POST['linea147']);


//ANEXO D
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(10);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoD'])) {
    $pdf->line(0, 0, 300, 400);
}

$invd = str_split(str_replace("", "", $_POST['linea18']));
for ($i = 0; $i < count($invd); $i++) {
    $pdf->SetXY(32.2 + ($i * 4.1), 20.8);
    $pdf->Write(0, $invd[$i]);
}
//Aportacion
if (isset($_POST['aportacion'])) {
    $pdf->SetXY(45.4, 29.4);
    $pdf->Write(0, 'X');
}
//Inspeccion
//lugar
if (isset($_POST['lugar'])) {
    $pdf->SetXY(45.2, 39.4);
    $pdf->Write(0, 'X');
}
//Persona
if (isset($_POST['pers'])) {
    $pdf->SetXY(73.2, 39.4);
    $pdf->Write(0, 'X');
}
//Vehiculo
if (isset($_POST['vehic'])) {
    $pdf->SetXY(101.3, 39.4);
    $pdf->Write(0, 'X');
}
//¿Donde se encontro el arma?
$pdf->SetXY(150, 39);
$pdf->Write(0, $_POST['dea']);

//Tipo de arma
//Corta
if (isset($_POST['corta'])) {
    $pdf->SetXY(45.2, 49.8);
    $pdf->Write(0, 'X');
}
//Larga
if (isset($_POST['larga'])) {
    $pdf->SetXY(73.2, 49.8);
    $pdf->Write(0, 'X');
}

//calibre
$pdf->SetXY(113, 45);
$pdf->Write(0, $_POST['calibre']);
//color
$pdf->SetXY(170, 45);
$pdf->Write(0, $_POST['color']);

//Matricula:
$matd = str_split(str_replace("", "", $_POST['matricula']));
for ($i = 0; $i < count($matd); $i++) {
    $pdf->SetXY(28.4 + ($i * 4.1), 56);
    $pdf->Write(0, $matd[$i]);
}

//No. de serie:
$matd = str_split(str_replace("", "", $_POST['serie']));
for ($i = 0; $i < count($matd); $i++) {
    $pdf->SetXY(109.2 + ($i * 4.1), 56);
    $pdf->Write(0, $matd[$i]);
}

//Observaciones(de ser el caso señales ademas caracteristicas, marca, cargadores y cartuchos)
$posicion = 64;
$narrd = explode("\n", $_POST['obs'], 110);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 110);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (4.3);
    }
}

//Destino que se le dio
$posicion = 73;
$narrd = explode("\n", $_POST['dest']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 75);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(40, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (4);
    }
}

//Anote el nombre y firma de la persona a la que se le aseguro el arma
//Primer apellido
$pdf->SetXY(15, 85.7);
$pdf->Write(0, $_POST['linead1']);
//Segundo apellido
$pdf->SetXY(58, 85.7);
$pdf->Write(0, $_POST['linead2']);
//Nombre(s)
$pdf->SetXY(102, 85.7);
$pdf->Write(0, $_POST['linead3']);

//En caso que la persona a la que se le aseguro el arma no accede a firmar, anote nombre y firma de dos testigos
//Primer apellido
$pdf->SetXY(15, 97.6);
$pdf->Write(0, $_POST['linead4']);
//Segundo apellido
$pdf->SetXY(58, 97.6);
$pdf->Write(0, $_POST['linead5']);
//Nombre(s)
$pdf->SetXY(102, 97.6);
$pdf->Write(0, $_POST['linead6']);

//testigo 2
//Primer apellido
$pdf->SetXY(15, 105.6);
$pdf->Write(0, $_POST['linead7']);
//Segundo apellido
$pdf->SetXY(58, 105.6);
$pdf->Write(0, $_POST['linead8']);
//Nombre(s)
$pdf->SetXY(102, 105.6);
$pdf->Write(0, $_POST['linead9']);

//Parte 2
$invd = str_split(str_replace("", "", $_POST['linea18']));
for ($i = 0; $i < count($invd); $i++) {
    $pdf->SetXY(32.2 + ($i * 4.1), 115.3);
    $pdf->Write(0, $invd[$i]);
}

//Aportacion
if (isset($_POST['aportacion2'])) {
    $pdf->SetXY(45.1, 123.7);
    $pdf->Write(0, 'X');
}
//Inspeccion
//lugar
if (isset($_POST['lugar2'])) {
    $pdf->SetXY(45.2, 134);
    $pdf->Write(0, 'X');
}
//Persona
if (isset($_POST['pers2'])) {
    $pdf->SetXY(73.2, 134);
    $pdf->Write(0, 'X');
}
//Vehiculo
if (isset($_POST['vehic2'])) {
    $pdf->SetXY(101.3, 134);
    $pdf->Write(0, 'X');
}
//¿Donde se encontro el arma?
$pdf->SetXY(150, 134);
$pdf->Write(0, $_POST['dea2']);

//Tipo de arma
//Corta
if (isset($_POST['corta2'])) {
    $pdf->SetXY(45.1, 144.5);
    $pdf->Write(0, 'X');
}
//Larga
if (isset($_POST['larga2'])) {
    $pdf->SetXY(73.2, 144.5);
    $pdf->Write(0, 'X');
}

//calibre
$pdf->SetXY(113, 139.8);
$pdf->Write(0, $_POST['calibre2']);
//color
$pdf->SetXY(170, 139.8);
$pdf->Write(0, $_POST['color2']);

//Matricula:
$matd = str_split(str_replace("", "", $_POST['matricula2']));
for ($i = 0; $i < count($matd); $i++) {
    $pdf->SetXY(28.4 + ($i * 4.1), 151);
    $pdf->Write(0, $matd[$i]);
}

//No. de serie:
$matd = str_split(str_replace("", "", $_POST['serie2']));
for ($i = 0; $i < count($matd); $i++) {
    $pdf->SetXY(109.2 + ($i * 4.1), 151);
    $pdf->Write(0, $matd[$i]);
}


//Obseervaciones
$posicion = 159;
$narrd = explode("\n", $_POST['obs2'], 85);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 85);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 2;
    }
}


//Destino
$posicion = 167.2;
$narrd = explode("\n", $_POST['dest2']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 75);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(40, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (4);
    }
}


//Anote el nombre y firma de la persona a la que se le aseguro el arma
//Primer apellido
$pdf->SetXY(15, 182.3);
$pdf->Write(0, $_POST['linead10']);
//Segundo apellido
$pdf->SetXY(58, 182.3);
$pdf->Write(0, $_POST['linead11']);
//Nombre(s)
$pdf->SetXY(102, 182.3);
$pdf->Write(0, $_POST['linead12']);

//En caso que la persna a la que se le aseguro el arma no accede a firmar, anote nombre y firma de dos testigos
//Primer apellido
$pdf->SetXY(15, 195);
$pdf->Write(0, $_POST['linead13']);
//Segundo apellido
$pdf->SetXY(58, 195);
$pdf->Write(0, $_POST['linead14']);
//Nombre(s)
$pdf->SetXY(102, 195);
$pdf->Write(0, $_POST['linead15']);

//testigo 2
//Primer apellido
$pdf->SetXY(15, 202.9);
$pdf->Write(0, $_POST['linead16']);
//Segundo apellido
$pdf->SetXY(58, 202.9);
$pdf->Write(0, $_POST['linead17']);
//Nombre(s)
$pdf->SetXY(102, 202.9);
$pdf->Write(0, $_POST['linead18']);

//Apartado D.2 Datos del primer respondiente que realizo la recoleccion y/o aseguramiento de la o las armas, solo si es diferente a quien firmo la puesta a disposicion
//Primer apellido
$pdf->SetXY(15, 220);
$pdf->Write(0, $_POST['linead19']);
//Segundo apellido
$pdf->SetXY(80, 220);
$pdf->Write(0, $_POST['linead20']);
//Nombre(s)
$pdf->SetXY(140, 220);
$pdf->Write(0, $_POST['linead21']);

//Primer apellido
$pdf->SetXY(34, 229);
$pdf->Write(0, $_POST['linead22']);
//Segundo apellido
$pdf->SetXY(99, 229);
$pdf->Write(0, $_POST['linead23']);

//Apartado D.3 Registro de objetos recoolectados y/o aseguraods relacionados con el hecho probablemente delictivo
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(11);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoD'])) {
    $pdf->line(0, 0, 300, 400);
}

//Inventario de armas y objetos
$invd = str_split(str_replace("", "", $_POST['linea18']));
for ($i = 0; $i < count($invd); $i++) {
    $pdf->SetXY(20.5 + ($i * 4.1), 24.5);
    $pdf->Write(0, $invd[$i]);
}

//D.3 Registro de objetos recolectados y/o asegurados relacionados con el echo probablemente delictivo
//¿Que encontro? (apariencia de):
//Narcotico
if (isset($_POST['narcotico'])) {
    $pdf->SetXY(28.5, 32.8);
    $pdf->Write(0, 'X');
}

//Hidrocarburo
if (isset($_POST['hidrocarburo'])) {
    $pdf->SetXY(65.5, 32.8);
    $pdf->Write(0, 'X');
}

//Numerario
if (isset($_POST['numerario'])) {
    $pdf->SetXY(101.5, 32.8);
    $pdf->Write(0, 'X');
}

//Otro
$pdf->SetXY(126, 32.8);
$pdf->Write(0, $_POST['otro']);

//Aportacion
if (isset($_POST['aportaciond3'])) {
    $pdf->SetXY(45, 41.5);
    $pdf->Write(0, 'X');
}
//Inspeccion
//lugar
if (isset($_POST['lugard3'])) {
    $pdf->SetXY(45, 52.5);
    $pdf->Write(0, 'X');
}
//Persona
if (isset($_POST['persd3'])) {
    $pdf->SetXY(73.2, 52.5);
    $pdf->Write(0, 'X');
}
//Vehiculo
if (isset($_POST['vehicd3'])) {
    $pdf->SetXY(101.3, 52.5);
    $pdf->Write(0, 'X');
}
//¿Donde se encontro el objeto?
$pdf->SetXY(152, 52.5);
$pdf->Write(0, $_POST['dead3']);

//Breve descripcion del objeto
$posicion = 60;
$narrd = explode("\n", $_POST['bdo1'], 49);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 49);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 3.5;
    }
}





$posicion = 60;
$narrd = explode("\n", $_POST['dd']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 39);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(124, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (4.3);
    }
}
/*
$narrd = str_split($_POST['dd'], 49);
for ($i = 0; $i < count($narrd); $i++) {
    $pdf->SetXY(124, 60 + ($i * 4.2));
    $pdf->Write(0, $narrd[$i]);
}*/

//Anote el nombre y firma de la persona a la que se le aseguró el objeto:
//Primer apellido
$pdf->SetXY(20, 81);
$pdf->Write(0, $_POST['linead24']);

//Segundo apellido
$pdf->SetXY(62, 81);
$pdf->Write(0, $_POST['linead25']);

//Nombres
$pdf->SetXY(105, 81);
$pdf->Write(0, $_POST['linead26']);

//En caso de que la persona a la que se le aseguró el objeto no acceda a firmar, anote nombre y firma de dos testigos:
//Primer apellido
$pdf->SetXY(20, 94);
$pdf->Write(0, $_POST['linead27']);

//Segundo apellido
$pdf->SetXY(62, 94);
$pdf->Write(0, $_POST['linead28']);

//Nombres
$pdf->SetXY(105, 94);
$pdf->Write(0, $_POST['linead29']);

//2
//Primer apellido
$pdf->SetXY(20, 102);
$pdf->Write(0, $_POST['linead30']);

//Segundo apellido
$pdf->SetXY(62, 102);
$pdf->Write(0, $_POST['linead31']);

//Nombres
$pdf->SetXY(105, 102);
$pdf->Write(0, $_POST['linead32']);

//Inventario de armas y objetos
$invd = str_split(str_replace("", "", $_POST['linea18']));
for ($i = 0; $i < count($invd); $i++) {
    $pdf->SetXY(20.5 + ($i * 4.1), 112);
    $pdf->Write(0, $invd[$i]);
}

//D.3 Registro de objetos recolectados y/o asegurados relacionados con el echo probablemente delictivo
//¿Que encontro? (apariencia de):
//Narcotico
if (isset($_POST['narcotico2'])) {
    $pdf->SetXY(28.5, 121);
    $pdf->Write(0, 'X');
}

//Hidrocarburo
if (isset($_POST['hidrocarburo2'])) {
    $pdf->SetXY(65.5, 121);
    $pdf->Write(0, 'X');
}

//Numerario
if (isset($_POST['numerario2'])) {
    $pdf->SetXY(101.5, 121);
    $pdf->Write(0, 'X');
}

//Otro
$pdf->SetXY(126, 121);
$pdf->Write(0, $_POST['otro2']);

//Aportacion
if (isset($_POST['aportaciond32'])) {
    $pdf->SetXY(45, 129.5);
    $pdf->Write(0, 'X');
}
//Inspeccion
//lugar
if (isset($_POST['lugard32'])) {
    $pdf->SetXY(45, 142);
    $pdf->Write(0, 'X');
}
//Persona
if (isset($_POST['persd32'])) {
    $pdf->SetXY(73.2, 142);
    $pdf->Write(0, 'X');
}
//Vehiculo
if (isset($_POST['vehicd32'])) {
    $pdf->SetXY(101.3, 142);
    $pdf->Write(0, 'X');
}
//¿Donde se encontro el objeto?
$pdf->SetXY(152, 142);
$pdf->Write(0, $_POST['dead32']);

////Breve descripcion del objeto 2
$posicion = 149;
$narrd = explode("\n", $_POST['bdo2'], 49);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 55);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 3.5;
    }
}

//Destino que se le dio
$posicion = 150;
$narrd = explode("\n", $_POST['dd2']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 39);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(124, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (3);
    }
}


//Anote el nombre y firma de la persona a la que se le aseguró el objeto:
//Primer apellido
$pdf->SetXY(20, 168);
$pdf->Write(0, $_POST['linead38']);

//Segundo apellido
$pdf->SetXY(62, 168);
$pdf->Write(0, $_POST['linead39']);

//Nombres
$pdf->SetXY(105, 168);
$pdf->Write(0, $_POST['linead40']);

//En caso de que la persona a la que se le aseguró el objeto no acceda a firmar, anote nombre y firma de dos testigos:
//Primer apellido
$pdf->SetXY(20, 181);
$pdf->Write(0, $_POST['linead41']);

//Segundo apellido
$pdf->SetXY(62, 181);
$pdf->Write(0, $_POST['linead42']);

//Nombres
$pdf->SetXY(105, 181);
$pdf->Write(0, $_POST['linead43']);

//2
//Primer apellido
$pdf->SetXY(20, 189);
$pdf->Write(0, $_POST['linead44']);

//Segundo apellido
$pdf->SetXY(62, 189);
$pdf->Write(0, $_POST['linead45']);

//Nombres
$pdf->SetXY(105, 189);
$pdf->Write(0, $_POST['linead46']);

//Apartado D.4 Datos del primer respondiente que realizó la recolección y/o aseguramiento del o los objetos, sólo si es diferente a quien firmó la puesta a disposición
//Primer apellido
$pdf->SetXY(25, 205.8);
$pdf->Write(0, $_POST['linead33']);
//Segundo apellido
$pdf->SetXY(90, 205.8);
$pdf->Write(0, $_POST['linead34']);
//Nombre(s)
$pdf->SetXY(150, 205.8);
$pdf->Write(0, $_POST['linead35']);
//Adscripcion   
$pdf->SetXY(35, 215);
$pdf->Write(0, $_POST['linead36']);
//Cargo/Grado
$pdf->SetXY(98, 215);
$pdf->Write(0, $_POST['linead37']);

//ANEXO E. ENTREVISTAS
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(12);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoE'])) {
    $pdf->line(0, 0, 300, 400);
}

//Persona entrevistada
$entd = str_split(str_replace("", "", $_POST['linea19']));
for ($i = 0; $i < count($entd); $i++) {
    $pdf->SetXY(45 + ($i * 4.1), 19);
    $pdf->Write(0, $entd[$i]);
}

//¿Desea reservar sus datos?
//Si
if (isset($_POST['reservarDatSi'])) {
    $pdf->SetXY(174, 19);
    $pdf->Write(0, 'X');
}
//No
if (isset($_POST['reservarDatNo'])) {
    $pdf->SetXY(190.3, 19);
    $pdf->Write(0, 'X');
}


//Fecha y hora del lugar de la entrevista
//Indique la fecha y la hora del lugar de la entrevista
//FECHA
$fechaderecha = date('d,m,Y', strtotime($_POST['lineae1']));
$fechad = str_split(str_replace(",", "", $fechaderecha));
for ($i = 0; $i < count($fechad); $i++) {
    $pdf->SetXY(25 + ($i * 4.1), 31.6);
    $pdf->Write(0, $fechad[$i]);
}
//Hora
$horad = str_split(str_replace(":", "", $_POST['lineae2']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(77 + ($i * 4.1), 31.6);
    } else {
        $pdf->SetXY(81 + ($i * 4.1), 31.6);
    }
    $pdf->Write(0, $horad[$i]);
}

//Apartado E.2 Datos generales
//Primer apellido
$pdf->SetXY(23, 44);
$pdf->Write(0, $_POST['lineae3']);

//Segundo apellido
$pdf->SetXY(79, 44);
$pdf->Write(0, $_POST['lineae4']);

//Nombres
$pdf->SetXY(140, 44);
$pdf->Write(0, $_POST['lineae5']);

//Indique segun corresponda
//Calidad
//Victima u ofendido
if (isset($_POST['VicOfe'])) {
    $pdf->SetXY(65.5, 55.8);
    $pdf->Write(0, 'X');
}

//Denunciante
if (isset($_POST['denunciante'])) {
    $pdf->SetXY(114, 55.8);
    $pdf->Write(0, 'X');
}

//Testigo
if (isset($_POST['testigo'])) {
    $pdf->SetXY(170, 55.8);
    $pdf->Write(0, 'X');
}

//Nacionalidad
//VMexicana
if (isset($_POST['mexicanaE'])) {
    $pdf->SetXY(65.5, 61.5);
    $pdf->Write(0, 'X');
}

//Denunciante
if (isset($_POST['extranjeraE'])) {
    $pdf->SetXY(114, 61.5);
    $pdf->Write(0, 'X');
}

//¿Cual?
$pdf->SetXY(135, 61);
$pdf->Write(0, $_POST['cualE']);

//Sexo
//Mujer
if (isset($_POST['mujerE'])) {
    $pdf->SetXY(40.7, 68.5);
    $pdf->Write(0, 'X');
}

//Mujer
if (isset($_POST['hombreE'])) {
    $pdf->SetXY(69.4, 68.5);
    $pdf->Write(0, 'X');
}

//FECHA
$fechaderecha = date('d,m,Y', strtotime($_POST['lineae6']));
$fechad = str_split(str_replace(",", "", $fechaderecha));
for ($i = 0; $i < count($fechad); $i++) {
    $pdf->SetXY(122 + ($i * 4.1), 68.5);
    $pdf->Write(0, $fechad[$i]);
}

//EDAD
$edadd = str_split(str_replace(",", "", $_POST['lineae7']));
for ($i = 0; $i < count($edadd); $i++) {
    $pdf->SetXY(182 + ($i * 4.1), 68.5);
    $pdf->Write(0, $edadd[$i]);
}

//¿Se identifico con algun documento?
//Credencial INE
if (isset($_POST['credINE'])) {
    $pdf->SetXY(89.3, 76.3);
    $pdf->Write(0, 'X');
}

//Licencia
if (isset($_POST['licenciaE'])) {
    $pdf->SetXY(114, 76.3);
    $pdf->Write(0, 'X');
}

//Pasaporte
if (isset($_POST['pasaporteE'])) {
    $pdf->SetXY(142, 76.3);
    $pdf->Write(0, 'X');
}

//otro
$pdf->SetXY(162, 76.3);
$pdf->Write(0, $_POST['otroE']);

//No
if (isset($_POST['noE'])) {
    $pdf->SetXY(194, 76.3);
    $pdf->Write(0, 'X');
}

//No de identificacion:
$Noidentd = str_split(str_replace(",", "", $_POST['lineae8']));
for ($i = 0; $i < count($Noidentd); $i++) {
    $pdf->SetXY(45 + ($i * 4.1), 83);
    $pdf->Write(0, $Noidentd[$i]);
}

//No de telefono
$Noteld = str_split(str_replace("-", "", $_POST['lineae9']));
for ($i = 0; $i < count($Noteld); $i++) {
    $pdf->SetXY(37 + ($i * 4.1), 88);
    $pdf->Write(0, $Noteld[$i]);
}

//Correo electronico
$pdf->SetXY(120, 88);
$pdf->Write(0, $_POST['correoE']);

//Domicilio de la persona entrevistada
//Calle/Tramo carretero
$pdf->SetXY(45, 99);
$pdf->Write(0, $_POST['lineae10']);
//No. exterior
$pdf->SetXY(32, 105);
$pdf->Write(0, $_POST['lineae11']);
//No. interior
$pdf->SetXY(105, 105);
$pdf->Write(0, $_POST['lineae12']);
//Codigo postal
$pdf->SetXY(175, 105);
$pdf->Write(0, $_POST['lineae13']);
//Colonia/Localidad
$pdf->SetXY(45, 111);
$pdf->Write(0, $_POST['lineae14']);
//Municipio/Demarcación territorial
$pdf->SetXY(45, 120);
$pdf->Write(0, $_POST['lineae15']);
//Entidad federativa
$pdf->SetXY(45, 126);
$pdf->Write(0, $_POST['lineae16']);
//Referencias
$pdf->SetXY(45, 132);
$pdf->Write(0, $_POST['lineae17']);

//Apartado E.3 Relato de la entrevista
$posicion = 147;
$narrd = explode("\n", $_POST['relatoEnt']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 95);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 6.5;
    }
}

//Inicia pagina 13
//Apartado E.4 Datos del lugar del traslado o canalizacion de la persona entrevistada
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(13);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoE'])) {
    $pdf->line(0, 0, 300, 400);
}

//Si
if (isset($_POST['trasladoSi'])) {
    $pdf->SetXY(85.5, 15.7);
    $pdf->Write(0, 'X');
}

//No
if (isset($_POST['trasladoNo'])) {
    $pdf->SetXY(114, 15.7);
    $pdf->Write(0, 'X');
}

//Fiscalia/Agencia
if (isset($_POST['lineae18'])) {
    $pdf->SetXY(85.5, 21.2);
    $pdf->Write(0, 'X');
}

//Hospital
if (isset($_POST['lineae19'])) {
    $pdf->SetXY(114, 21.2);
    $pdf->Write(0, 'X');
}

//Otra dependencia
if (isset($_POST['lineae20'])) {
    $pdf->SetXY(158, 21.2);
    $pdf->Write(0, 'X');
}

//Cual
$pdf->SetXY(25, 26);
$pdf->Write(0, $_POST['lineae80']);

//Apartado E.6 Datos del primer respondiente que realizo la entrevista, solo si es diferente a quien firmo la puesta a disposicion
//Primer apellido
$pdf->SetXY(25, 99);
$pdf->Write(0, $_POST['lineae21']);
//Segundo apellido
$pdf->SetXY(90, 99);
$pdf->Write(0, $_POST['lineae22']);
//Nombre(s)
$pdf->SetXY(150, 99);
$pdf->Write(0, $_POST['lineae23']);
//Adscripcion   
$pdf->SetXY(35, 107.5);
$pdf->Write(0, $_POST['lineae24']);
//Cargo/Grado
$pdf->SetXY(98, 107.5);
$pdf->Write(0, $_POST['lineae25']);


//ANEXO F ENTREGA - RECEPCION DEL LUGAR DE LA INTERVENCION
$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(14);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoF'])) {
    $pdf->line(0, 0, 300, 400);
}

$posicion = 28;
$narrd = explode("\n", $_POST['accionesReaF']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 100);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(12, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (7);
    }
}


/*
$narrd = str_split($_POST['accionesReaF'], 120);
for ($i = 0; $i < count($narrd); $i++) {
    $pdf->SetXY(13, 28 + ($i * 7));
    $pdf->Write(0, $narrd[$i]);
}*/

//Solicito apoyo de alguna autoridad o servicios especializados en el lugar de la intervencion
//Si
if (isset($_POST['apoyoAutSi'])) {
    $pdf->SetXY(166, 50.5);
    $pdf->Write(0, 'X');
}

//No
if (isset($_POST['apoyoAutNo'])) {
    $pdf->SetXY(194, 50.5);
    $pdf->Write(0, 'X');
}

//Cual
$pdf->SetXY(25, 57.8);
$pdf->Write(0, $_POST['cualF']);


//Apartado F.2 Acciones realizadas despúes de la preservación
//Si
if (isset($_POST['lineafSi'])) {
    $pdf->SetXY(166, 68.5);
    $pdf->Write(0, 'X');
}
//No
if (isset($_POST['lineafNo'])) {
    $pdf->SetXY(194, 68.5);
    $pdf->Write(0, 'X');
}

//Motivo del ingreso
$posicion = 73;
$narrd = explode("\n", $_POST['lineaf1']);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 82);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(39, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + (5);
    }
}

//Datos del personal que ingreso al lugar de la intervencinon
//Primer apellido
$pdf->SetXY(25, 90);
$pdf->Write(0, $_POST['lineaf2']);

//Segundo apellido
$pdf->SetXY(88, 90);
$pdf->Write(0, $_POST['lineaf3']);

//Segundo apellido
$pdf->SetXY(148, 90);
$pdf->Write(0, $_POST['lineaf4']);

//Grado/Cargo
$pdf->SetXY(33, 100);
$pdf->Write(0, $_POST['lineaf5']);

//Institucion
$pdf->SetXY(115, 100);
$pdf->Write(0, $_POST['lineaf6']);



//Primer apellido
$pdf->SetXY(25, 109);
$pdf->Write(0, $_POST['lineaf7']);

//Segundo apellido
$pdf->SetXY(88, 109);
$pdf->Write(0, $_POST['lineaf8']);

//Segundo apellido
$pdf->SetXY(148, 109);
$pdf->Write(0, $_POST['lineaf9']);

//Grado/Cargo
$pdf->SetXY(33, 119);
$pdf->Write(0, $_POST['lineaf10']);

//Institucion
$pdf->SetXY(115, 119);
$pdf->Write(0, $_POST['lineaf11']);

//Apartado F.3 Entrega - recepcion del lugar de la intervencion
//Datos de la persona que entrega el lugar de la intervencion
//Primer apellido
$pdf->SetXY(25, 134);
$pdf->Write(0, $_POST['lineaf12']);
//Segundo apellido
$pdf->SetXY(88, 134);
$pdf->Write(0, $_POST['lineaf13']);
//Nombre(s)
$pdf->SetXY(150, 134);
$pdf->Write(0, $_POST['lineaf14']);
//Adscripcion   
$pdf->SetXY(33, 144);
$pdf->Write(0, $_POST['lineaf15']);
//Cargo/Grado
$pdf->SetXY(98, 144);
$pdf->Write(0, $_POST['lineaf16']);

//Datos de la persona que recibe el lugar de la intervencion
//Primer apellido
$pdf->SetXY(25, 155);
$pdf->Write(0, $_POST['lineaf17']);
//Segundo apellido
$pdf->SetXY(88, 155);
$pdf->Write(0, $_POST['lineaf18']);
//Nombre(s)
$pdf->SetXY(150, 155);
$pdf->Write(0, $_POST['lineaf19']);
//Adscripcion   
$pdf->SetXY(33, 165);
$pdf->Write(0, $_POST['lineaf20']);
//Cargo/Grado
$pdf->SetXY(98, 165);
$pdf->Write(0, $_POST['lineaf21']);

//Observaciones
$narrd = str_split($_POST['observacionesF3'], 120);
for ($i = 0; $i < count($narrd); $i++) {
    $pdf->SetXY(13, 175 + ($i * 6.5));
    $pdf->Write(0, $narrd[$i]);
}

//FECHA REGISTRO
$fechaderecha = date('d,m,Y', strtotime($_POST['fechaF4']));
$fechad = str_split(str_replace(",", "", $fechaderecha));
for ($i = 0; $i < count($fechad); $i++) {
    $pdf->SetXY(57 + ($i * 4.1), 229);
    $pdf->Write(0, $fechad[$i]);
}
//HORA REGISTRO F.4
$horad = str_split(str_replace(":", "", $_POST['horaF4']));
for ($i = 0; $i < count($horad); $i++) {
    if ($i < 2) {
        $pdf->SetXY(130 + ($i * 4.1), 229);
    } else {
        $pdf->SetXY(134 + ($i * 4.1), 229);
    }
    $pdf->Write(0, $horad[$i]);
}


$pdf->AddPage();
$pdf->setSourceFile('formato.pdf');
$tplIdx = $pdf->importPage(15);
$pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
if (!isset($_POST['anexoG'])) {
    $pdf->line(0, 0, 300, 400);
}

//Pagina
$pagd = str_split(str_replace("", "", $_POST['paginaG']));
for ($i = 0; $i < count($pagd); $i++) {
    if ($i < 3) {
        $pdf->SetXY(174 + ($i * 4.1), 16.5);
        $pdf->Write(0, $pagd[$i]);
    }
}

//De
$ded = str_split(str_replace("", "", $_POST['deG']));
for ($i = 0; $i < count($ded); $i++) {
    if ($i < 3) {
        $pdf->SetXY(190 + ($i * 4.1), 16.5);
        $pdf->Write(0, $ded[$i]);
    }
}

//Continuacion de la narrativa de
//Hechos
if (isset($_POST['lineag1'])) {
    $pdf->SetXY(105.5, 22);
    $pdf->Write(0, 'X');
}

//Entrevista
if (isset($_POST['lineag2'])) {
    $pdf->SetXY(134.3, 22);
    $pdf->Write(0, 'X');
}

//Continuacion de la narrativa
$posicion = 26.5;
$narrd = explode("\n", $_POST['continuacionNarrativa'], 99);
for ($i = 0; $i < count($narrd); $i++) {
    //$posicion=$posicion+7;
    $brinco = str_split($narrd[$i], 99);
    for ($j = 0; $j < count($brinco); $j++) {
        $pdf->SetXY(13, $posicion);
        $pdf->Write(0, $brinco[$j]);
        $posicion = $posicion + 7;
    }
}

//Datos del primer respondiente que realizó la narración de los hechos y/o entrevista, sólo si es diferente a quien firmó la puesta a disposición
//Primer apellido
$pdf->SetXY(25, 210);
$pdf->Write(0, $_POST['lineag3']);
//Segundo apellido
$pdf->SetXY(88, 210);
$pdf->Write(0, $_POST['lineag4']);
//Nombre(s)
$pdf->SetXY(150, 210);
$pdf->Write(0, $_POST['lineag5']);
//Adscripcion   
$pdf->SetXY(33, 219);
$pdf->Write(0, $_POST['lineag6']);
//Cargo/Grado
$pdf->SetXY(98, 219);
$pdf->Write(0, $_POST['lineag7']);




$nombre = 'IPH' . date("d.m.Y.H.i.s") . '.pdf';
$res = mysqli_query($conexion, "INSERT INTO informes (nombre) VALUES ('" . $nombre . "')");
//force the browser to download the output
$pdf->Output($nombre, 'F');
$pdf->Output($nombre, 'D');