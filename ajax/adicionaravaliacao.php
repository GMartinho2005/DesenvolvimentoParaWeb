<?php
header('Content-Type: application/json');

// Caminho para a conexão
require('../includes/connection.php');

// 1. Verificar Login
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => 'Precisas de estar logado.']);
    exit;
}

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$livro_id = isset($data['livro_id']) ? (int)$data['livro_id'] : 0;
$estrelas = isset($data['estrelas']) ? (int)$data['estrelas'] : 0;

// 2. Obter ID do Utilizador
$user_id = 0;
if (isset($_SESSION['id'])) $user_id = $_SESSION['id'];
elseif (isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
elseif (isset($_SESSION['uid'])) $user_id = $_SESSION['uid'];

// Fallback: buscar ID pelo username se não estiver na sessão
if ($user_id == 0 && isset($_SESSION['username'])) {
    try {
        $stmtUser = $dbh->prepare("SELECT id FROM users WHERE username = ?");
        $stmtUser->execute([$_SESSION['username']]);
        if ($row = $stmtUser->fetchObject()) {
            $user_id = $row->id;
        }
    } catch (Exception $e) {}
}

// 3. Processar Avaliação
if ($livro_id > 0 && $estrelas >= 1 && $estrelas <= 5 && $user_id > 0) {
    try {
        // --- VERIFICAR DUPLICADO ---
        $check = $dbh->prepare("SELECT id FROM avaliacoes WHERE user_id = ? AND livro_id = ?");
        $check->execute([$user_id, $livro_id]);
        
        if($check->rowCount() > 0) {
             echo json_encode(['success' => false, 'message' => 'Já avaliou este livro anteriormente!']);
             exit;
        }
        // ---------------------------

        $sql = "INSERT INTO avaliacoes (livro_id, user_id, estrelas) VALUES (:lid, :uid, :est)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':lid', $livro_id);
        $stmt->bindValue(':uid', $user_id);
        $stmt->bindValue(':est', $estrelas);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao guardar na BD.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Erro SQL: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos ou erro de sessão.']);
}
exit;
?>