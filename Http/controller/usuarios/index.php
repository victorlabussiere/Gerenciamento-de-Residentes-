<?php

use Core\App;

$db = App::resovler('Core\UsuarioDao');

$usuarios = $db->find(['nome', 'permissao', 'email', 'id']);

view('usuarios/index', [
    'usuarios' => $usuarios
]);
