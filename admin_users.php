<?php
require('includes/connection.php');

// --- LÓGICA DE AÇÕES (REMOVER e REATIVAR) ---

// REMOVER (Soft Delete -> ativo = 0)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_user = (int)$_GET['id'];
    
    if(isset($_SESSION['user_id']) && $id_user == $_SESSION['user_id']) {
        $erro = "Não podes remover a tua própria conta!";
    } else {
        $stmt = $dbh->prepare("UPDATE utilizador SET ativo = 0 WHERE id = :id");
        if($stmt->execute([':id' => $id_user])) {
            $msg = "Utilizador desativado com sucesso.";
        } else {
            $erro = "Erro ao desativar.";
        }
    }
}

// Ação: REATIVAR (ativo = 1)
if (isset($_GET['action']) && $_GET['action'] == 'activate' && isset($_GET['id'])) {
    $id_user = (int)$_GET['id'];
    
    $stmt = $dbh->prepare("UPDATE utilizador SET ativo = 1 WHERE id = :id");
    if($stmt->execute([':id' => $id_user])) {
        $msg = "Utilizador reativado com sucesso!";
    } else {
        $erro = "Erro ao reativar.";
    }
}

// --- BUSCAR TODOS OS UTILIZADORES (ATIVOS E INATIVOS) ---
$sql = "SELECT * FROM utilizador ORDER BY ativo DESC, id DESC";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Administração - Utilizadores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
      <div class="container">
        <span class="navbar-brand mb-0 h1">Painel Admin - Letrário</span>
        <a href="admin.php" class="btn btn-outline-light btn-sm">Voltar aos Livros</a>
      </div>
    </nav>

    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestão de Utilizadores</h2>
            <a href="admin_users_adicionar.php" class="btn btn-success">
                <i class="bi bi-person-plus-fill"></i> Criar Utilizador
            </a>
        </div>

        <?php if(isset($msg)): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?php echo $msg; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(isset($erro)): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <?php echo $erro; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">ID</th>
                                <th scope="col">Estado</th> <th scope="col">Nome Utilizador</th>
                                <th scope="col">Email</th>
                                <th scope="col">Data Registo</th>
                                <th scope="col" class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($users) > 0): ?>
                                <?php foreach($users as $user): ?>
                                    
                                    <tr class="<?php echo ($user['ativo'] == 0) ? 'table-secondary text-muted' : ''; ?>">
                                        
                                        <td class="ps-4 fw-bold">#<?php echo $user['id']; ?></td>
                                        
                                        <td>
                                            <?php if($user['ativo'] == 1): ?>
                                                <span class="badge bg-success">Ativo</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Inativo</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="fw-semibold"><?php echo htmlspecialchars($user['nome_utilizador']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><?php echo htmlspecialchars($user['data_registo']); ?></td>
                                        
                                        <td class="text-end pe-4">
                                            
                                            <a href="admin_users_editar.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary me-1" title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                            <?php if($user['ativo'] == 1): ?>
                                                
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger" 
                                                        title="Desativar Conta"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#modalAcao"
                                                        data-href="admin_users.php?action=delete&id=<?php echo $user['id']; ?>"
                                                        data-msg="Tem a certeza que quer desativar este utilizador?">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>

                                            <?php else: ?>
                                                
                                                <a href="admin_users.php?action=activate&id=<?php echo $user['id']; ?>" 
                                                   class="btn btn-sm btn-success" 
                                                   title="Reativar Conta">
                                                    <i class="bi bi-arrow-counterclockwise"></i>
                                                </a>

                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">Não há utilizadores registados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalAcao" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0 pb-0">
            <h5 class="modal-title fw-bold">Confirmação</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center py-4">
            <i class="bi bi-exclamation-circle text-warning display-1 mb-3"></i>
            <p class="fs-5 mb-0" id="modalMsgBody">Tem a certeza?</p>
          </div>
          <div class="modal-footer border-0 justify-content-center pt-0 pb-4">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
            <a href="#" class="btn btn-danger px-4 fw-bold" id="btnConfirmarAcao">Sim</a>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modalAcao = document.getElementById('modalAcao');
        modalAcao.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const link = button.getAttribute('data-href');
            const msg = button.getAttribute('data-msg');
            
            // Atualiza o link e a mensagem do modal
            modalAcao.querySelector('#btnConfirmarAcao').setAttribute('href', link);
            modalAcao.querySelector('#modalMsgBody').innerText = msg;
        });
    </script>
</body>
</html>