<?php
class Livro {
    private $pdo; // Conexão com o banco de dados

    // Construtor recebe a conexão PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lista todos os livros, trazendo também o nome do autor
    public function listar() {
        $stmt = $this->pdo->query("
            SELECT l.*, a.nome AS autor
            FROM livros l
            LEFT JOIN autores a ON l.autor_id = a.id
        "); // LEFT JOIN garante que mesmo sem autor o livro aparece
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // retorna todos os livros
    }

    // Cadastra um novo livro
    public function cadastrar($titulo, $autor_id, $ano_publicacao) {
        $stmt = $this->pdo->prepare("
            INSERT INTO livros (titulo, autor_id, ano_publicacao) VALUES (?,?,?)
        "); // insere título, autor e ano
        return $stmt->execute([$titulo, $autor_id, $ano_publicacao]); // executa a query
    }

    // Busca um livro pelo ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // retorna apenas 1 livro
    }

    // Atualiza os dados de um livro existente
    public function atualizar($id, $titulo, $autor_id, $ano_publicacao, $status) {
        $stmt = $this->pdo->prepare("
            UPDATE livros SET titulo=?, autor_id=?, ano_publicacao=?, status=? WHERE id=?
        "); // atualiza todos os campos principais
        return $stmt->execute([$titulo, $autor_id, $ano_publicacao, $status, $id]);
    }

    // Apaga um livro pelo ID
    public function apagar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM livros WHERE id = :id"); // exclui da tabela
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // protege contra SQL injection
        $stmt->execute();
    }

    // Busca livros pelo título ou nome do autor
    public function buscarPorTituloOuAutor($q) {
        $stmt = $this->pdo->prepare("
            SELECT l.*, a.nome AS autor
            FROM livros l
            LEFT JOIN autores a ON l.autor_id = a.id
            WHERE l.titulo LIKE ? OR a.nome LIKE ?
            LIMIT 10
        "); // busca parcial com LIKE
        $stmt->execute(["%$q%", "%$q%"]); // pesquisa tanto no título quanto no autor
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Verifica se um livro já existe (mesmo título, autor e ano)
    public function existe($titulo, $autor_id, $ano_publicacao) {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) FROM livros 
            WHERE titulo = ? AND autor_id = ? AND ano_publicacao = ?
        ");
        $stmt->execute([$titulo, $autor_id, $ano_publicacao]);
        return $stmt->fetchColumn() > 0; // retorna true se já existir
    }

    // Lista todos os livros de um autor específico
    public function listarPorAutor($autorId) {
        $stmt = $this->pdo->prepare("
            SELECT l.*, a.nome AS autor
            FROM livros l
            JOIN autores a ON l.autor_id = a.id
            WHERE a.id = ?
        "); // pega livros ligados ao autor
        $stmt->execute([$autorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
