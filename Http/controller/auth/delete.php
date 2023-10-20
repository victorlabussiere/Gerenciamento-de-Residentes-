<?php
$_SESSION['auth'] = false;
// Obtém os parâmetros de configuração do cookie de sessão
$session_cookie_params = session_get_cookie_params();

// Define o cookie de sessão com um tempo de expiração no passado para excluí-lo
setcookie(
    session_name(),
    '',
    time() - 1,
    $session_cookie_params['path'],
    $session_cookie_params['domain'],
    $session_cookie_params['secure'],
    $session_cookie_params['httponly']
);

// Destrói a sessão
session_destroy();

header('location: /');
