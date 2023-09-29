<?php

namespace Core\Usuario;

use Core\Database;
use Exception;
use Core\Usuario\Usuario;

class UsuarioDao extends Database
{
    protected string $table = 'educausuario';
    public function __construct($config)
    {
        parent::__construct($config['config']['database'], $config['username'] ?? 'root', $config['password'] ?? '');
    }

    public function save(Usuario $data)
    {
        $sql = "INSERT INTO {$this->table}(
            nome,
            email,
            senha,
            permissao
            ) VALUES (
            :nome,
            :email,
            :senha,
            :permissao
            )";

        $result = $this->query($sql, [
            'nome' => $data->getNome(),
            'email' => $data->getEmail(),
            'senha' => $data->getSenha(),
            'permissao' => $data->getPermissao()
        ]);

        if (!$result) return false;

        return $result;
    }





    public function update(Usuario $data, int $id)
    {
        $sql = "UPDATE {$this->table} SET
            nome = :nome,
            email = :email,
            permissao = :permissao,
            WHERE id = :id
        ";

        $result = $this->query($sql, [
            'nome' => $data->getNome(),
            'email' => $data->getEmail(),
            'permissao' => $data->getPermissao(),
            'id' => $data->getId()
        ]);

        if (!$result) {
            throw new Exception("Não foi possível realizar a operação.");
        }

        return $result;
    }
}
