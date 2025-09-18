<?php include __DIR__ . '/views/layout/header.php'; ?> 
<!-- Inclui o cabeçalho da página, que contém navbar, links CSS, etc. -->

<div class="container my-5">
    <div class="row justify-content-center"> <!-- Centraliza o conteúdo horizontalmente -->
        <div class="col-md-6"> <!-- Define a largura do formulário para 6 colunas em telas médias -->
            <div class="p-4 bg-light rounded shadow-sm"> <!-- Caixa com padding, fundo claro, cantos arredondados e sombra -->
                <h3 class="text-center mb-4">📩 Abrir Chamado</h3> <!-- Título da seção -->

                <?php
                $mensagem = ''; // Inicializa variável para mensagem de feedback
                if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Verifica se o formulário foi enviado
                    $titulo = $_POST['titulo'] ?? ''; // Captura o título do problema
                    $descricao = $_POST['descricao'] ?? ''; // Captura a descrição do problema
                    // Aqui você pode salvar os dados ou ignorar, pois é um ticket falso
                    $mensagem = "✅ Aguarde contato do técnico!"; // Mensagem de confirmação após envio
                }
                ?>

                <?php if($mensagem): ?> <!-- Mostra mensagem de sucesso se existir -->
                    <div class="alert alert-success text-center"><?= $mensagem ?></div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data"> <!-- Formulário para enviar chamado -->
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título do Problema</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Digite um título resumido" required>
                        <!-- Input para título do problema, obrigatório -->
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição do Problema</label>
                        <textarea id="descricao" name="descricao" class="form-control" rows="5" placeholder="Descreva detalhadamente o problema" required></textarea>
                        <!-- Textarea para descrição detalhada, obrigatório -->
                    </div>

                    <div class="mb-3">
                        <label for="prints" class="form-label">Anexar Prints (opcional)</label>
                        <input type="file" id="prints" name="prints[]" class="form-control" multiple accept="image/*">
                        <!-- Campo opcional para anexar imagens -->
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Enviar Chamado</button> 
                        <!-- Botão para enviar o formulário -->
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-link">← Voltar para Home</a>
                    <!-- Link para voltar à página inicial -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/views/layout/footer.php'; ?> 
<!-- Inclui o rodapé da página -->
