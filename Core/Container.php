<?php

namespace Core;

/**
 * Essa classe é responsável por envelopar a instanciação de outras classes 
 * com o objetivo de facilitar o uso durante o desenvolvimento.
 */
class Container
{
    /**
     * @property array $bindings -> Um array de relações de chave para acesso e classe
     */
    protected $bindings = [];

    /**
     * Método responsável por criar uma relação entre chave e valor para as 
     * classes que serão envelopadas em um container
     * 
     * @param string $key      -> Valor de chamada para classe
     * @param callback $resolver -> Callback que executa as configurações necessárias 
     * para instanciar uma nova classe.
     */
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    /**
     * Método responsável por instanciar uma classe de acordo com o valor recebido
     * nos parâmetros.
     * 
     * @param string $key      -> Chave de acesso para instanciar uma classe que está
     *  envelopada pelo Container
     */
    public function resolver($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception('Não foi possível encontrar a classe ' . $key);
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}
