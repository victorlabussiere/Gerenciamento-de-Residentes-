<?php

namespace Core\Middleware;

class Middleware
{
    const MAP = [
        'auth' => Auth::class,
        'guest' => Guest::class
    ];

    public static function resolve(string | null $key)
    {
        if (!$key) {
            return;
        }

        $middleware = static::MAP[$key];

        if (!$middleware) {
            throw new \Exception('Não foi encontrado nenhum middleware equivalente a chave indicada: ' . $key);
        }

        return $middleware::handle();
    }
}
