<?php

namespace Core\Middleware;

class Auth
{
    public static function handle()
    {
        // caso não haja autorização, o usuário é redirecionado para homepage
        if (!$_SESSION['auth']) {
            abort(403);
        }
    }

    /**
     * @param number $key -> nível de permissão exigida
     */
    public static function pass($key)
    {
        // verifica se a permissão da sessão atual é maior que a exigida
        if ($_SESSION['auth']['perm'] >= $key) {
            // caso o nível de permissão seja maior, o usuário é direcionado para uma tela 403
            abort(403);
        }
    }
}
