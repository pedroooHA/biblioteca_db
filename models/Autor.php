<?php
class Autor {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM autores");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
public function buscarPorNome($nome) {
    $stmt = $this->pdo->prepare("SELECT * FROM autores WHERE nome = ?");
    $stmt->execute([$nome]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function cadastrar($nome) {
    $stmt = $this->pdo->prepare("INSERT INTO autores (nome) VALUES (?)");
    $stmt->execute([$nome]);
    return $this->pdo->lastInsertId();
}

}
