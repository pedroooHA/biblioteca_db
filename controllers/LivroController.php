<?php
// Importa os arquivos das classes Livro e Autor
require_once __DIR__ . '/../models/Livro.php';
require_once __DIR__ . '/../models/Autor.php';

class LivroController {
    private $livro; // objeto da classe Livro
    private $autor; // objeto da classe Autor

    // Construtor que recebe a conexão ($pdo) e instancia os models
    public function __construct($pdo) {
        $this->livro = new Livro($pdo);
        $this->autor = new Autor($pdo);
    }

    // Listar todos os livros
    public function listar() {
        $livros = $this->livro->listar(); // busca todos os livros
        include __DIR__ . '/../views/livros/listar.php'; // carrega a view
    }

    // Cadastrar livro
    public function cadastrar() {
        $mensagem = '';
        $autores = $this->autor->listar(); // lista os autores já cadastrados

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // verifica se houve envio de formulário
            $titulo = $_POST['titulo'];
            $autorNome = $_POST['autor_nome'];
            $ano = $_POST['ano_publicacao'];

            // Verifica se o autor já existe, se não cadastra
            $autorExistente = $this->autor->buscarPorNome($autorNome);
            $autorId = $autorExistente ? $autorExistente['id'] : $this->autor->cadastrar($autorNome);

            // Verifica se o livro já existe
            if ($this->livro->existe($titulo, $autorId, $ano)) {
                $mensagem = 'Livro já cadastrado, verificar disponibilidade.';
            } else {
                // Cadastra novo livro
                $this->livro->cadastrar($titulo, $autorId, $ano);
                header('Location: index.php?acao=listar');
                exit;
            }
        }

        include __DIR__ . '/../views/livros/cadastrar.php';
    }

    // Editar livro
    public function editar($id) {
        if (!$id) { // se não tiver ID, redireciona
            header('Location: index.php?acao=listar');
            exit;
        }

        $livro = $this->livro->buscarPorId($id); // busca livro pelo ID
        if (!$livro) { // se não achar, volta pra listagem
            header('Location: index.php?acao=listar');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') { // se formulário enviado
            $titulo = $_POST['titulo'] ?? '';
            $autorNome = $_POST['autor_nome'] ?? '';
            $ano = $_POST['ano_publicacao'] ?? null;
            $status = $_POST['status'] ?? 'DISPONÍVEL';

            // Verifica se autor já existe ou cadastra novo
            $autorExistente = $this->autor->buscarPorNome($autorNome);
            $autorId = $autorExistente ? $autorExistente['id'] : $this->autor->cadastrar($autorNome);

            // Atualiza livro
            $this->livro->atualizar($id, $titulo, $autorId, $ano, $status);

            header('Location: index.php?acao=listar');
            exit;
        }

        include __DIR__ . '/../views/livros/editar.php';
    }

    // Apagar livro
    public function apagar($id) {
        if ($id) {
            $this->livro->apagar($id); // chama model para excluir
        }
        header('Location: index.php?acao=listar');
        exit;
    }

    // Buscar livros por título ou autor
    public function buscar() {
        $q = $_GET['q'] ?? ''; // pega parâmetro de busca
        $livros = $this->livro->buscarPorTituloOuAutor($q); // busca no banco
        foreach($livros as $l) {
            // imprime links de resultados
            echo '<a href="index.php?acao=editar&id='.$l['id'].'" class="list-group-item list-group-item-action">'
                 . htmlspecialchars($l['titulo']).' - '.htmlspecialchars($l['autor']).'</a>';
        }
        exit;
    }

    // Marcar ou desmarcar livro como favorito
    public function favorito() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            session_start(); // inicia sessão
            $_SESSION['favoritos'][$id] = !($_SESSION['favoritos'][$id] ?? false); // alterna status
        }
        exit;
    }

    // Exibir regras da biblioteca
    public function regras() {
        include __DIR__ . '/../views/layout/header.php';
        ?>
        <div class="container my-5">
            <h2 class="text-center mb-4">📋 Regras da Biblioteca Virtual KCP</h2>
            <div class="p-4 bg-light rounded shadow-sm">
                <ul class="list-group list-group-flush fs-5">
                    <li class="list-group-item">1. Cada livro cadastrado deve conter título, autor e ano.</li>
                    <li class="list-group-item">2. Evite duplicar cadastros: verifique se o livro já não está registrado.</li>
                    <li class="list-group-item">3. Atualize informações dos livros sempre que houver alterações.</li>
                    <li class="list-group-item">4. Não apague livros sem motivo; registre a justificativa se necessário.</li>
                    <li class="list-group-item">5. Mantenha os dados organizados e consistentes.</li>
                    <li class="list-group-item">6. Comunique problemas técnicos imediatamente.</li>
                    <li class="list-group-item">7. Cadastre apenas livros do acervo oficial da instituição.</li>
                </ul>
                <p class="text-muted mt-3">
                    Ao utilizar a Biblioteca Virtual KCP, você concorda em seguir estas regras para garantir o bom funcionamento e conservação do acervo.
                </p>
            </div>
        </div>
        <?php
        include __DIR__ . '/../views/layout/footer.php';
    }

    // Listar autores com seus livros
    public function listarAutores() {
        $autores = $this->autor->listarAutoresComLivros(); // busca autores com livros cadastrados
        include __DIR__ . '/../views/layout/header.php';
        ?>
        <div class="container my-5">
            <h2 class="text-center mb-4">👩‍🏫 Autores com Livros Cadastrados</h2>
            <div class="p-4 bg-light rounded shadow-sm">
                <?php if(!empty($autores)): ?>
                   <ul class="list-group list-group-flush fs-5">
                        <?php foreach($autores as $autor): ?>
                            <li class="list-group-item">
                                <a href="index.php?acao=livrosDoAutor&autor_id=<?= $autor['id'] ?>">
                                    <?= htmlspecialchars($autor['nome']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-center text-muted">Nenhum autor com livros cadastrados.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php
        include __DIR__ . '/../views/layout/footer.php';
    }

    // Exibir livros de um autor específico
    public function livrosDoAutor($autorId) {
        if (!$autorId) {
            header('Location: index.php?acao=listarAutores');
            exit;
        }

        $autor = $this->autor->buscarPorId($autorId); // busca autor pelo ID
        $livros = $this->livro->listarPorAutor($autorId); // lista livros do autor

        include __DIR__ . '/../views/layout/header.php';
        ?>
        <div class="container my-5">
            <h2 class="text-center mb-4">📚 Livros de <?= htmlspecialchars($autor['nome']) ?></h2>
            <div class="p-4 bg-light rounded shadow-sm">
                <?php if(!empty($livros)): ?>
                    <ul class="list-group list-group-flush fs-5">
                        <?php foreach($livros as $livro): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span><?= htmlspecialchars($livro['titulo']) ?> (<?= $livro['ano_publicacao'] ?>)</span>
                                <a href="index.php?acao=editar&id=<?= $livro['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-center text-muted">Nenhum livro encontrado para este autor.</p>
                <?php endif; ?>
            </div>
        </div>
        <?php
        include __DIR__ . '/../views/layout/footer.php';
    }
}
