<?php

use Core\App;
use Core\Router;

/**
 * Método responsável por abreviar a adição de rotas no sistema.
 * 
 * Este método realiza o pareamento de chave com a callback e deve
 * ser invocado no arquivo raiz do projeto através do método resolve
 */
App::bind('Core\Router', function () {
    /**
     * A chave 'Core\Router' fará relação com a instanciação da 
     * classe Router e a adição de roteamento dinâmico para o 
     * projeto pareando rotas chamadas pelo usuários e os arquivos
     * desejados no sistema.
     */
    $router = new Router();

    $router->get('/', 'home.php');

    // RESIDENTES
    $router->get('/residentes', 'residentes/index.php')->only('auth');

    $router->get('/residentes/cadastro', 'residentes/cadastrar/create.php')->only('auth')->passport('chefe_setor');
    $router->post('/residentes/cadastro', 'residentes/cadastrar/store.php')->only('auth')->passport('chefe_setor');

    $router->get('/residentes/editar', 'residentes/editar/index.php')->only('auth')->passport('assistente_setor');
    $router->put('/residentes/editar', 'residentes/editar/update.php')->only('auth')->passport('assistente_setor');

    // USUÁRIOS
    $router->get('/usuario', 'usuarios/index.php');
    $router->get('/usuario/editar', 'usuarios/editar/index.php');
    $router->put('/usuario/editar', 'usuarios/editar/update.php');

    $router->get('/usuarios', 'usuarios/index.php');
    $router->get('/usuarios/cadastro', 'usuarios/create/create.php')->only('auth')->passport('chefe_setor');
    $router->post('/usuarios/cadastro', 'usuarios/create/store.php')->only('auth')->passport('chefe_setor');

    // AUTHENTICATIONS
    $router->get('/auth', 'auth/index.php')->only('guest');
    $router->post('/auth', 'auth/create.php')->only('guest');
    $router->delete('/auth', 'auth/delete.php')->only('auth');

    // API
    $router->get('/api/residentes', 'api/residentes/index.php');
    $router->get('/api/usuarios', 'api/usuarios/index.php');

    return $router;
});
