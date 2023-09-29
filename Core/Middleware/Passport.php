<?php

namespace Core\Middleware;

use Exception;

class Passport
{
    /**
     * Lista de permissões autorizadas pelo sistema
     * 
     * As permissões devem ser adicionadas no arquivo routes.php
     * - A chave para autorização define o nível de acesso para a rota adicionada
     * - A rota acessada sem o devído nível de acesso exigido, redireciona o usuário
     * para o arquivo views/403.view.php
     */
    const PASS = [
        'direcao' => 0,
        'chefe_setor' => 1,
        'assistente_setor' => 2,
        'estagiário' => 3
    ];

    /**
     * O método resolve é chamada para realizar a conexão do valor da autorização 
     * com o método que verifica o nível de autorização da rota.
     * 
     * @param string $key -> chave de acesso para rota
     */
    public static function resolve($key)
    {
        if (!$key || $key == null) {
            // Se nenhuma chave for definida, a rota não exige autorização para ser acessada
            return;
        }

        // A chave indicada no método permission, deve retornar um valor equivalente a permissão
        $passport = static::PASS[$key];

        if (!$passport) {
            // Caso o valor não exista, a permissão não foi registrada
            throw new Exception('Permissão não registrada');
        }

        // Caso o valor exista, o método de validação será chamado e irá comparar com o nível de permissão do usuário.
        return Auth::class::pass($passport);
    }
}
