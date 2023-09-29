<?php

use Core\App;

try {
    $db = App::resovler('Core\ResidenteDao');

    // verificar se o e-mail já está em uso
    $user = $db->findByEmail($_POST['email']);

    if ($user) {
        throw new Exception('O e-mail inserido já está cadastrado em nosso sistema.');
    }

    // iniciar operação
    $result = $db->save($_POST);

    // verificar sucesso na operação
    if (!$result) {
        throw new Exception('Algum erro interno ocorreu e não foi possível realizar a tarefa.');
    }

    // redirecionar usuário para tela de cadastro com mensagem de sucesso
    return view('residentes/create', [
        'feedback' => "Residente cadastrado com sucesso."
    ]);
} catch (Exception $e) {
    // redirecionar usuário para tela de cadastro com mensagem de erro
    return view('residentes/create', [
        'error' => $e->getMessage()
    ]);
}
