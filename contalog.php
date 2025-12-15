<?php
require('includes/connection.php');

// --- VERIFICAÇÃO DE SEGURANÇA ROBUSTA ---
// Verifica se existe username OU id. Se faltar ambos, manda para o login.
if (empty($_SESSION['username']) && empty($_SESSION['user_id']) && empty($_SESSION['id'])) {
    header("Location: conta.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Minha Conta - Letrário Coimbra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">    
    <link rel="stylesheet" href="css/outraspag.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    
    <?php 
    if(file_exists('includes/headerlog.php')) {
        require('includes/headerlog.php');
    } else {
        require('includes/header.php'); 
    }
    ?>
 
    <main class="container my-5 flex-grow-1">
        
        <?php
        // --- OBTENÇÃO DE DADOS SEGURA ---
        
        // Definir variáveis padrão para evitar erros de "Undefined"
        $nomeUser = 'Utilizador';
        $emailUser = 'Email não disponível';
        
        // Tentar obter o identificador da sessão de forma segura
        $sessionUser = $_SESSION['username'] ?? ''; 

        if (!empty($sessionUser)) {
            try {
                // Buscar dados à BD
                $stmt = $dbh->prepare("SELECT nome_utilizador, email FROM utilizador WHERE nome_utilizador = ?");
                $stmt->execute([$sessionUser]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user) {
                    $nomeUser = $user['nome_utilizador'];
                    $emailUser = $user['email'];
                } else {
                    // Se não encontrar na BD, usa o da sessão
                    $nomeUser = $sessionUser;
                }
            } catch (Exception $e) {
                // Em caso de erro SQL, mantém os valores padrão
            }
        }
        ?>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card border-0 shadow-sm rounded-4 mt-5">
                    <div class="card-body p-5 text-center">
                        
                        <h2 class="fw-bold text-dark mb-1"><?php echo htmlspecialchars($nomeUser ?? ''); ?></h2>
                        <p class="text-muted mb-4"><?php echo htmlspecialchars($emailUser ?? ''); ?></p>

                        <hr class="my-4 opacity-25">

                        <div class="d-grid gap-2 col-md-8 mx-auto">
                            <button class="btn btn-outline-dark rounded-pill py-2" data-bs-toggle="modal" data-bs-target="#modalPassword">
                                <i class="bi bi-key me-2"></i> Alterar Password
                            </button>
                            
                            <a href="logout.php" class="btn btn-light text-danger rounded-pill py-2 mt-2">
                                <i class="bi bi-box-arrow-right me-2"></i> Terminar Sessão
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </main>

    <?php require('includes/footer.php'); ?>

    <div class="modal fade" id="modalPassword" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
          <div class="modal-header border-0 pb-0">
            <h5 class="modal-title fw-bold ms-3 mt-2">Alterar Password</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            
            <form id="formPassword" onsubmit="event.preventDefault(); alterarPassword();">
                
                <div class="mb-3">
                    <label class="form-label small text-muted fw-bold">Password Atual</label>
                    <input type="password" id="pass_atual" class="form-control rounded-3 bg-light border-0" placeholder="Digite a password antiga" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted fw-bold">Nova Password</label>
                    <input type="password" id="pass_nova" class="form-control rounded-3 bg-light border-0" placeholder="No mínimo 6 caracteres" required minlength="6">
                </div>

                <div class="mb-3">
                    <label class="form-label small text-muted fw-bold">Confirmar Nova Password</label>
                    <input type="password" id="pass_confirmar" class="form-control rounded-3 bg-light border-0" placeholder="Repita a nova password" required>
                </div>

                <div id="msg-erro" class="text-danger small mb-3 fw-bold text-center"></div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-dark rounded-pill py-2">Guardar Alterações</button>
                </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
      <div id="toastSucesso" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body fs-6">
            <i class="bi bi-check-circle-fill me-2"></i> Password alterada com sucesso!
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <script>
    function alterarPassword() {
        const passAtual = document.getElementById('pass_atual').value;
        const passNova = document.getElementById('pass_nova').value;
        const passConfirmar = document.getElementById('pass_confirmar').value;
        const msgErro = document.getElementById('msg-erro');

        msgErro.innerText = '';
        msgErro.className = 'text-danger small mb-3 fw-bold text-center';

        if (passAtual === passNova) {
            msgErro.innerText = 'A nova password não pode ser igual à antiga.';
            return;
        }

        if (passNova !== passConfirmar) {
            msgErro.innerText = 'As novas passwords não coincidem.';
            return;
        }

        // Aponta para ajax/alterarpassword.php
        fetch('ajax/alterarpassword.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({
                pass_atual: passAtual,
                pass_nova: passNova,
                pass_confirmar: passConfirmar
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const modalEl = document.getElementById('modalPassword');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                modalInstance.hide();

                document.getElementById('formPassword').reset();

                const toastEl = document.getElementById('toastSucesso');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            } else {
                msgErro.innerText = data.message || "Erro ao alterar password.";
            }
        })
        .catch(err => {
            console.error(err);
            msgErro.innerText = "Erro de conexão com o servidor.";
        });
    }
    </script>
</body>
</html>