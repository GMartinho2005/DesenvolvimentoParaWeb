<?php
// ajax/recuperarpassword.php
header('Content-Type: application/json');
require('../includes/connection.php');

// Receber dados JSON
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$user = $data['user'] ?? '';
$email = $data['email'] ?? '';
$novaPass = $data['nova_pass'] ?? '';

// 1. Validações Básicas
if (empty($user) || empty($email) || empty($novaPass)) {
    echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos.']);
    exit;
}

if (strlen($novaPass) < 6) {
    echo json_encode(['success' => false, 'message' => 'A nova password é demasiado curta.']);
    exit;
}

try {
    // 2. Verificar se existe este par (User + Email)
    // Isto serve como "prova" de identidade simplificada
    $stmt = $dbh->prepare("SELECT id FROM utilizador WHERE nome_utilizador = ? AND email = ?");
    $stmt->execute([$user, $email]);
    $conta = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($conta) {
        // 3. Se encontrou, atualiza a password
        $novaHash = password_hash($novaPass, PASSWORD_DEFAULT);
        
        $update = $dbh->prepare("UPDATE utilizador SET password_hash = ? WHERE id = ?");
        
        if ($update->execute([$novaHash, $conta['id']])) {
            echo json_encode(['success' => true, 'message' => 'Password redefinida com sucesso!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erro ao atualizar a base de dados.']);
        }
    } else {
        // Se não encontrou correspondência
        echo json_encode(['success' => false, 'message' => 'Os dados (Utilizador/Email) não correspondem.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro de sistema: ' . $e->getMessage()]);
}
?>