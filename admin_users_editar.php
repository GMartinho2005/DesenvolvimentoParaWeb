<?php
require('includes/connection.php');

if (!isset($_GET['id'])) { header("Location: admin_users.php"); exit; }
$id = (int)$_GET['id'];

// Buscar dados atuais
$stmt = $dbh->prepare("SELECT * FROM utilizador WHERE id = :id");
$stmt->execute([':id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if(!$user) die("Utilizador não encontrado.");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome_utilizador'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Se escreveu password nova, atualiza tudo. Se não, atualiza só dados.
    if (!empty($pass)) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE utilizador SET nome_utilizador = :nome, email = :email, password_hash = :pass WHERE id = :id";
        $params = [':nome' => $nome, ':email' => $email, ':pass' => $hash, ':id' => $id];
    } else {
        $sql = "UPDATE utilizador SET nome_utilizador = :nome, email = :email WHERE id = :id";
        $params = [':nome' => $nome, ':email' => $email, ':id' => $id];
    }

    $stmtUpd = $dbh->prepare($sql);
    if ($stmtUpd->execute($params)) {
        header("Location: admin_users.php?msg=editado");
        exit;
    } else {
        $erro = "Erro ao atualizar.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Editar Utilizador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5" style="max-width: 600px;">
    <h2 class="mb-4">Editar Utilizador #<?php echo $user['id']; ?></h2>
    <?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">
        <div class="mb-3">
            <label class="form-label fw-bold">Nome de Utilizador</label>
            <input type="text" name="nome_utilizador" class="form-control" value="<?php echo htmlspecialchars($user['nome_utilizador']); ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Nova Password</label>
            <input type="password" name="password" class="form-control" placeholder="Deixe em branco para manter a atual">
            <div class="form-text">Só preencha se quiser alterar a password do utilizador.</div>
        </div>
        <div class="d-flex justify-content-between">
            <a href="admin_users.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary px-5">Gravar Alterações</button>
        </div>
    </form>
</div>
</body>
</html>