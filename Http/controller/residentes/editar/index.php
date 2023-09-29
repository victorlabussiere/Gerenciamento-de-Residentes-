<?php

use Core\App;
use Http\Form;

$db = App::resovler('Core\ResidenteDao');

$id = $_GET['id'];

$user = $db->findOrFail($id);

view('residentes/edit', [
    'user' => $user
]);
