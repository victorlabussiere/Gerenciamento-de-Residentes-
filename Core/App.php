<?php

namespace Core;

/**
 * O objetivo da Classe APP é ser uma interface de uso para a classe Container
 * para simplificar o uso de classes e métodos envelopados em Containers.
 */
class App
{
    /**
     * @property array $container -> Conjunto de chaves e valores que armazenam 
     * containers de classes
     */
    protected static $container = [];
    /**
     * Definição de containers armazenados pelo Objeto APP
     */
    public static function setContainer($container)
    {
        static::$container = $container;
    }

    /**
     * Representação do container inserido no Objeto APP
     */
    public static function container()
    {
        return static::$container;
    }

    /**
     * Método auxiliar armazenar novas classes em um container
     * 
     * @param string $key: Chave para representar a classe
     * @param callback $resolver: Callback que executa as configurações necessárias
     * para instanciar a classe
     * 
     */
    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }

    /**
     * Método auxiliar para instanciar um novo objeto a partir de sua 
     * representação 
     * @param string $key: Chave para acessar a classe
     */
    public static function resovler($key)
    {
        return static::container()->resolver($key);
    }
}
