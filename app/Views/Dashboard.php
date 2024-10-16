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
                <button class="d-flex align-items-center">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>