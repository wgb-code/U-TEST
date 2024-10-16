    <?= $this->extend('Dashboard') ?>

    <?= $this->section('views') ?>
        <section class="d-flex flex-column">
            <h2 class="title-list">Clientes</h2>

            <form class="form-filter d-flex align-items-center" action="" method="get">
                <div class="form-filter-group">
                    <input
                        class="form-filter-input"
                        placeholder="Pesquisar Clientes"
                        type="text"
                    >

                    <img
                        src="<?= base_url('assets/user-search.svg') ?>"
                        alt="Ícone de busca de cliente"
                        width="16"
                        height="16"
                    >
                </div>

                <button class="filter-btn d-flex">
                    <img
                        src="<?= base_url('assets/tags.svg') ?>"
                        alt="Ícone de Tags"
                        width="16"
                        height="16"
                    >

                    <p>Filtrar</p>
                </button>
            </form>

            <article class="list-users">
            <?php if (isset($customers) && is_array($customers) && count($customers) > 0): ?>
                <ul class="customer-list">
                    <?php foreach ($customers as $customer): ?>
                        <li class="customer-item">
                            <p><strong>Nome:</strong> <?= esc($customer->name); ?></p>
                            <p><strong>Email:</strong> <?= esc($customer->email); ?></p>
                            <p><strong>Status:</strong> <?= esc($customer->status); ?></p>
                            <p><strong>Data de Admissão:</strong> <?= esc($customer->admission_date); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Nenhum cliente encontrado.</p>
            <?php endif; ?>
        </article>
        </section>
    <?= $this->endSection() ?>