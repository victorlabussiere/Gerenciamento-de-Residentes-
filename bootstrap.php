<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Residente\ResidenteDao;
use Core\Usuario\UsuarioDao;

$container = new Container();

App::setContainer($container);
App::bind('Core\Database', function () {
    $config = require base_path('config.php');

    return new Database($config['database']);
});

App::bind('Core\ResidenteDao', function () {
    $config = ['config' => require base_path('config.php')];
    return new ResidenteDao($config);
});

App::bind('Core\UsuarioDao', function () {
    $config = ['config' => require base_path('config.php')];
    return new UsuarioDao($config);
});
