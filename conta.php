<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_submit'])) {

    // --- Configuração da Base de Dados ---
    $db_host = '127.0.0.1';
    $db_name = 'web2';
    $db_user = 'root';
    $db_pass = '';

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Erro de conexão
        $_SESSION['login_error'] = "Erro de sistema. Tente mais tarde.";
        header("Location: conta.php");
        exit;
    }

    // --- Obter dados do formulário ---
    $login_identifier = $_POST['login_email_or_user'];
    $login_password = $_POST['login_password'];
    $error = null;

    // --- Encontrar o utilizador (por email OU nome_utilizador) ---
    try {
        $sql = "SELECT * FROM utilizador WHERE email = ? OR nome_utilizador = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login_identifier, $login_identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // --- Verificar a Password ---
        if ($user && password_verify($login_password, $user['password_hash'])) {
            // SUCESSO! Password está correta!

            // Regenera o ID da sessão por segurança
            session_regenerate_id(true);

            // Guarda os dados do utilizador na sessão
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nome_utilizador'];

            // Redireciona para a página principal (ou um 'dashboard')
            header("Location: index.php");
            exit;

        } else {
            // Falha no login (utilizador não encontrado ou password errada)
            $error = "Nome de utilizador ou password incorretos.";
        }

    } catch (PDOException $e) {
        $error = "Erro no servidor. Tente novamente.";
    }

    // Se houve um erro, guarda na sessão e recarrega a página
    if ($error) {
        $_SESSION['login_error'] = $error;
        header("Location: conta.php");
        exit;
    }
}


if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); 
}

if (isset($_SESSION['login_error'])) {
    $error_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']); 
}

?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta - Letrário Coimbra</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="css/log.css">
</head>
<body >

    <div class="login-wrapper">
        
        <div class="card login-card shadow-lg">
            
            <div class="card-header bg-white text-center py-3 position-relative">
    
                <a href="index.php">
                    <img src="imgs/Design sem nome.png" class="logo" style="height: 100px;">
                </a>
                
                <a href="#" onclick="history.back(); return false;" class="position-absolute top-0 end-0 p-3 fs-4 text-secondary" style="line-height: 1;">
                    <i class="bi bi-x-lg"></i>
                </a>

            </div>
            
            <div class="card-body p-4 p-md-5">

                <?php
                if (isset($success_message)) {
                    echo '<div class="alert alert-success" role="alert">' . htmlspecialchars($success_message) . '</div>';
                }
                
                if (isset($error_message)) {
                    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error_message) . '</div>';
                }
                ?>

                <div class="row g-5">
                    
                    <div class="col-md-6 border-end-md">
                        <h5 class="fw-bold mb-3">Se já está registado no nosso site</h5>
                        

                        <form action="conta.php" method="POST">
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label visually-hidden">Login</label>
                                
                                <input type="text" class="form-control" id="loginEmail" name="login_email_or_user" placeholder="Login (e-mail ou utilizador)" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label visually-hidden">Password</label>
                                
                                <input type="password" class="form-control" id="loginPassword" name="login_password" placeholder="Password" required>
                            </div>
                            
                            <div class="d-grid gap-2">
                               
                                <button type="submit" name="login_submit" class="btn btn-dark fw-bold text-uppercase">Entrar</button>
                                <a href="#" class="btn btn-outline-dark text-uppercase">Recuperar Password</a>
                            </div>
                            <div class="text-center mt-3">
                                <a href="ajuda.php" class="text-muted small text-decoration-none">
                                    <i class="bi bi-question-circle"></i> Ajuda
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Se ainda não está registado</h5>
                        <p class="small text-muted">Registe-se em menos de 1 minuto. Crie uma nova conta e comece a sua jornada literária no Letrário Coimbra.</p>
                        <p class="small text-muted">Ao criar a sua conta, terá acesso a funcionalidades como listas de leitura e histórico.</p>
                        
                        <div class="d-grid mt-4">
                            <a href="registo.php" class="btn btn-dark fw-bold text-uppercase">Registar</a>
                        </div>

                        <div class="mt-4">
                            <h6 class="fw-bold small">Segurança</h6>
                            <p class="small text-muted">Garantimos a segurança e confidencialidade dos seus dados.</p>
                        </div>
                    </div>

                </div>
            </div> 
        </div> 
    </div> 
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>