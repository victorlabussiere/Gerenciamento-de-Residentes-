<?php

use Core\App;
use Core\Usuario\Usuario;

try {
    // verificar se o e-mail solicitado já está sendo usado
    $db = App::resovler('Core\UsuarioDao');
    $user = $db->findByEmail($_POST['email']);

    if ($user) {
        // caso estaja, criar exceção
        throw new Exception('Este e-mail já foi cadastrado por outro usuário');
    }

    // encriptografar senha antes de criar objeto do tipo user
    $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // criar objeto do tipo usuario com senha encriptografada
    $user = new Usuario($_POST);

    // salvar usuário no banco de dados
    $db->save($user);

    // direcionar usuário para homepage, com autorizações
    return view('usuarios/create', [
        'feedback' => "Usuário cadastrado com sucesso."
    ]);
} catch (Exception $e) {
    return view('usuarios/create', [
        'error' => $e->getMessage()
    ]);
}
