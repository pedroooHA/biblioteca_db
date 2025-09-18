<?php
class Autor {
    private $pdo; // Conexão com o banco de dados

    // Construtor recebe a conexão PDO e armazena na classe
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Lista todos os autores cadastrados
    public function listar() {
        $stmt = $this->pdo->query("SELECT * FROM autores"); // consulta simples
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // retorna todos os resultados em array associativo
    }

    // Busca um autor pelo nome
    public function buscarPorNome($nome) {
        $stmt = $this->pdo->prepare("SELECT * FROM autores WHERE nome = ?"); // consulta com parâmetro
        $stmt->execute([$nome]); // executa passando o nome
        return $stmt->fetch(PDO::FETCH_ASSOC); // retorna apenas um autor
    }

    // Cadastra um novo autor no banco
    public function cadastrar($nome) {
        $stmt = $this->pdo->prepare("INSERT INTO autores (nome) VALUES (?)"); // insere novo autor
        $stmt->execute([$nome]);
        return $this->pdo->lastInsertId(); // retorna o ID do autor inserido
    }

    // Lista apenas autores que possuem livros cadastrados
    public function listarAutoresComLivros() {
        $stmt = $this->pdo->query("
            SELECT DISTINCT a.id, a.nome
            FROM autores a
            JOIN livros l ON l.autor_id = a.id
            ORDER BY a.nome
        "); // junta tabelas autores e livros
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // retorna lista de autores com livros
    }

    // Busca autor pelo ID
    public function buscarPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM autores WHERE id = ?"); // consulta por ID
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // retorna um autor
    }
}
