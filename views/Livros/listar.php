<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="mb-4">
    <input type="text" id="search" class="form-control" placeholder="Buscar livros ou autores...">
</div>
<div id="search-results" class="list-group mb-4"></div>

<a href="index.php?acao=cadastrar" class="btn btn-success mb-2">Cadastrar Livro</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Ano</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($livros)): ?>
            <?php foreach($livros as $l): ?>
            <tr>
                <td><?= $l['id'] ?></td>
                <td><?= $l['titulo'] ?></td>
                <td><?= $l['autor'] ?? 'Não definido' ?></td>
                <td><?= $l['ano_publicacao'] ?></td>
                <td><?= $l['status'] ?? 'DISPONÍVEL' ?></td>
                <td>
                    <a href="index.php?acao=editar&id=<?= $l['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Nenhum livro cadastrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
document.getElementById('search').addEventListener('input', function() {
    const query = this.value.trim();
    if (!query) {
        document.getElementById('search-results').innerHTML = '';
        return;
    }

    fetch(`index.php?acao=buscar&q=${encodeURIComponent(query)}`)
        .then(res => res.text())
        .then(html => {
            document.getElementById('search-results').innerHTML = html;
        });
});
</script>

<div class="mb-4 d-flex gap-3">
    <select id="filter-author" class="form-select">
        <option value="">Todos os autores</option>
        <?php foreach($autores as $a): ?>
            <option value="<?= $a['id'] ?>"><?= $a['nome'] ?></option>
        <?php endforeach; ?>
    </select>

    <select id="filter-status" class="form-select">
        <option value="">Todos os status</option>
        <option value="DISPONÍVEL">Disponível</option>
        <option value="INDISPONÍVEL">Indisponível</option>
    </select>

    <button id="apply-filters" class="btn btn-primary">Filtrar</button>
</div>

<div id="book-list">
    <?php foreach($livros as $l): ?>
        <div class="card mb-3 p-3 book-card" data-autor="<?= $l['autor_id'] ?>" data-status="<?= $l['status'] ?>">
            <h5><?= $l['titulo'] ?></h5>
            <p><?= $l['autor'] ?> | <?= $l['ano_publicacao'] ?></p>
        </div>
    <?php endforeach; ?>
</div>

<script>
document.getElementById('apply-filters').addEventListener('click', function() {
    const author = document.getElementById('filter-author').value;
    const status = document.getElementById('filter-status').value;
    document.querySelectorAll('.book-card').forEach(card => {
        const matchAuthor = !author || card.dataset.autor === author;
        const matchStatus = !status || card.dataset.status === status;
        card.style.display = (matchAuthor && matchStatus) ? 'block' : 'none';
    });
});
</script>
<button class="btn btn-outline-warning btn-sm favorite-btn" data-id="<?= $l['id'] ?>">
    ⭐
</button>

<script>
document.querySelectorAll('.favorite-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const bookId = this.dataset.id;
        fetch(`index.php?acao=favorito&id=${bookId}`)
            .then(() => {
                this.classList.toggle('btn-warning');
            });
    });
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?>
