<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/menus.php') ?>

<main>
    <section>
        <header class='flex gap-5 items-start justify-between w-4/6'>
            <h2 class='text-orange-400 text-4xl font-semibold w-3/5'> Todos os cadastros </h2>
            <!-- CAMPO DE PESQUISAS PERSONALIZADAS -->
            <form action="#" class='flex gap-3 items-center w-2/5'>
                <input type="text" id="input_filtro" placeholder="Digite sua pesquisa" class="w-full p-2 border">
            </form>
        </header>

        <!-- CONDIÇÃO DE DISPLAY -->
        <?php if (!$usuarios) : ?>
            <h2 class='text-sky-700 font-semibold'>Sem resultados</h2>
        <?php else : ?>
            <!-- LISTAGEM DE USUARIOS -->

            <ul class='listResidentes flex flex-col w-4/6 items-start border'>
                <span class="w-full h-fit grid grid-cols-8 text-lg place-content-between px-2 py-1 bg-sky-700 text-white">
                    <p class='col-span-3'>Nome</p>
                    <p class='col-span-2'>Matrícula </p>
                    <p class='col-span-3'>E-mail</p>
                </span>
                <?php foreach ($usuarios as $user) : ?>
                    <li value='<?= $user['id'] ?>' class="userItem col-span-3 grid grid-cols-8 w-full p-2 hover:bg-gray-200 duration-200 cursor-pointer">
                        <p class='col-span-3 w-4/6 truncate text-sky-700'><?= $user['nome'] ?></p>
                        <p class='col-span-2 w-4/6 truncate'><?= $user['matricula'] ?> </p>
                        <p class='col-span-3 w-full truncate'><?= $user['email'] ?></p>
                    </li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
    </section>

    <section class='absolute flex items-center justify-center h-screen w-screen bg-black/30 z-50 px-80 hideModal residenteInfo'>
        <div class='flex flex-col items-start w-3/5 py-6 gap-10 m-auto bg-white p-10 rounded-xl  shadow-2xl'>
            <hedaer class="flex w-full items-end justify-between">
                <i class='closeIcons cursor-pointer text-orange-400 hover:text-orange-600 material-icons'> close</i>
                <h2 class='text-orange-400 text-4xl font-semibold'>Informações</h2>
                <a href="#" class='edit flex items-end gap-2 rounded bg-sky-700 px-3 py-1 text-white duration-200 hover:bg-sky-600'>
                    <i class='material-icons'> edit</i>
                    Editar
                </a>
            </hedaer>
            <form class='informacoes flex flex-col items-center w-full h-full gap-2'>
                <label for="residenteNome" class='w-full text-sky-700'>Nome <input type="text" id='residenteNome' class='p-2 w-full text-gray-600 bg-gray-100 rounded' name="nome"></label>
                <label for="residenteCpf" class='w-full text-sky-700'>CPF<input type="text" id='residenteCpf' class='p-2 w-full text-gray-600 bg-gray-100 rounded' name="cpf"></label>
                <label for="residenteEmail" class='w-full text-sky-700'>E-mail<input type="text" id='residenteEmail' class='p-2 w-full text-gray-600 bg-gray-100 rounded' name="email"></label>
                <label for="residenteEstado" class='w-full text-sky-700'>Status<input type="text" id='residenteEstado' class='p-2 w-full text-gray-600 bg-gray-100 rounded' name="estado_atividade"></label>
                <label for="residenteMatricula" class='w-full text-sky-700'>Matrícula<input type="text" id='residenteMatricula' class='p-2 w-full text-gray-600 bg-gray-100 rounded' name="matricula"></label>
                <label for="residenteSetor" class='w-full text-sky-700'>Setor<input type="text" id='residenteSetor' class='p-2 w-full text-gray-600 bg-gray-100 rounded' name="setor"></label>
            </form>
        </div>
    </section>
</main>

<script type='module'>
    import UserModal from "/js/UserModal.js"

    const listaItems = document.querySelectorAll('ul.listResidentes>li')
    const modal = document.querySelector('section.residenteInfo')
    modal.querySelector('i.closeIcons').addEventListener('click', () => UserModal.displayModal(modal))

    // Carregar lista de residentes
    const xml = new XMLHttpRequest();

    xml.open("GET", `/api/residentes`, true);
    xml.onreadystatechange = function() {
        if (xml.readyState === 4 && xml.status === 200) {
            let response = JSON.parse(xml.responseText);

            // adicionar evento que abre o modal em cada item da lista
            listaItems.forEach(function(itemLista, i) {
                itemLista.addEventListener('click', function() {
                    let user = new UserModal(UserModal.resolve(response, this.value))

                    UserModal.resetModal(modal) // Resetar campos
                    UserModal.displayModal(modal) // Abrir modal
                    user.setModal(modal, 'residentes/editar') // Preencher modal com informações do usuário
                })
            })
        }
    };

    xml.send();
</script>

<?php require base_path('views/partials/footer.php') ?>