<?php
// Configura os cookie para morrer "teoricamente" ao fechar o browser
session_set_cookie_params(0, '/');

// Inicia a sessão se não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// --- SEGURANÇA DE TEMPO (30 Minutos de inatividade) ---
$tempo_limite = 1800;
if (isset($_SESSION['ultimo_acesso'])) {
    $tempo_transcorrido = time() - $_SESSION['ultimo_acesso'];
    if ($tempo_transcorrido > $tempo_limite) {
        session_unset();
        session_destroy();
        // Redireciona para o login com mensagem de erro
        header("Location: conta.php?erro=sessao_expirada");
        exit;
    }
}
$_SESSION['ultimo_acesso'] = time();

// --- CONEXÃO À BASE DE DADOS ---
$db_host = '127.0.0.1';
$db_name = 'web2';
$db_user = 'root';
$db_pass = '';

try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão ao sistema.");
}

// Isto garante que todas as páginas que usam connection.php estão protegidas
require_once('seguranca.php');
?>