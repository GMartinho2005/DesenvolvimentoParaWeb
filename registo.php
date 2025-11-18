<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_submit'])) {

    // --- Configuração da Base de Dados ---
    $db_host = '127.0.0.1';
    $db_name = 'web2';
    $db_user = 'root';
    $db_pass = '';

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $_SESSION['register_error'] = "Erro de sistema. Tente mais tarde.";
        header("Location: registo.php");
        exit;
    }

    // --- Obter e Validar os Dados ---
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $error = null;

    if (empty($username) || empty($email) || empty($password)) {
        $error = "Todos os campos são obrigatórios.";
    } elseif ($password !== $confirm_password) {
        $error = "As passwords não coincidem.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Formato de e-mail inválido.";
    } elseif (strlen($password) < 6) {
        $error = "A password deve ter pelo menos 6 caracteres.";
    }

    // --- Verificar se o utilizador já existe ---
    if ($error === null) {
        try {
            $sql_check = "SELECT * FROM utilizador WHERE nome_utilizador = ? OR email = ?";
            $stmt_check = $pdo->prepare($sql_check);
            $stmt_check->execute([$username, $email]);
            
            if ($stmt_check->rowCount() > 0) {
                $error = "O nome de utilizador ou o e-mail já estão registados.";
            }
        } catch (PDOException $e) {
            $error = "Erro ao verificar utilizador. Tente novamente.";
        }
    }

    // --- Se não houver erros, encriptar e inserir ---
    if ($error === null) {
        // Encriptar (Hash) a Password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql_insert = "INSERT INTO utilizador (nome_utilizador, email, password_hash) VALUES (?, ?, ?)";
            $stmt_insert = $pdo->prepare($sql_insert);
            $stmt_insert->execute([$username, $email, $password_hash]);

            // --- SUCESSO! ---
            $_SESSION['success_message'] = "Registo efetuado com sucesso! Pode agora fazer login.";
            
            // Redireciona para conta.php
            header("Location: conta.php");
            exit; // Termina o script aqui

        } catch (PDOException $e) {
            $error = "Erro ao criar a conta. Por favor, tente novamente.";
        }
    }

    // --- Se houve algum erro, guarda na sessão e recarrega ---
    if ($error !== null) {
        $_SESSION['register_error'] = $error;
        header("Location: registo.php");
        exit;
    }
}

if (isset($_SESSION['register_error'])) {
    $error_message = $_SESSION['register_error'];
    unset($_SESSION['register_error']);
}

?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Letrário Coimbra</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/log.css"> 
</head>
<body style="background-image: url('../imgs/a-warm-cinematic-photograph-of-weathered_KZWDuYg5SuOiq4z52l4tiQ_kiSEf0_HQTOWaHDJq9L7Vg.jpeg'); background-size: cover; background-position: center; background-repeat: no-repeat;">

    <div class="login-wrapper">
        <div class="card login-card shadow-lg" style="max-width: 500px;"> 
            
            <div class="card-header bg-white text-center py-3 position-relative">
                <a href="index.php">
                    <img src="imgs/Design sem nome.png" class="logo" style="height: 100px;">
                </a>
                <a href="#" onclick="history.back(); return false;" class="position-absolute top-0 end-0 p-3 fs-4 text-secondary" style="line-height: 1;">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            
            <div class="card-body p-4 p-md-5">
                <h5 class="fw-bold mb-3 text-center">Criar nova conta</h5>
                
                <?php
                if (isset($error_message)) {
                    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error_message) . '</div>';
                }
                ?>

                <form action="registo.php" method="POST">
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome de utilizador</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password (mín. 6 caracteres)</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" name="register_submit" class="btn btn-dark fw-bold text-uppercase">Registar</button>
                        <a href="conta.php" class="btn btn-outline-dark text-uppercase">Já tenho conta</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>