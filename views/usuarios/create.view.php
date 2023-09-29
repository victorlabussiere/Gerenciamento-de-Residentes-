<?php

use Http\Form;

require base_path('views/partials/head.php');
require base_path('views/partials/menus.php');

$options = [
    ['value' => 'default', 'text' => 'Selecionar'],
    ['value' => 0, 'text' => 'Direção'],
    ['value' => 1, 'text' => 'Administração'],
    ['value' => 2, 'text' => 'Assistência'],
    ['value' => 3, 'text' => 'Estágio'],
];
$form = new Form();

$form->addInput('nome', 'Nome', 'Insira o nome do Usuário')
    ->addInput('email', 'E-mail', 'Insira o e-mail do Usuário')
    ->addInput('senha', 'Senha', 'Insira a senha do Usuário', '', 'password')
    ->addSelect('permissao', 'Categoria', $options);
?>
<main>
    <section>
        <header class='flex flex-col gap-3 items-start w-4/6'>
            <h1 class='text-4xl font-semibold text-orange-400'>Cadastrar usuário</h1>
            <div class='w-full flex items-baseline justify-between'>
                <p class='text-gray-400'>Este usuário terá acesso ao sistema da Educação Continuada. Utilize esse espaço para cadastrar e definir seu acesso aos serviços do sistema.</p>
                <span class='text-red-500 text-xs font-semibold'><?= $error ?? false ?></span>
                <span class='text-green-600 text-xs font-semibold'><?= $feedback ?? false ?></span>
            </div>
        </header>

        <!-- FORMULÁRIO CONSTRUIDO COM A CLASSE Http/Form.php -->
        <?php $form->renderForm('/usuarios/cadastro', 'post', 'Cadastrar'); ?>

        <!-- feedback messages -->


        <!-- javascript validator -->
        <script type='module'>
            import FormValidator from '/js/FormValidator.js'
            const form = document.querySelector('form#formUsuario')
            FormValidator.validaForm(form, 'label>input, label>select', 'label>span')
        </script>
    </section>
</main>


<?php require base_path('views/partials/footer.php') ?>