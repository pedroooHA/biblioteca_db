<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <form method="POST" class="w-50 p-4 bg-light rounded shadow-sm">
        <h3 class="text-center mb-4">Editar Livro</h3>

        <!-- Campo Título -->
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" 
                   value="<?= htmlspecialchars($livro['titulo'] ?? '') ?>" 
                   placeholder="Escreva o título do livro" required>
        </div>

        <!-- Campo Autor -->
        <div class="mb-3">
            <label>Autor</label>
            <input type="text" name="autor_nome" class="form-control" 
                   value="<?= htmlspecialchars($livro['autor'] ?? '') ?>" 
                   placeholder="Digite o nome do autor" required>
        </div>

        <!-- Campo Ano de Publicação -->
        <div class="mb-3">
            <label>Ano de Publicação</label>
            <input type="text" name="ano_publicacao" class="form-control" 
                   value="<?= htmlspecialchars($livro['ano_publicacao'] ?? '') ?>" 
                   placeholder="Digite o ano de publicação do livro" 
                   pattern="\d{4}" 
                   title="Digite apenas 4 dígitos" 
                   required>
        </div>

        <!-- Campo Status -->
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="DISPONÍVEL" <?= ($livro['status'] ?? '') == 'DISPONÍVEL' ? 'selected' : '' ?>>DISPONÍVEL</option>
                <option value="INDISPONÍVEL" <?= ($livro['status'] ?? '') == 'INDISPONÍVEL' ? 'selected' : '' ?>>INDISPONÍVEL</option>
            </select>
        </div>

        <!-- Botões -->
        <div class="d-flex justify-content-between mt-4">
            <button type="submit" class="btn btn-primary px-4">Atualizar</button>
            <a href="index.php?acao=apagar&id=<?= $livro['id'] ?>" 
               class="btn btn-danger px-4" 
               onclick="return confirm('Tem certeza que deseja apagar este livro?')">
               Apagar
            </a>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
