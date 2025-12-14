<?php
require('includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome_utilizador'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Validar se email ou user já existem
    $stmtCheck = $dbh->prepare("SELECT id FROM utilizador WHERE email = ? OR nome_utilizador = ?");
    $stmtCheck->execute([$email, $nome]);
    
    if($stmtCheck->rowCount() > 0) {
        $erro = "Esse email ou nome de utilizador já existe.";
    } else {
        // Encriptar Password
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO utilizador (nome_utilizador, email, password_hash, data_registo, ativo) 
                VALUES (:nome, :email, :pass, NOW(), 1)";
        $stmt = $dbh->prepare($sql);
        
        if ($stmt->execute([':nome' => $nome, ':email' => $email, ':pass' => $hash])) {
            header("Location: admin_users.php?msg=criado");
            exit;
        } else {
            $erro = "Erro ao criar utilizador.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Utilizador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5" style="max-width: 600px;">
    <h2 class="mb-4">Criar Novo Utilizador</h2>
    <?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label fw-bold">Nome de Utilizador</label>
            <input type="text" name="nome_utilizador" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="d-flex justify-content-between">
            <a href="admin_users.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success px-5">Criar Conta</button>
        </div>
    </form>
</div>
</body>
</html>