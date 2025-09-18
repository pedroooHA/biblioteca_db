<?php
class Livro {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("
            SELECT l.*, a.nome AS autor
            FROM livros l
            LEFT JOIN autores a ON l.autor_id = a.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrar($titulo, $autor_id, $ano_publicacao) {
        $stmt = $this->pdo->prepare("
            INSERT INTO livros (titulo, autor_id, ano_publicacao) VALUES (?,?,?)
        ");
        return $stmt->execute([$titulo, $autor_id, $ano_publicacao]);
    }

    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM livros WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $titulo, $autor_id, $ano_publicacao, $status) {
        $stmt = $this->pdo->prepare("
            UPDATE livros SET titulo=?, autor_id=?, ano_publicacao=?, status=? WHERE id=?
        ");
        return $stmt->execute([$titulo, $autor_id, $ano_publicacao, $status, $id]);
    }

    public function apagar($id) {
        $stmt = $this->pdo->prepare("DELETE FROM livros WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function buscarPorTituloOuAutor($q) {
    $stmt = $this->pdo->prepare("
        SELECT l.*, a.nome AS autor
        FROM livros l
        LEFT JOIN autores a ON l.autor_id = a.id
        WHERE l.titulo LIKE ? OR a.nome LIKE ?
        LIMIT 10
    ");
    $stmt->execute(["%$q%", "%$q%"]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
