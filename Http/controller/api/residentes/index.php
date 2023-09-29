<?php

use Core\App;

$db = App::resovler('Core\ResidenteDao');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$result = $db->find(['id', 'nome', 'email', 'estado_atividade', 'matricula', 'setor']);
$residente = json_encode($result);

echo $residente;
