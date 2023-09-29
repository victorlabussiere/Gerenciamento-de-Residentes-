<?php

use Core\App;

session_start();
// Ponteiro para raiz do projeto
const BASE_PATH = __DIR__ . "/../";

/**
 * @param string $path: arquivo desejado
 * @return string caminho para determinado arquivo
 */
function base_path($path)
{
    return BASE_PATH . "{$path}";
}

/**
 * Função responsável por renderizar um arquivo da pasta views, na 
 * raiz do projeto
 * 
 * @param string $file: local do arquivo desejado sem extenções
 * @param array $attributes: conjunto de chaves e valores que serão
 * declarados com variáveis.
 * 
 * @return void: 
 */
function view(mixed $file, array $attributes = [])
{
    extract($attributes);
    require BASE_PATH . "views/{$file}.view.php";
}

/**
 * helper para chamada de classes e namespaces
 */
spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);

    require base_path("{$class}.php");
});

/**
 * @file functions.php -> arquivo de funções úteis 
 * @file bootstrap.php -> arquivo usado para instanciar Containers
 * @file routes.php    -> arquivo responsável por fornecer as Rotas do sistema
 */
require base_path('functions.php');
require base_path('bootstrap.php');
require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

/**
 * Iniciando o aplicativo
 * 
 * @static @method resolver: instancia uma classe
 * @method routeTo: verifica a existência da URI acessada pelo
 * cliente junto ao método de requisição ao servidor
 * 
 * havendo relações com as rotas existentes no sitema, o método 
 * routeTo retornará um arquivo da pasta controller
 * 
 * @param string $uri: rota enviada ao servidor
 * @param string $method: método de requisição feito pelo client
 * ao servidor.
 */
App::resovler('Core\Router')->routeTo($uri, $method);
