<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/LivroController.php';

$controller = new LivroController($pdo);

$acao = $_GET['acao'] ?? 'menu';

switch($acao){
    case 'listar':
        $controller->listar();
        break;
    case 'cadastrar':
        $controller->cadastrar();
        break;
    case 'editar':
        $controller->editar($_GET['id'] ?? null);
        break;
    case 'apagar':
        $controller->apagar($_GET['id'] ?? null);
        break;
    default:
        include __DIR__ . '/views/layout/header.php';
        ?>

        <div class="text-center mt-5 mb-5">
            <h1 class="display-4 fw-bold mb-3">📚 Biblioteca Virtual <span class="text-primary">KCP</span></h1>
            <p class="lead text-muted mb-5">"Levando conhecimento para todos, em qualquer lugar"</p>

            <div class="d-flex justify-content-center gap-4 mb-5">
                <a href="index.php?acao=listar" class="btn btn-primary btn-lg px-5 py-3 shadow">
                    📖 Listar Livros
                </a>
                <a href="index.php?acao=cadastrar" class="btn btn-success btn-lg px-5 py-3 shadow">
                    ➕ Cadastrar Livro
                </a>
            </div>

            <div class="container">
                <div class="p-5 bg-light rounded shadow-sm">
                    <h2 class="fw-bold mb-3">Nossa História</h2>
                    <p class="text-muted fs-5">
                        A <strong>Biblioteca Virtual KCP</strong> nasceu em 2020, fundada por três jovens apaixonados por tecnologia e literatura.
                        O sonho era simples, mas ambicioso: criar uma plataforma acessível que conectasse leitores e livros em qualquer lugar do Brasil.
                    </p>
                    <p class="text-muted fs-5">
                        Começamos com apenas 100 títulos digitais, mas com dedicação, parcerias com editoras e o apoio da comunidade,
                        hoje contamos com milhares de obras em diversas áreas do conhecimento.
                    </p>
                    <p class="text-muted fs-5">
                        Nosso objetivo é continuar democratizando o acesso à leitura e ao aprendizado,
                        provando que o conhecimento é a chave para transformar o futuro.
                    </p>
                </div>
            </div>
        </div>

        <?php
        include __DIR__ . '/views/layout/footer.php';
        break;
}
