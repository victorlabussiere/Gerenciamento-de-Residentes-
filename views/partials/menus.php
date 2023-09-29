<?php
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
?>
<!-- TOPBAR -->
<nav class="fixed top-0 left-0 w-full flex items-center justify-between px-6 bg-sky-800 text-neutral-50 z-40">
    <header class='font-semibold text-lg flex items-center gap-3'>
        HFSE
    </header>

    <ul class='flex items-center'>
        <li class='flex items-center'><a class='px-6 py-3 duration-100 hover:bg-sky-900' href="/">Página inicial</a></li>
        <li class='flex items-center'><a class='px-6 py-3 duration-100 hover:bg-sky-900' href="/">Ramais</a></li>

        <?php if ($_SESSION['auth'] ?? false) : ?>
            <li class='flex flex-col items-start relative minhaConta'>
                <p class='px-6 py-3 duration-100 cursor-default hover:bg-sky-900'><?= $_SESSION['auth']['nome'] ?? 'Minha Conta' ?></p>

                <div id="submenu" class="w-56 shadow-md bg-white hideModal absolute top-full -right-0">
                    <a href="#" class="flex items-center px-5 py-2 justify-between w-full text-sky-700 cursor-pointer font-semibold hover:bg-gray-100">
                        <p>Minhas informações</p>
                        <i class="material-icons text-sky-700">person</i>
                    </a>

                    <!-- logout button -->
                    <form action="/auth" method='post' class='w-full'>
                        <input type="hidden" name="_method" value='delete'>
                        <button type="submit" value="Sair" class="flex items-center px-5 py-2 justify-between w-full text-sky-700 cursor-pointer font-semibold hover:bg-gray-100">
                            <p>Sair</p>
                            <i class="material-icons text-sky-700">logout</i>
                        </button>
                    </form>
                </div>
            </li>

        <?php else : ?>
            <li class='flex items-center pl-5 border-l'>
                <a href="/auth" class="text-white bg-orange-400 flex rounded px-6 py-1 w-full duration-150 cursor-pointer font-semibold hover:shadow-md">Login</a>
            </li>
        <?php endif; ?>
    </ul>

    <script>
        // Display submenu "Minha Conta"
        const minhaConta = document.querySelector('li.minhaConta')
        const submenuMinhaConta = minhaConta.querySelector('#submenu')

        // exibir submenu
        minhaConta.addEventListener('mouseenter', () => {
            submenuMinhaConta.classList.toggle('hideModal')
        })

        minhaConta.addEventListener('mouseleave', () => {
            submenuMinhaConta.classList.toggle('hideModal')
        })
    </script>
</nav>

<?php if ($_SESSION['auth'] ?? false) :  ?> <!-- CONDICIONAL DE DISPLAY: MENU LATERAL É APENAS EXIBIDO HAVENDO LOGIN -->
    <nav class="sideMenu fixed top-0 left-0 mt-10 col-span-2 h-full bg-white flex flex-col gap-4 py-4 duration-200 shadow-lg z-30 w-60">
        <!-- LISTA DE ABAS -->
        <ul class='flex flex-col w-full items-start justify-center'>

            <!-- TAB RESIDENTES  -->
            <li class='text-2xl font-semibold flex flex-col w-full justify-between items-start border-b border-gray-300 py-2 px-6'>
                <p class='submenuParent w-full flex justify-between items-center text-orange-400 cursor-pointer'>Residentes <i class="material-icons">expand_more</i></p>
                <!-- LISTA DE OPÇÕES DA TAB -->
                <ul class='submenuLinkList hideModal flex flex-col w-full items-start text-gray-500'>
                    <li class="py-2 w-full border-gray-400 hover:text-lime-600 text-sm">
                        <a href="/residentes" class='flex items-end gap-4 whitespace-nowrap'>
                            <i class='material-icons'>search</i>
                            <p class='whitespace-nowrap'>Consultar</p>
                        </a>
                    </li>

                    <?php if ($_SESSION['auth']['perm'] >= 1) : ?>
                        <li class='flex items-end gap-4 py-2 text-gray-300 text-sm whitespace-nowrap cursor-default'>
                            <i class='material-icons'>person_add</i>
                            <p class='whitespace-nowrap'>Cadastrar</p>
                        </li>
                    <?php else : ?>
                        <li class="<?= $uri === '/residentes/cadastro' ? 'text-sky-700' : '' ?> py-2 border-gray-400 hover:text-sky-700 text-sm">
                            <a href="/residentes/cadastro" class='flex items-end gap-4 whitespace-nowrap'>
                                <i class='material-icons'>person_add</i>
                                <p class='whitespace-nowrap'>Cadastrar</p>
                            </a>
                        </li>

                    <?php endif ?>
                </ul>
            </li>

            <!-- TAB SERVIÇOS -->
            <li class='text-2xl font-semibold flex flex-col w-full justify-between items-start border-b border-gray-300 py-2 px-6'>
                <p class='submenuParent w-full flex justify-between items-center text-orange-400 cursor-pointer'>Mais Serviços <i class="material-icons">expand_more</i></p>
                <ul class='submenuLinkList hideModal flex flex-col w-full items-start text-gray-500'>

                    <li class="<?= $uri === '/usuarios' ? 'text-sky-700' : '' ?> py-2 w-fit border-gray-400 hover:text-green-700 text-sm">
                        <a href="/usuarios" class='flex gap-4 items-end whitespace-nowrap'>
                            <i class='material-icons'>groups</i>
                            Usuários
                        </a>
                    </li>
                    <?php if ($_SESSION['auth']['perm'] === 0) : ?>
                        <li class="<?= $uri === '/usuarios/cadastro' ? 'text-sky-700' : '' ?> py-2 w-fit border-gray-400 hover:text-green-700 text-sm">
                            <a href="/usuarios/cadastro" class='flex gap-4 items-end whitespace-nowrap'>
                                <i class='material-icons'>person_add</i>
                                Cadastrar novo usuário
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="py-2 w-fit text-sm">
                            <p class='flex text-gray-300 py-2 text-sm gap-4 items-end whitespace-nowrap cursor-default'>
                                <i class='material-icons'>person_add</i>
                                Cadastrar novo usuário
                            </p>
                        </li>
                    <?php endif ?>
                </ul>
            </li>
        </ul>

        <!-- JAVASCRIPT DE COMPORTAMENTO DAS TABS -->
        <script>
            // Display de lista de links das tabs
            const submenuParents = document.querySelectorAll('nav p.submenuParent')
            const submenus = document.querySelectorAll('ul.submenuLinkList')

            submenuParents.forEach(function(e, i) {
                e.addEventListener('click', function() {
                    submenus[i].classList.toggle('hideModal')
                })
            })
        </script>
    </nav>
<?php endif ?>