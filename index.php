<?php
require_once __DIR__ . '/config/database.php'; 
// Inclui o arquivo de configuração do banco de dados, criando a conexão $pdo

require_once __DIR__ . '/controllers/LivroController.php'; 
// Inclui o controller responsável por gerenciar ações relacionadas aos livros

$controller = new LivroController($pdo); 
// Cria uma instância do controller, passando a conexão com o banco de dados

$acao = $_GET['acao'] ?? 'menu'; 
// Captura a ação enviada via URL, se não existir, define 'menu' como padrão

switch($acao){
    case 'listar':
        $controller->listar(); // Chama método para listar todos os livros
        break;

    case 'cadastrar':
        $controller->cadastrar(); // Chama método para cadastrar um novo livro
        break;

    case 'editar':
        $controller->editar($_GET['id'] ?? null); 
        // Chama método para editar livro específico, passando o ID ou null
        break;

    case 'apagar':
        $controller->apagar($_GET['id'] ?? null); 
        // Chama método para apagar livro específico, passando o ID ou null
        break;

    case 'regras':
        $controller->regras(); // Exibe as regras da biblioteca
        break;

    case 'listarAutores':
        $controller->listarAutores(); // Lista todos os autores com livros cadastrados
        break;

    case 'livrosDoAutor':
        $controller->livrosDoAutor($_GET['autor_id'] ?? null); 
        // Lista todos os livros de um autor específico
        break;

    default: // <-- Aqui é o index (menu principal)
        include __DIR__ . '/views/layout/header.php'; 
        // Inclui o cabeçalho da página (navbar, CSS, scripts)

        ?>

        <div class="text-center mt-5 mb-5">
            <h1 class="display-4 fw-bold mb-3">📚 Biblioteca Virtual <span class="text-primary">KCP</span></h1>
            <p class="lead text-muted mb-5">"Levando conhecimento para todos, em qualquer lugar"</p>

            <div class="d-flex justify-content-center gap-4 mb-5">
                <!-- Botões de ação para navegar entre listar e cadastrar livros -->
                <a href="index.php?acao=listar" class="btn btn-primary btn-lg px-5 py-3 shadow">
                    📖 Listar Livros
                </a>
                <a href="index.php?acao=cadastrar" class="btn btn-success btn-lg px-5 py-3 shadow">
                    ➕ Cadastrar Livro
                </a>
            </div>

            <div class="container">
                <div class="p-5 bg-light rounded shadow-sm">
                    <!-- Seção de apresentação do sistema -->
                    <h2 class="fw-bold mb-3">Programa de Biblioteca Virtual KCP</h2>
                    <p class="text-muted fs-5">
                        Bem-vindo ao <strong>Programa de Biblioteca Virtual KCP</strong>, um sistema exclusivo para o bibliotecário gerenciar o acervo de livros da faculdade.
                    </p>
                    <p class="text-muted fs-5">
                        Aqui é possível cadastrar novos livros, alterar informações, pesquisar títulos já existentes e organizar o catálogo da biblioteca de forma prática.
                    </p>
                    <p class="text-muted fs-5">
                        O sistema permite acompanhar quais livros estão disponíveis, emprestados ou indisponíveis, além de verificar se determinada obra faz parte do acervo.
                    </p>
                    <p class="text-muted fs-5">
                        O objetivo é oferecer ao bibliotecário uma ferramenta eficiente para manter o acervo atualizado, organizado e de fácil consulta.
                    </p>
                </div>
            </div>
        </div>

        <?php
        include __DIR__ . '/views/layout/footer.php'; 
        // Inclui o rodapé da página (somente no index)
        break;
}
?>
