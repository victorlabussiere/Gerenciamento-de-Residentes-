<?php

namespace Core\Middleware;

class Guest
{
    // método responsável por lidar com a permissão do usuário ao acessar as rotas
    public static function handle()
    {
        if ($_SESSION['auth'] ?? false) {
            header('location: /');
            exit();
        }
    }
}
