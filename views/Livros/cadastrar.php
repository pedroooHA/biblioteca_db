<?php include __DIR__ . '/../layout/header.php'; ?>
<form method="POST">
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Autor</label>
        <input type="text" name="autor_nome" class="form-control" placeholder="Digite o nome do autor" required>
    </div>
    <div class="mb-3">
        <label>Ano de Publicação</label>
        <input type="number" name="ano_publicacao" class="form-control">
    </div>
    <button class="btn btn-primary">Salvar</button>
</form>
<?php include __DIR__ . '/../layout/footer.php'; ?>
