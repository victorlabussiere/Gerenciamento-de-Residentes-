<?php

use Core\App;

$db = App::resovler('Core\ResidenteDao');
$usuarios = $db->find(['id', 'nome', 'email', 'estado_atividade', 'matricula', 'setor']);

view('residentes/index', [
    'usuarios' => $usuarios
]);
