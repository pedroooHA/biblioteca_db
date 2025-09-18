<!DOCTYPE html> <!-- Declara o tipo de documento HTML5 -->
<html lang="pt-br"> <!-- Define o idioma da página como português do Brasil -->
<head>
    <meta charset="UTF-8"> <!-- Define a codificação de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsividade em dispositivos móveis -->
    <title>Biblioteca Virtual KCP</title> <!-- Título exibido na aba do navegador -->

    <!-- Importa o CSS do Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Importa um arquivo CSS personalizado -->
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <!-- Barra de navegação (menu superior) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary"> <!-- Navbar expansível, tema escuro e cor primária -->
        <div class="container"> <!-- Container centralizado -->
            
            <!-- Logo e título do sistema -->
            <a class="navbar-brand fw-bold" href="index.php">📚 KCP Biblioteca</a>

            <!-- Botão que aparece em telas pequenas para abrir/fechar o menu -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> <!-- Ícone do menu (três risquinhos) -->
            </button>

            <!-- Itens do menu -->
            <div class="collapse navbar-collapse" id="navbarNav"> <!-- Menu recolhível -->
                <ul class="navbar-nav ms-auto"> <!-- Lista de links alinhada à direita -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a> <!-- Link para página inicial -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?acao=listarAutores">Autores</a> <!-- Link para autores -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?acao=regras">Regras da Biblioteca</a> <!-- Link para regras -->
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="container mt-4"> <!-- Container centralizado com margem superior -->
