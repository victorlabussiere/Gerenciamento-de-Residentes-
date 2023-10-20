<?php

use Http\Form;

$form = new Form();

$form
    ->addInput('email', 'E-mail', 'Digite seu e-mail')
    ->addInput('senha', 'Senha', 'Digite seu senha', '', 'password');
?>

<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/menus.php') ?>

<main>
    <section class="flex flex-row items-center justify-center p-0 gap-0">
        <div class='w-1/4 h-1/4 bg-sky-700 p-10 rounded'>
            <h2 class='text-white font-semibold text-3xl mb-3'>Bem vindo!</h2>
            <p class='text-white'>Faça o login para continuar</p>
        </div>
        <div class='w-1/4 h-1/4'>
            <?php if (isset($_SESSION['auth']) == false) : ?>
                <?php $form->renderForm('/auth', 'post', 'Entrar'); ?>
            <?php endif ?>
        </div>
    </section>
</main>
<?php require base_path('views/partials/footer.php') ?>