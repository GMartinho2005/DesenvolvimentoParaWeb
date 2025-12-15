<?php
header('Content-Type: application/json');
require('../includes/connection.php');

// Verificar Login
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Precisa de fazer login.']);
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
        // --- SOFT DELETE ---
        
        // Verificar se o registo já existe (ativo ou inativo)
        $checkSql = "SELECT id, ativo FROM favoritos WHERE user_id = :uid AND livro_id = :lid";
        $checkStmt = $dbh->prepare($checkSql);
        $checkStmt->execute([':uid' => $user_id, ':lid' => $livro_id]);
        $existente = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existente) {
            // O registo EXISTE
            if ($existente['ativo'] == 1) {
                // Já é favorito e está ativo
                echo json_encode(['success' => true, 'status' => 'exists', 'message' => 'Já está nos favoritos.']);
            } else {
                // Existe mas foi removido (ativo = 0). Vamos reativar!
                $updSql = "UPDATE favoritos SET ativo = 1 WHERE id = :id";
                $updStmt = $dbh->prepare($updSql);
                $updStmt->execute([':id' => $existente['id']]);
                echo json_encode(['success' => true, 'status' => 'added', 'message' => 'Adicionado aos favoritos.']);
            }
        } else {
            // O registo NÃO EXISTE. Criamos um novo.
            $insSql = "INSERT INTO favoritos (user_id, livro_id, ativo) VALUES (:uid, :lid, 1)";
            $insStmt = $dbh->prepare($insSql);
            $insStmt->execute([':uid' => $user_id, ':lid' => $livro_id]);
            echo json_encode(['success' => true, 'status' => 'added', 'message' => 'Adicionado aos favoritos.']);
        }

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erro SQL: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
}
exit;
?>