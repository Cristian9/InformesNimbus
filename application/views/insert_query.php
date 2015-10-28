<?php

set_time_limit(0);
$mysql = new mysqli();

$mysql->connect("23.253.143.50", 'usr_desarrollo', 'secret0m4xim0', 'db_datamart');

if ($mysql->connect_errno) {
    die('Error: ' . $mysql->connect_errno . ': ' . $mysql->connect_error);
}

$programa = [
    'A' => 'PREGRADO',
    'B' => 'PPE',
    'C' => 'PET'
   ];

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

//$electivo = '152';

$sql_semana = $mysql->query("select if(max(semana) is null, 1, max(semana + 1)) as semana from n_contenido_general");
$query_Semana = $sql_semana->fetch_assoc();

$semanaActual = $query_Semana['semana'];

foreach ($programa as $key => $val) {
    $sql_insert = "insert into n_contenido_general (categoria, semana, facultad, "
            . "escuela, num_usuarios, cod_seccion, cod_curso, turno, curso, "
            . "cod_docente, apellidos, nombres) select cc.code as categoria,  "
            . $semanaActual . ", SUBSTRING(s.name,5,2) as Facultad,SUBSTRING(s.name,7,2) as Escuela ,"
            . "s.nbr_users num_usuarios,s.name as cod_seccion, c.code as cod_curso,"
            . "SUBSTRING(s.name,13,1) as turno, c.title curso,u.username cod_docente, "
            . "u.lastname apellidos, u.firstname nombres from (course_category cc,session "
            . "s,course c,user u,session_rel_course_rel_user srsru) where cc.code=c.category_code "
            . "and srsru.id_session=s.id and srsru.course_code=c.code and srsru.id_user=u.user_id "
            . "and u.status=1 and cc.code in ('" . $key . $electivo . $val . "') group by s.name, u.username "
            . "order by s.name, u.username limit 70000";
    if($mysql->query($sql_insert)){
        $respuesta = "Registros insertados" . PHP_EOL;
    }else{
        $respuesta = $mysql->error . PHP_EOL;
    }
}

$mysql->close();

echo $respuesta;

?>