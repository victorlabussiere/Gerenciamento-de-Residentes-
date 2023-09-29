<?php

namespace Core;

use Core\Middleware\Middleware;
use Core\Middleware\Passport;

class Router
{
    /**
     * @property array $routes -> Responsável por armazenar URI, Método e Arquivo / Controller
     */
    protected $routes = [];

    static function abort($code = 404)
    {
        http_response_code($code);
        view($code);

        die();
    }

    /**
     * Método responsável por armazenar as relações de rotas
     * @param string $uri          -> URI acessada pelo cliente 
     * @param string $controller   -> Arquivo relacionado ao URI acessado
     * @param string $method       -> Método de requisição para definição de arquivos
     */
    protected function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null,
            'passport' => null
        ];

        return $this;
    }

    /**
     * Método responsável por adicionar uma rota com o método GET na lista de rotas
     * @param string $uri          -> Caminho que será ouvido pelo servidor disponível para acesso
     * @param string $controller   -> Arquivo que será enviado pelo servidor como resposta à requisição
     */
    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }

    /**
     * Método responsável por adicionar uma rota com o método POST na lista de rotas
     */
    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }

    /**
     * Método responsável por adicionar uma rota com o método PUT na lista de rotas
     */
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, 'PUT');
    }

    /**
     * Método responsável por adicionar uma rota com o método PATCH na lista de rotas
     */
    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    /**
     * Método responsável por adicionar uma rota com o método DELETE na lista de rotas
     */
    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'delete');
    }

    /**
     * O método only define um valor de middleware para a rota após ser adicionada
     * @param string | null $key -> valor do middleware
     */
    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    /**
     * o método passport define um valor de permissão para a rota após ser adicionada
     * @param string | null $key -> valor da permissão
     */
    public function passport($key)
    {
        $this->routes[array_key_last($this->routes)]['passport'] = $key;
        return $this;
    }

    /**
     * Método responsável pelo controle de rotas acessadas pelo client
     * @param string $uri          -> URI enviada pelo client
     * @param string $method       -> Método enviado pelo clietn
     * 
     * Caso a URI acessada pelo cliente exista na lista de Rotas do servidor, 
     * ele receberá o arquivo controller relacionado;
     */
    public function routeTo(string $uri, string $method)
    {
        foreach ($this->routes as $route) {
            // verifica a existência de rota pela URI enviada e se existe um método equivalente
            if ($route['uri'] === $uri && strtoupper($route['method']) === strtoupper($method)) {
                Middleware::resolve($route['middleware']);          // verifica a autorização para proteção de rota
                Passport::resolve($route['passport']);            // verifica o nível de acesso para proteção de rota

                return require base_path('Http/controller/' . $route['controller']);     // retorna o controlador da rota indicada
            }
        }
        // não existindo rota equivalente, direciona o usuário para uma tela 404
        $this->abort();
    }
}
