<?php
session_start();

// 1. SE O UTILIZADOR JÁ ESTIVER LOGADO
if (isset($_SESSION['username'])) {
    // Verifica se há um link de retorno
    $voltar = $_REQUEST['voltar'] ?? ''; 
    
    if (!empty($voltar)) {
        header("Location: " . $voltar);
    } else {
        header("Location: index.php");
    }
    exit;
}

// 2. PROCESSAR O LOGIN
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_submit'])) {

    // Configuração da BD
    $db_host = '127.0.0.1';
    $db_name = 'web2';
    $db_user = 'root';
    $db_pass = '';

    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $_SESSION['login_error'] = "Erro de conexão à base de dados.";
        header("Location: conta.php");
        exit;
    }

    $login_identifier = $_POST['login_email_or_user'];
    $login_password = $_POST['login_password'];
    $error = null;

    try {
        $sql = "SELECT * FROM utilizador WHERE email = ? OR nome_utilizador = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login_identifier, $login_identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a Password
        if ($user && password_verify($login_password, $user['password_hash'])) {

           if ($user['ativo'] == 0) {
                $error = "Esta conta foi desativada ou removida.";
            } else {
                // Sessão OK - Login com Sucesso
                session_regenerate_id(true);
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['nome_utilizador'];
                $_SESSION['ultimo_acesso'] = time();

                // Define destino
                $destino = 'index.php';
                if(isset($_POST['voltar']) && !empty($_POST['voltar'])) {
                    $destino = $_POST['voltar'];
                }

                // Redirecionamento
                echo '<!DOCTYPE html><html><body><script>';
                echo "sessionStorage.setItem('sessao_ativa', '1');";
                echo "window.location.href = '" . $destino . "';";
                echo '</script></body></html>';
                exit;
            }

        } else {
            $error = "Dados incorretos.";
        }

    } catch (PDOException $e) {
        $error = "Erro no servidor: " . $e->getMessage();
    }

    if ($error) {
        $_SESSION['login_error'] = $error;
        
        // Se falhou, mantemos o link de voltar na URL para tentar de novo
        $qs = "";
        if(isset($_POST['voltar']) && !empty($_POST['voltar'])) {
             $qs = "?voltar=" . urlencode($_POST['voltar']);
        }
        header("Location: conta.php" . $qs);
        exit;
    }
}

// Gestão de mensagens
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); 
}
if (isset($_SESSION['login_error'])) {
    $error_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']); 
}
if (isset($_GET['erro']) && $_GET['erro'] == 'sessao_expirada') {
    $error_message = "A sua sessão expirou.";
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
                        <h5 class="fw-bold mb-3">Se já está registado</h5>
                        
                        <form action="conta.php" method="POST">
                            <?php if(isset($_GET['voltar'])): ?>
                                <input type="hidden" name="voltar" value="<?php echo htmlspecialchars($_GET['voltar']); ?>">
                            <?php endif; ?>

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
                                <button type="button" class="btn btn-outline-dark text-uppercase" data-bs-toggle="modal" data-bs-target="#modalRecuperar">
                                    Recuperar Password
                                </button>
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

    <div class="modal fade" id="modalRecuperar" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
          <div class="modal-header border-0">
            <h5 class="modal-title fw-bold">Recuperar Acesso</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="text-muted small mb-4">Confirme os seus dados para definir uma nova password.</p>
            
            <form id="formRecuperar" onsubmit="event.preventDefault(); processarRecuperacao();">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nome de Utilizador</label>
                    <input type="text" id="rec_user" class="form-control bg-light border-0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Email Associado</label>
                    <input type="email" id="rec_email" class="form-control bg-light border-0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Nova Password</label>
                    <input type="password" id="rec_nova_pass" class="form-control bg-light border-0" placeholder="Mínimo 6 caracteres" required minlength="6">
                </div>
                
                <div id="rec_feedback" class="text-center small mb-3 fw-bold"></div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark rounded-pill">Redefinir Password</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
            
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    function processarRecuperacao() {
        const user = document.getElementById('rec_user').value;
        const email = document.getElementById('rec_email').value;
        const novaPass = document.getElementById('rec_nova_pass').value;
        const feedback = document.getElementById('rec_feedback');

        feedback.innerText = "A processar...";
        feedback.className = "text-center small mb-3 fw-bold text-muted";

        fetch('ajax/recuperarpassword.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ user: user, email: email, nova_pass: novaPass })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                feedback.className = "text-center small mb-3 fw-bold text-success";
                feedback.innerText = data.message;
                setTimeout(() => {
                    document.getElementById('formRecuperar').reset();
                    const modal = bootstrap.Modal.getInstance(document.getElementById('modalRecuperar'));
                    modal.hide();
                    feedback.innerText = "";
                }, 2000);
            } else {
                feedback.className = "text-center small mb-3 fw-bold text-danger";
                feedback.innerText = data.message;
            }
        })
        .catch(err => {
            console.error(err);
            feedback.className = "text-center small mb-3 fw-bold text-danger";
            feedback.innerText = "Erro de conexão.";
        });
    }
    </script>

</body>
</html>