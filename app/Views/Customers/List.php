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

        <?php if (!empty($customers)): ?>
            <table class="table-list">
                <tr class="header">
                    <td>Nome</td>
                    <td>Email</td>
                    <td>Status</td>
                    <td>Data admissional</td>
                    <td>Última atualização</td>
                    <td></td>
                </tr>
                <?php foreach ($customers as $cs): ?>
                    <tr class="body">
                        <td>
                            <?= esc($cs['name']); ?>
                        </td>
                        <td class="secondary-item">
                            <?= esc($cs['email']); ?>
                        </td>
                        <td class="secondary-item">
                            <?= esc($cs['status']); ?>
                        </td>
                        <td class="secondary-item">
                            <?= esc($cs['admission']); ?>
                        </td>
                        <td class="secondary-item">
                            <?= esc($cs['updated']); ?>
                        </td>
                        <td class="d-flex justify-content-end">
                            <button class="list-btn-more">
                                <img
                                    src="<?= base_url('assets/elipsis.svg') ?>"
                                    alt="Ícone de ver mais"
                                    width="16"
                                    height="16"
                                >
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="pagination">
                <ul class="pagination-list d-flex">
                    <?php if ($currentPage > 1): ?>
                        <li>
                            <a href="?page=<?= $currentPage - 1 ?>" class="pagination-link">Anterior</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li>
                            <a href="?page=<?= $i ?>" class="pagination-link <?= $i == $currentPage ? 'active' : '' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <li>
                            <a href="?page=<?= $currentPage + 1 ?>" class="pagination-link">Próximo</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <form action="" method="get" class="page-selector">
                    <label for="page-select">Ir para a página:</label>
                    <select name="page" id="page-select" onchange="this.form.submit()">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <option value="<?= $i ?>" <?= $i == $currentPage ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </form>
            </div>

        <?php else: ?>
            <p>Cadastre um novo cliente para listá-lo aqui.</p>
        <?php endif; ?>
    </section>
<?= $this->endSection(); ?>