<?php

use Http\Form;

if ($user['estado_atividade'] == '0') {
    $options = [
        ['value' => 0, 'text' => 'Inativo'],
        ['value' => 1, 'text' => 'Ativo']
    ];
} else {
    $options = [
        ['value' => 1, 'text' => 'Ativo'],
        ['value' => 0, 'text' => 'Inativo']
    ];
}

$form = new Form();

$form
    ->setMethod('put')
    ->addInput('id', '', '', $user['id'], 'hidden')
    ->addInput('nome', 'Nome', 'Insira o nome do residente', $user['nome'])
    ->addInput('cpf', 'CPF', 'Insira o cpf do residente', $user['cpf'])
    ->addInput('email', 'E-mail', 'Insira o e-mail do residente', $user['email'])
    ->addSelect('estado_atividade', 'residenteEstado', $options)
    ->addInput('matricula', 'Matrícula', 'Insira a matrícula do residente', $user['matricula'])
    ->addInput('setor', 'Setor', 'Insira o setor do residente', $user['setor']);

require base_path('views/partials/head.php');
require base_path('views/partials/menus.php');
?>
<main>
    <section>
        <hedaer class="flex flex-col gap-5 w-4/6">
            <h2 class='text-4xl text-orange-400  font-semibold'>Atualizar Informações</h2>
            <div class="w-full flex items-baseline justify-between">
                <p class='block text-gray-400'> Utilize os campos abaixo para atualizar informações de um residente. </p>
                <span class='text-red-700 text-sm font-semibold'><?= $error ?? false ?> </span>
                <span class='text-green-600 text-sm'><?= $_SESSION['edit_message'] ?? false ?> </span>
            </div>
        </hedaer>

        <!-- INICIO DOS CAMPOS EDITÁVEIS -->
        <?php $form->renderForm('/residentes/editar', 'post', 'Atualizar Informações'); ?> <!-- FIM DOS CAMPOS EDITÁVEIS -->
    </section>

</main>

<?php require base_path('views/partials/footer.php') ?>