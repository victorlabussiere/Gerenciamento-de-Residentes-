<?php

namespace Core\Residente;

use Core\Database;
use Exception;

class ResidenteDao extends Database
{
    protected string $table = 'usuario';
    public function __construct($config)
    {
        parent::__construct($config['config']['database'], $config['username'] ?? 'root', $config['password'] ?? '');
    }

    // create
    public function save($data)
    {
        $sql = "INSERT INTO {$this->table} (
            nome,
            email,
            setor,
            matricula,
            estado_atividade,
            cpf,
            senha)
            VALUES (
                :nome,
                :email,
                :setor,
                :matricula,
                :estado_atividade,
                :cpf,
                :senha
            )";

        $result = $this->query(
            $sql,
            [
                'nome' => trim($data['nome']),
                'email' => trim($data['email']),
                'setor' => trim($data['setor']),
                'matricula' => trim($data['matricula']),
                'estado_atividade' => '1',
                'cpf' => trim($data['cpf']),
                'senha' => 'mudar123',
            ]
        );

        if (!$result) {
            throw new Exception("Não foi possível realizar a operação.");
        }
    }

    // update
    public function update($data, int $id)
    {
        $sql = "UPDATE {$this->table} SET 
            id = :id, 
            nome = :nome, 
            email = :email, 
            setor = :setor, 
            matricula = :matricula,
            estado_atividade = :estado_atividade, 
            cpf = :cpf        
        WHERE id = :id";

        $result = $this->query(
            $sql,
            [
                'id' => $id,
                'nome' => trim($data->getNome()),
                'email' => trim($data->getEmail()),
                'setor' => trim($data->getSetor()),
                'matricula' => trim($data->getMatricula()),
                'estado_atividade' => $data->getStatus(),
                'cpf' => trim($data->getCpf()),
            ]
        );

        if (!$result) {
            throw new Exception("Não foi possível realizar a operação.");
        }

        return $result;
    }

    public function findByStateFilter(int $filter): array
    {
        $query = "select * from {$this->table} where estado_atividade = :estadoAtividade order by nome";

        $result = $this->query($query, [
            'estadoAtividade' => $filter
        ])->statement->fetchAll();

        return $result;
    }
}
