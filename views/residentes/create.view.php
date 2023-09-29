<?php
require base_path('views/partials/head.php');
require base_path('views/partials/menus.php');

use Http\Form;

$form = new Form();
$form
    ->addInput('nome', 'Nome', 'Digite o nome do residente')
    ->addInput('cpf', 'CPF', "Digite o CPF do residente")
    ->addInput('email', 'E-mail', 'Digite o e-mail do residente')
    ->addInput('setor', 'Setor', 'Digite o setor do residente')
    ->addInput('matricula', 'Matrícula', 'Insira a matrícula do residente')
?>

<main>
    <section>
        <header class=' flex flex-col gap-5 items-start justify-between w-4/6'>
            <h1 class='text-orange-400 text-4xl font-semibold'>Cadastro de Residente</h1>
            <div class="w-full flex items-baseline justify-between">
                <p class='text-gray-400'>Preencha os campos para prosseguir com o cadastro</p>

                <span class='text-green-600 text-sm font-semibold'><?= $feedback ?? false ?> </span>
                <span class='text-red-500 text-sm font-semibold'><?= $error ?? false ?> </span>
            </div>
        </header>

        <?php $form->renderForm('/residentes/cadastro', 'post', 'Cadastrar Residente')
        ?>
    </section>
</main>
<?php require base_path('views/partials/footer.php') ?>