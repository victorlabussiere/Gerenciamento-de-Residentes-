<?php

use Http\Form;

$form = new Form();

$form
    ->addInput('email', 'E-mail', 'Digite seu e-mail')
    ->addInput('senha', 'Senha', 'Digite seu senha', '', 'password');

require base_path('views/partials/head.php');
require base_path('views/partials/menus.php');
?>

<main>
    <section class='flex flex-col items-center pt-24 h-full py-6 gap-5 bg-white shadow-md z-20 w-full px-80'>
        <header class='flex flex-col gap-3 items-start w-4/6'>
            <h1 class='text-4xl font-semibold text-orange-400'>Educação Continuada</h1>
            <div class='w-full flex justify-between items-baseline'>
                <p class='text-gray-400'>Entre com seu e-mail e senha para ter acesso ao sistema.</p>
                <?php if ($error ?? false) : ?>
                    <span class='text-red-500 text-xs font-semibold'><?= $error ?></span>
                <?php endif ?>
            </div>
        </header>
        <?php $form->renderForm('/auth', 'post', 'Entrar'); ?>
    </section>
</main>


<?php require base_path('views/partials/footer.php') ?>