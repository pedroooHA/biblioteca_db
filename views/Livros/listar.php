<?php include __DIR__ . '/../layout/header.php'; ?> <!-- Inclui o cabeçalho da página (navbar, CSS, etc.) -->

<!-- Container principal para a lista de livros -->
<div class="container d-flex justify-content-center mt-5">
    <div class="w-75"> <!-- Define largura de 75% da tela -->
        <h3 class="text-center mb-4">📚 Lista de Livros</h3> <!-- Título da página -->

        <!-- Barra de pesquisa -->
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="🔍 Pesquisar por ID ou Título...">
            <!-- Input para filtrar livros por ID ou título -->
        </div>

        <!-- Tabela de livros -->
        <table class="table table-bordered text-center">
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
            <tbody id="livros-table">
                <?php if(!empty($livros)): ?> <!-- Verifica se existem livros -->
                    <?php foreach($livros as $l): ?> <!-- Itera sobre cada livro -->
                        <tr>
                            <td><?= $l['id'] ?></td> <!-- Exibe ID do livro -->
                            <td><?= $l['titulo'] ?></td> <!-- Exibe título do livro -->
                            <td><?= $l['autor'] ?? 'Não definido' ?></td> <!-- Exibe autor ou texto padrão -->
                            <td><?= $l['ano_publicacao'] ?></td> <!-- Exibe ano de publicação -->
                            <td><?= $l['status'] ?? 'DISPONÍVEL' ?></td> <!-- Exibe status ou padrão DISPONÍVEL -->
                            <td>
                                <!-- Link para editar o livro -->
                                <a href="index.php?acao=editar&id=<?= $l['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?> <!-- Caso não haja livros cadastrados -->
                    <tr>
                        <td colspan="6">Nenhum livro cadastrado.</td> <!-- Mensagem informativa -->
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
// Script para filtrar a tabela de livros ao digitar na barra de pesquisa
document.getElementById('search').addEventListener('input', function() {
    const searchValue = this.value.toLowerCase(); // Valor digitado pelo usuário, convertido para minúsculas
    const rows = document.querySelectorAll('#livros-table tr'); // Seleciona todas as linhas da tabela

    rows.forEach(row => {
        const id = row.querySelector('td:nth-child(1)')?.textContent.toLowerCase() || ''; // Pega o ID da linha
        const title = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || ''; // Pega o título da linha
        
        // Mostra a linha se ID ou título contiverem o valor digitado
        if (id.includes(searchValue) || title.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none'; // Esconde a linha caso não corresponda
        }
    });
});
</script>

<?php include __DIR__ . '/../layout/footer.php'; ?> <!-- Inclui o rodapé da página -->
