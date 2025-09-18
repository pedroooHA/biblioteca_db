<?php include __DIR__ . '/../layout/header.php'; ?>
<form method="POST">
    <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" value="<?= $livro['titulo'] ?>" required>
    </div>
    <div class="mb-3">
    <label>Autor</label>
    <input type="text" name="autor_nome" class="form-control" 
           value="<?= htmlspecialchars($livro['autor'] ?? '') ?>" 
           placeholder="Digite o nome do autor" required>
</div>

    <div class="mb-3">
        <label>Ano de Publicação</label>
        <input type="number" name="ano_publicacao" class="form-control" value="<?= $livro['ano_publicacao'] ?>">
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="DISPONÍVEL" <?= $livro['status']=='DISPONÍVEL'?'selected':'' ?>>DISPONÍVEL</option>
            <option value="INDISPONÍVEL" <?= $livro['status']=='INDISPONÍVEL'?'selected':'' ?>>INDISPONÍVEL</option>
        </select>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="index.php?acao=apagar&id=<?= $livro['id'] ?>" class="btn btn-danger" 
           onclick="return confirm('Tem certeza que deseja apagar este livro?')">
           Apagar
        </a>
    </div>
</form>
<?php include __DIR__ . '/../layout/footer.php'; ?>
