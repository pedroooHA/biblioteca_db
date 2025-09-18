<?php
$host = 'localhost'; // endereço do servidor do banco
$db   = 'biblioteca_db'; // nome do banco de dados
$user = 'root'; // usuário do banco
$pass = ''; // senha do usuário
$charset = 'utf8mb4'; // charset para suportar caracteres especiais

// string de conexão (DSN) com os dados do banco
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// opções para configuração do PDO
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // define para lançar exceção em caso de erro
];

try {
    // cria uma nova conexão com o banco usando PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // se der erro na conexão, mostra a mensagem e encerra o script
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}
