<?php

use Core\App;
use Core\Usuario\Usuario;

try {
    $db = App::resovler('Core\UsuarioDao');

    $user = $db->findByEmail($_POST['email']);

    if (!$user) {
        throw new Exception('Usuário não encontrado');
    }

    if (!password_verify($_POST['senha'], $user['senha'])) {
        throw new Exception('Verifique seu E-email ou Senha');
    }

    $user = new Usuario($user);

    $_SESSION['auth'] = [
        "perm" => intval($user->getPermissao()),
        "nome" => formatarNome($user->getNome()),
        "email" => $user->getEmail()
    ];

    header('location: /');
    exit();
} catch (Exception $e) {
    return view('auth/login', [
        'error' => $e->getMessage()
    ]);
}
