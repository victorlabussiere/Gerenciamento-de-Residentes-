<?php

namespace Core\Residente;

use Core\Usuario\Usuario;

class Residente extends Usuario
{
    protected int $id;
    protected string $nome;
    protected string $email;
    protected string $setor;
    protected string $matricula;
    protected int $estado_atividade;
    protected string $cpf;

    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->nome = $data['nome'];
        $this->email = $data['email'];
        $this->setor = $data['setor'];
        $this->matricula = $data['matricula'];
        $this->estado_atividade = $data['estado_atividade'];
        $this->cpf = $data['cpf'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getSetor()
    {
        return $this->setor;
    }
    public function getMatricula()
    {
        return $this->matricula;
    }
    public function getStatus()
    {
        return $this->estado_atividade;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
}
