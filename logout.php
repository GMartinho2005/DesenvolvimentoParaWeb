<?php
session_start();

// 1. Limpar a Sessão no Servidor (PHP)
$_SESSION = array();

// Apagar o cookie da sessão
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir a sessão
session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>A sair...</title>
</head>
<body>
    <script>
        // Remove a chave que mantinha a sessão viva nesta aba
        sessionStorage.removeItem('sessao_ativa');
        
        // Manda de volta para o login
        window.location.href = 'index.php';
    </script>
</body>
</html>