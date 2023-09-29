<?php

use Core\App;
use Core\Residente\Residente;

try {
    $db = App::resovler('Core\ResidenteDao');
    $updateData = new Residente($_POST);

    $values = $updateData;
    $id = $updateData->getId();

    $result = $db->update($values, $id);
    if (!$result) {
        throw new Exception('Não foi possível alterar as informações.');
    }

    $_SESSION['edit_message'] = 'Residente atualizado com sucesso';
    header("location: /residentes/editar?id={$_POST['id']}");
    exit();
} catch (Exception $error) {
    return view('residentes/editar', [
        'feedback' => $error->getMessage()
    ]);
}
