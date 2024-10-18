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
                    <tr class="body" id="table-list">
                        <td>
                            <?= esc($cs['name']); ?>
                        </td>
                        <td class="secondary-item">
                            <?= esc($cs['email']); ?>
                        </td>
                        <td class="secondary-item">
                            <div class="<?= esc($cs['status']); ?> d-flex align-items-center justify-content-center">
                                <?= esc($cs['status']); ?>
                            </div>
                        </td>
                        <td class="secondary-item">
                            <?= esc($cs['admission']); ?>
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
                            <aside class="dropdown-options">
                                <ul>
                                    <li>
                                        <button
                                            class="edit-button d-flex align-items-center gap-2"
                                            data-url="<?= site_url('Dashboard/deleteCustomer') ?>"
                                            data-id="<?= $cs['id']; ?>"
                                            data-name="<?= esc($cs['name']); ?>"
                                            data-email="<?= esc($cs['email']); ?>"
                                            data-status="<?= esc($cs['status']); ?>"
                                            onclick="fillEditModal(this)"
                                        >
                                            <img src="<?= base_url('assets/user-edit.svg') ?>" alt="Ícone de editar" width="16" height="16">
                                            <p>Editar</p>
                                        </button>
                                    </li>
                                    <li>
                                        <button
                                            class="delete-button d-flex align-items-center gap-2"
                                            data-url="<?= site_url('Dashboard/deleteCustomer/') ?>"
                                            data-id="<?= $cs['id']; ?>"
                                            onclick="confirmDelete(this)"
                                        >
                                            <img
                                                src="<?= base_url('assets/user-delete.svg') ?>"
                                                alt="Ícone de deletar"
                                                width="16"
                                                height="16"
                                            >
                                            <p>Excluir</p>
                                        </button>
                                    </li>
                                </ul>
                            </aside>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="pagination-list d-flex align-items-center justify-content-end">
                <form method="get" class="page-selector">
                    <label class="pagination-label" for="page-select">Ir para a página:</label>

                    <select name="page" id="page-select" onchange="this.form.submit()">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <option class="page-selector-opt" value="<?= $i ?>" <?= $i == $currentPage ? 'selected' : '' ?>><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </form>
            </div>

        <?php else: ?>
            <p>Cadastre um novo cliente para listá-lo aqui.</p>
        <?php endif; ?>
    </section>

    <div id="editCustomerModal" class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <p>Preencha os novos dados do cliente</p>
                </div>
                <div class="modal-body">
                    <form id="editCustomerForm" action="<?= site_url('Dashboard/editCustomer'); ?>" method="POST">
                        <input type="hidden" name="idCustomer" value="">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nameCustomer" id="nome" placeholder="Digite o nome do usuário" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="emailCustomer" id="email" placeholder="Digite o e-mail do usuário" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="statusCustomer" class="form-control" id="status" required>
                                <option value="C">Contratado</option>
                                <option value="D">Demitido</option>
                                <option value="E">Estagiário</option>
                                <option value="A">Afastado</option>
                                <option value="F">Férias</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Data de Admissão</label>
                            <input id="date" class="form-control" name="createCustomer" type="date" min="2024-01-01" max="2024-10-16" required/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="d-flex align-items-center btn btn-primary" onclick="editCustomer()">
                        <img
                            src="<?= base_url('assets/check.svg') ?>"
                            alt="Ícone de Tags"
                            width="16"
                            height="16"
                        >
                        <p>Editar</p>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>