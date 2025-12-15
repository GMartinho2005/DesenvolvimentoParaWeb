<?php
header('Content-Type: application/json');
require('../includes/connection.php');

// Verificar Login
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Sessão expirada.']);
    exit;
}

// Receber dados
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$livro_id = isset($data['livro_id']) ? (int)$data['livro_id'] : 0;

// Obter ID do User
$user_id = 0;
if (isset($_SESSION['id'])) $user_id = $_SESSION['id'];
elseif (isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
elseif (isset($_SESSION['uid'])) $user_id = $_SESSION['uid'];

if ($user_id == 0 && isset($_SESSION['username'])) {
    try {
        $s = $dbh->prepare("SELECT id FROM users WHERE username = ?");
        $s->execute([$_SESSION['username']]);
        if ($r = $s->fetchObject()) $user_id = $r->id;
    } catch (Exception $e) {}
}

if ($livro_id > 0 && $user_id > 0) {
    try {
        // Mudar o 'ativo' para 0 (removido logicamente)
        $sql = "UPDATE favoritos SET ativo = 0 WHERE user_id = :uid AND livro_id = :lid";
        
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':uid', $user_id);
        $stmt->bindValue(':lid', $livro_id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Removido com sucesso.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao remover.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erro SQL: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
}
exit;
?>