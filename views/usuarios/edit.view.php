<?php
require base_path('views/partials/head.php');
require base_path('views/partials/menus.php');

use Http\Form;

$form = new Form();

$options = [
    ['value' => 'default', 'text' => 'Selecionar'],
    ['value' => 0, 'text' => 'Direção'],
    ['value' => 1, 'text' => 'Administração'],
    ['value' => 2, 'text' => 'Assistência'],
    ['value' => 3, 'text' => 'Estágio'],
];

$form
    ->setMethod('put')
    ->setIdInput($usuario->getId())
    ->addInput('nome', 'Nome', 'Insira o nome do residente', $usuario->getNome())
    ->addInput('email', 'E-mail', 'Insira o e-mail do residente', $usuario->getEmail())
    ->addSelect('permissao', 'Cargo', $options, 'Atualizar');
?>
<main>
    <section>
        <hedaer class="flex flex-col gap-5 w-4/6">
            <h2 class='text-4xl text-orange-400  font-semibold'><?= $usuario->getNome() ?></h2>
            <div class='w-full flex items-baseline justify-between'>
                <p class='block text-gray-400'> Utilize os campos abaixo para atualizar informações de um usuário. </p>
                <span class='text-green-600 text-sm font-semibold'><?= $feedback ?? false ?> </span>
                <span class='text-red-500 text-sm font-semibold'><?= $error ?? false ?> </span>
            </div>
        </hedaer>

        <!-- INICIO DOS CAMPOS EDITÁVEIS -->
        <?php $form->renderForm('usuario/editar', 'post', 'Atualizar Informações') ?>
        <!-- FIM DOS CAMPOS EDITÁVEIS -->
    </section>
</main>

<?php require base_path('views/partials/footer.php') ?>