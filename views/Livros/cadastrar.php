<?php include __DIR__ . '/../layout/header.php'; ?> <!-- Inclui o cabeçalho da página (navbar, CSS, etc.) -->

<?php if(!empty($mensagem)): ?> <!-- Verifica se há alguma mensagem de aviso -->
    <div class="alert alert-warning text-center"> <!-- Exibe mensagem de alerta centralizada -->
        <?= $mensagem ?> <!-- Mostra o conteúdo da mensagem -->
    </div>
<?php endif; ?>

<!-- Container principal para o formulário, centralizado vertical e horizontalmente -->
<div class="d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <form method="POST" class="w-50 p-4 bg-light rounded shadow-sm"> <!-- Formulário com 50% da largura, padding, fundo claro, cantos arredondados e sombra -->
        <h3 class="text-center mb-4">Cadastrar Novo Livro</h3> <!-- Título do formulário -->

        <!-- Campo de título do livro -->
        <div class="mb-3">
            <label>Título</label>
            <input type="text" name="titulo" class="form-control" placeholder="Escreva o título do livro" required> <!-- Campo obrigatório -->
        </div>

        <!-- Campo de autor -->
        <div class="mb-3">
            <label>Autor</label>
            <input type="text" name="autor_nome" class="form-control" placeholder="Digite o nome do autor" required> <!-- Campo obrigatório -->
        </div>

        <!-- Campo de ano de publicação -->
        <div class="mb-3">
            <label>Ano de Publicação</label>
            <input type="text" name="ano_publicacao" class="form-control" placeholder="Digite o ano de publicação do livro" pattern="\d{4}" title="Digite apenas 4 dígitos" required> <!-- Validação para 4 dígitos -->
        </div>

        <!-- Botão de envio -->
        <div class="text-center">
            <button class="btn btn-primary px-5">Salvar</button> <!-- Botão estilizado do Bootstrap -->
        </div>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?> <!-- Inclui o rodapé da página -->
