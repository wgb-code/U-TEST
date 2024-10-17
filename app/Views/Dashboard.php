<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard de usuários desenvolvido para teste técnico">
    <meta name="keywords" content="Dashboard, Controle de Usuários">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('styles/dashboard.css') ?>">
    <title>Dashboard.ME</title>
</head>
<body>
    <header class="container my-5">
        <ul class="d-flex align-items-center justify-content-between">
            <li class="logo-title d-flex align-items-center">
                <img
                    src="<?= base_url('favicon.ico') ?>"
                    alt="Logo da umentor"
                >

                <h1 class="text-white fs-6">Controle de Clientes</h1>
            </li>
            <li>
                <button class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    <img
                        src="<?= base_url('assets/user-plus.svg') ?>"
                        alt="Ícone de criação de usuário"
                        width="20"
                        height="20"
                    >
                    <p>Cadastrar</p>
                </button>
            </li>
        </ul>
    </header>

    <main class="container">
        <?= $this->renderSection('views')?>
    </main>

    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Cliente</h5>
                    <p>Preencha os dados do cliente</p>
                </div>
                <div class="modal-body">
                    <form id="createCustomerForm" action="<?= site_url('Dashboard/createCustomer') ?>" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nameCustomer" id="nome" placeholder="Digite o nome do usuário" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="emailCustomer" id="email" placeholder="Digite o e-mail do usuário" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Data de Admissão</label>
                            <input id="date" class="form-control" name="createCustomer" type="date" min="2024-01-01" max="2024-10-16" required/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="d-flex align-items-center btn btn-primary" onclick="submitCustomerForm()">
                        <img
                            src="<?= base_url('assets/check.svg') ?>"
                            alt="Ícone de Tags"
                            width="16"
                            height="16"
                        >
                        <p>Cadastrar</p>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="<?= base_url('js/Dashboard.js') ?>"></script>
</body>
</html>
