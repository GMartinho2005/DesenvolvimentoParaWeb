<?php
header('Content-Type: application/json');
require('../includes/connection.php');

// Receber Dados
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$passAtual = $data['pass_atual'] ?? '';
$passNova = $data['pass_nova'] ?? '';
$passConfirmar = $data['pass_confirmar'] ?? '';

// Validações
if (empty($passAtual) || empty($passNova) || empty($passConfirmar)) {
    echo json_encode(['success' => false, 'message' => 'Preenche todos os campos.']);
    exit;
}

// --- NOVA VALIDAÇÃO ---
if ($passAtual === $passNova) {
    echo json_encode(['success' => false, 'message' => 'A nova password não pode ser igual à antiga.']);
    exit;
}

if ($passNova !== $passConfirmar) {
    echo json_encode(['success' => false, 'message' => 'A nova password e a confirmação não coincidem.']);
    exit;
}

if (strlen($passNova) < 6) { 
    echo json_encode(['success' => false, 'message' => 'A password é demasiado curta.']);
    exit;
}

try {
    // Procurar Password Atual na BD
    $stmt = $dbh->prepare("SELECT id, password_hash FROM utilizador WHERE nome_utilizador = ?");
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Utilizador não encontrado.']);
        exit;
    }

    // Verificar a Hash da password antiga
    if (!password_verify($passAtual, $user['password_hash'])) {
        echo json_encode(['success' => false, 'message' => 'A password atual está incorreta.']);
        exit;
    }

    // Atualizar Password
    $novaHash = password_hash($passNova, PASSWORD_DEFAULT);
    
    $update = $dbh->prepare("UPDATE utilizador SET password_hash = ? WHERE id = ?");
    
    if ($update->execute([$novaHash, $user['id']])) {
        echo json_encode(['success' => true, 'message' => 'Password alterada com sucesso!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao gravar na base de dados.']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro de sistema: ' . $e->getMessage()]);
}
?>