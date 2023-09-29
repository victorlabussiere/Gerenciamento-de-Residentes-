<?php
require base_path('views/partials/head.php');
require base_path('views/partials/menus.php');

use Http\Form;

$form = new Form();
$form
    ->addInput('nome', 'Nome', '', '')
    ->addInput('email', 'E-mail', '', '')
    ->addInput('permissao', 'Cargo', '', '')
?>

<main>
    <section>
        <header class='flex flex-col gap-3 items-start w-4/6'>
            <h2 class='text-orange-400 text-4xl font-semibold w-3/5'> Usuários da Educação Continuada </h2>
            <p class='text-gray-400'>Esta é a lista de usuários cadastrados como colaboradores do setor Educação continuada.</p>
        </header>

        <!-- CONDIÇÃO DE DISPLAY -->
        <?php if (!$usuarios) : ?>
            <h2 class='text-sky-700 font-semibold'>Sem resultados</h2>
        <?php else : ?>
            <!-- LISTAGEM DE USUARIOS -->
            <ul class='listaUsuarios flex flex-col w-4/6 items-start border'>
                <span class="w-full h-fit grid grid-cols-8 text-lg place-content-between px-2 py-1 bg-sky-700 text-white">
                    <p class='col-span-3'>Nome</p>
                    <p class='col-span-2'>Permissão</p>
                    <p class='col-span-3'>E-mail</p>
                </span>
                <?php foreach ($usuarios as $user) : ?>
                    <li value='<?= $user['id'] ?>' class="userItem col-span-3 grid grid-cols-8 w-full p-2 hover:bg-gray-200 duration-200 cursor-pointer">
                        <p class='col-span-3 w-4/6 truncate text-sky-700'><?= $user['nome'] ?></p>
                        <p class='col-span-2 w-4/6 truncate'><?= $user['email'] ?> </p>
                        <p class='col-span-3 w-full truncate'><?= $user['permissao'] ?></p>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </section>

    <section class='absolute flex items-center justify-center h-screen w-screen bg-black/30 z-50 px-80 hideModal usuarioInfos'>
        <div class='flex flex-col items-start w-3/5 py-6 gap-10 m-auto bg-white p-10 rounded-xl  shadow-2xl'>
            <header class="flex w-full items-end justify-between">
                <i class='closeIcons cursor-pointer text-orange-400 hover:text-orange-600 material-icons'> close</i>
                <h2 class='text-orange-400 text-4xl font-semibold'>Informações</h2>
                <a href='#' class='edit flex items-end gap-2 rounded bg-sky-700 px-3 py-1 text-white duration-200 hover:bg-sky-600'>
                    <i class='material-icons'> edit</i>
                    Editar
                </a>
            </header>

            <div class='informacoes flex flex-col items-center w-full h-full gap-2'>
                <?php $form->renderForm('usuario/editar', 'get'); ?>
            </div>
        </div>
    </section>

    <script type='module'>
        import UserModal from '/js/UserModal.js'

        const listaItems = document.querySelectorAll('ul.listaUsuarios>li')
        const modal = document.querySelector('section.usuarioInfos')

        modal.querySelector('i.closeIcons').addEventListener('click', () => UserModal.displayModal(modal))

        // Carregar lista de residentes
        const xml = new XMLHttpRequest();

        xml.open("GET", `/api/usuarios`, true);
        xml.onreadystatechange = function() {
            if (xml.readyState === 4 && xml.status === 200) {
                let response = JSON.parse(xml.responseText);

                // adicionar evento que abre o modal em cada item da lista
                listaItems.forEach(function(itemLista, i) {
                    itemLista.addEventListener('click', function() {
                        let user = new UserModal(UserModal.resolve(response, this.value))

                        UserModal.resetModal(modal) // Resetar campos
                        UserModal.displayModal(modal) // Abrir modal
                        user.setModal(modal, 'usuario/editar') // Preencher modal com informações do usuário
                    })
                })
            }
        };

        xml.send();
    </script>
</main>

<?php require base_path('views/partials/footer.php') ?>