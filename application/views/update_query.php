<?php

set_time_limit(0);
$mysql = new mysqli();

$mysql->connect("23.253.143.50", 'usr_desarrollo', 'secret0m4xim0', 'db_datamart');

if ($mysql->connect_errno) {
    die('Error: ' . $mysql->connect_errno . ': ' . $mysql->connect_error);
}

$semanaAnterior = time() - (7 * 24 * 60 * 60);

$desde = date('Y-m-d', $semanaAnterior);
$hasta = date('Y-m-d');

//Especificar ruta donde estan los archivos .sql de las herramientas
$ruta = "C:/Users/ctapia/Desktop/uso_herramientas/querys/";

$peridos = [
    '1' => ['01', '02', '03', '04'],
    '2' => ['05', '06', '07', '08'],
    '3' => ['09', '10', '11', '12'],
];

foreach ($peridos as $k => $v) {
    foreach ($v as $value) {
        if ($value == date('m')) {
            $electivo = date('y') . $k;
            break 2;
        }
    }
}

/*$desde = '2015-05-04';
$hasta = '2015-08-19';
$electivo = '152';*/

$programa = [
    'A' => 'PREGRADO',
    'B' => 'PPE',
    'C' => 'PET'
];

$herramienta = [
    'agenda',
    'anuncios',
    'chat',
    'compartir_documentos',
    'encuesta',
    'enlaces',
    'evaluaciones',
    'form_evalu',
    'foros',
    'grupos',
    'mis_clases',
    'nro_documentos',
    'programacion_didactica',
    'tareas'
];

$sql_semana = $mysql->query("select max(semana) as semana from n_contenido_general;");
$query_Semana = $sql_semana->fetch_assoc();

$semanaActual = $query_Semana['semana'];

$respuesta = "";

foreach ($programa as $key => $val) {
    for ($i = 0; $i < count($herramienta); $i++) {
        $archivo = file_get_contents($ruta . $herramienta[$i] . ".sql");
        $archivo = str_replace("@fecha_inicio", "'" . $desde . "'", $archivo);
        $archivo = str_replace('@fecha_fin', "'" . $hasta . "'", $archivo);
        $archivo = str_replace("{periodo}", "'" . $key . $electivo . $val . "'", $archivo);

        $sql_update = "update n_contenido_general g set g." . $herramienta[$i] . " = (";
        $sql_update .= $archivo . ") where g.categoria = '" . $key . $electivo . $val . "' and g.semana = '" . $semanaActual . "'";

        if ($mysql->query($sql_update)) {
            $respuesta .= "Actualizado: " . $herramienta[$i] . PHP_EOL;
        } else {
            $respuesta .= $herramienta[$i] . 'no pudo ser actualizado: ' . $mysql->error . PHP_EOL;
        }
        sleep(10);
    }
}
$mysql->close();
echo $respuesta;
?>