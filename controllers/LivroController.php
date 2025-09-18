<?php
require_once __DIR__ . '/../models/Livro.php';
require_once __DIR__ . '/../models/Autor.php';

class LivroController {
    private $livro;
    private $autor;

    public function __construct($pdo) {
        $this->livro = new Livro($pdo);
        $this->autor = new Autor($pdo);
    }

    // Listar livros
    public function listar() {
        $livros = $this->livro->listar();
        include __DIR__ . '/../views/livros/listar.php';
    }

    // Cadastrar livro
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $autorNome = $_POST['autor_nome'] ?? '';
            $ano = $_POST['ano_publicacao'] ?? null;

            // Verifica se o autor já existe
            $autorExistente = $this->autor->buscarPorNome($autorNome);

            if ($autorExistente) {
                $autorId = $autorExistente['id'];
            } else {
                // Cadastra novo autor
                $autorId = $this->autor->cadastrar($autorNome);
            }

            // Cadastra o livro
            $this->livro->cadastrar($titulo, $autorId, $ano);

            header('Location: index.php?acao=listar');
            exit;
        }

        include __DIR__ . '/../views/livros/cadastrar.php';
    }

    // Editar livro
    public function editar($id) {
        if (!$id) {
            header('Location: index.php?acao=listar');
            exit;
        }

        $livro = $this->livro->buscarPorId($id);

        if (!$livro) {
            header('Location: index.php?acao=listar');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $autorNome = $_POST['autor_nome'] ?? '';
            $ano = $_POST['ano_publicacao'] ?? null;
            $status = $_POST['status'] ?? 'DISPONÍVEL';

            // Verifica se o autor já existe
            $autorExistente = $this->autor->buscarPorNome($autorNome);

            if ($autorExistente) {
                $autorId = $autorExistente['id'];
            } else {
                // Cadastra novo autor
                $autorId = $this->autor->cadastrar($autorNome);
            }

            // Atualiza o livro
            $this->livro->atualizar($id, $titulo, $autorId, $ano, $status);

            header('Location: index.php?acao=listar');
            exit;
        }

        include __DIR__ . '/../views/livros/editar.php';
    }

    // Apagar livro
    public function apagar($id) {
        if ($id) {
            $this->livro->apagar($id);
        }
        header('Location: index.php?acao=listar');
        exit;
    }

public function buscar() {
        $q = $_GET['q'] ?? '';
        $livros = $this->livro->buscarPorTituloOuAutor($q);
        foreach($livros as $l) {
            echo '<a href="index.php?acao=editar&id='.$l['id'].'" class="list-group-item list-group-item-action">'
                 . $l['titulo'].' - '.$l['autor'].'</a>';
        }
        exit;
    }

public function favorito() {
    $id = $_GET['id'] ?? null;
    if ($id) {
        session_start();
        $_SESSION['favoritos'][$id] = !($_SESSION['favoritos'][$id] ?? false);
    }
    exit;
}


}


