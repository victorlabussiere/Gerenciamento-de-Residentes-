<?php

/**
 * método dum and die
 * realiza um interrompimento no sistema para debug
 * 
 * @param mixed $value -> valor a ser depurado
 */
function dd(mixed $value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    die();
}

/**
 * @param string $nomeCompleto -> nome a ser formatado
 * 
 * a função deve formatar o nome do usuário para que seja exibido no topbar
 * 
 * deve retornar apenas o primeiro e o último nome do usuário
 * a primeira letra do primeiro e último nome do usuário devem estar em caixa alta
 * 
 * @return string
 */
function formatarNome(string $nomeCompleto)
{
    $nomeCompleto = explode(" ", $nomeCompleto);
    $primeiroNome = ucfirst($nomeCompleto[0]);
    $ultimoNome = count($nomeCompleto) > 1 ? ucfirst(end($nomeCompleto)) : '';
    $nome = "{$primeiroNome} {$ultimoNome}";

    return $nome;
}
function abort(int $code = 404)
{
    http_response_code($code);
    view($code);
    die();
}
