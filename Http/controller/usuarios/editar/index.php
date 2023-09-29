<?php

use Core\App;
use Core\Usuario\Usuario;

try {
    $db = App::resovler('Core\UsuarioDao');
    $data = $db->findOrFail($_GET['id']);
    $usuario = new Usuario($data);

    view('usuarios/edit', [
        'usuario' => $usuario
    ]);
} catch (Exception $e) {
    view('usuarios/edit', [
        'usuario' => $usuario,
        'error' => $e->getMessage()
    ]);
}
