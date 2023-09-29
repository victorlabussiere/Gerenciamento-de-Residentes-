<?php

use Core\App;

$db = App::resovler('Core\UsuarioDao');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$result = $db->find(['id', 'nome', 'email', 'permissao']);
$residente = json_encode($result);

echo $residente;
