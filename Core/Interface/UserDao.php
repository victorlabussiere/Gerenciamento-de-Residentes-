<?php

namespace Core\Interface;

use Core\Usuario\Usuario;

interface UserDao
{
    public function find();

    public function findByEmail(string $email);


    public function findOrFail(string $id);


    public function update(Usuario $data, int $id);
}
