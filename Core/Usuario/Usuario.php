<?php

namespace Core\Usuario;

class Usuario
{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $permissao;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? 0;
        $this->nome = trim($data['nome']);
        $this->email = trim($data['email']);
        $this->senha = trim($data['senha']);
        $this->permissao = $data['permissao'];
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
    public function getSenha(): string
    {
        return $this->senha;
    }
    public function getPermissao(): string
    {
        return $this->permissao;
    }
}
