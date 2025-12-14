<?php
require('includes/connection.php');

// --- LÓGICA DE REMOVER (SOFT DELETE) ---
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_remover = (int)$_GET['id'];
    
    // Atualiza o 'ativo' para 0 (Soft Delete)
    $sqlDel = "UPDATE livros SET ativo = 0 WHERE id = :id";
    $stmtDel = $dbh->prepare($sqlDel);
    $stmtDel->bindValue(':id', $id_remover);
    
    if($stmtDel->execute()) {
        $msg = "Livro removido com sucesso!";
    } else {
        $erro = "Erro ao remover livro.";
    }
}

// --- BUSCAR LIVROS ATIVOS ---
$sql = "SELECT * FROM livros WHERE ativo = 1 ORDER BY id DESC";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Administração - Livros</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
      <div class="container">
        <span class="navbar-brand mb-0 h1">Painel Admin - Letrário</span>
        <a href="index.php" class="btn btn-outline-light btn-sm">Voltar ao Site</a>
      </div>
    </nav>

    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Gestão de Livros</h2>
            <div>
                <a href="admin_users.php" class="btn btn-primary me-2">
                    <i class="bi bi-people-fill"></i> Gerir Utilizadores
                </a>
                
                <a href="admin_adicionar.php" class="btn btn-success">
                    <i class="bi bi-plus-lg"></i> Adicionar Novo Livro
                </a>
            </div>
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
                                <th scope="col">Capa</th>
                                <th scope="col">Título</th>
                                <th scope="col">Autor</th>
                                <th scope="col">ISBN</th>
                                <th scope="col" class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($livros) > 0): ?>
                                <?php foreach($livros as $livro): ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?php echo $livro['id']; ?></td>
                                    
                                    <td>
                                        <?php if(!empty($livro['imagem_capa'])): ?>
                                            <img src="<?php echo htmlspecialchars($livro['imagem_capa']); ?>" style="height: 50px; width: auto; border-radius: 4px;">
                                        <?php else: ?>
                                            <span class="text-muted small">Sem capa</span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="fw-semibold"><?php echo htmlspecialchars($livro['titulo']); ?></td>
                                    
                                    <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                                    
                                    <td><span class="badge bg-secondary"><?php echo htmlspecialchars($livro['isbn']); ?></span></td>
                                    
                                    <td class="text-end pe-4">
                                        <a href="admin_editar.php?id=<?php echo $livro['id']; ?>" class="btn btn-sm btn-primary me-1" title="Editar">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <button type="button" 
                                                class="btn btn-sm btn-danger" 
                                                title="Remover"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalRemover"
                                                data-href="admin.php?action=delete&id=<?php echo $livro['id']; ?>">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        Não há livros ativos. Adiciona um novo!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalRemover" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered"> <div class="modal-content">
          <div class="modal-header border-0 pb-0">
            <h5 class="modal-title fw-bold text-danger">Remover Livro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center py-4">
            <i class="bi bi-exclamation-circle text-warning display-1 mb-3"></i>
            <p class="fs-5 mb-0">Tem a certeza que quer remover este livro?</p>
            <p class="text-muted small">Ele deixará de aparecer!</p>
          </div>
          <div class="modal-footer border-0 justify-content-center pt-0 pb-4">
            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Cancelar</button>
            <a href="#" class="btn btn-danger px-4 fw-bold" id="btnConfirmarRemover">Sim, Remover</a>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const modalRemover = document.getElementById('modalRemover');
        modalRemover.addEventListener('show.bs.modal', event => {
            // Botão que acionou o modal
            const button = event.relatedTarget;
            // Extrair o link do atributo data-href
            const linkApagar = button.getAttribute('data-href');
            // Encontrar o botão de confirmar dentro do modal
            const btnConfirmar = modalRemover.querySelector('#btnConfirmarRemover');
            // Atualizar o href do botão de confirmar
            btnConfirmar.setAttribute('href', linkApagar);
        });
    </script>

</body>
</html>