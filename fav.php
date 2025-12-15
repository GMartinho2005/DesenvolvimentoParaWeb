<?php
require('includes/connection.php');

// Verifica Login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Os Meus Favoritos - Letrário Coimbra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">    
    <link rel="stylesheet" href="css/outraspag.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-white">
    
    <?php 
    if(file_exists('includes/headerlog.php')) {
        require('includes/headerlog.php');
    } else {
        require('includes/header.php'); 
    }
    ?>
 
    <main class="container my-5 flex-grow-1">
        <h1 class="display-6 fw-bold mb-4 text-dark">
            <i class="text-danger"></i> Os Meus Livros Favoritos
        </h1>

        <?php
        // Obter ID do User
        $user_id = 0;
        if (isset($_SESSION['id'])) $user_id = $_SESSION['id'];
        elseif (isset($_SESSION['user_id'])) $user_id = $_SESSION['user_id'];
        elseif (isset($_SESSION['uid'])) $user_id = $_SESSION['uid'];

        if($user_id == 0 && isset($_SESSION['username'])) {
            $s = $dbh->prepare("SELECT id FROM users WHERE username = ?");
            $s->execute([$_SESSION['username']]);
            if($r = $s->fetchObject()) $user_id = $r->id;
        }

        // BUSCAR DADOS COMPLETOS DOS FAVORITOS
        $sql = "SELECT l.id, l.titulo, l.autor, l.imagem_capa 
        FROM favoritos f
        JOIN livros l ON f.livro_id = l.id
        WHERE f.user_id = :uid 
          AND f.ativo = 1 
          AND l.ativo = 1  
        ORDER BY f.id DESC";
                
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':uid', $user_id);
        $stmt->execute();
        $favoritos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <?php if (count($favoritos) > 0): ?>
            <div class="row row-cols-2 row-cols-md-4 g-4" id="lista-favoritos"> 
                
                <?php foreach ($favoritos as $livro): ?>
                <div class="col" id="card-livro-<?php echo $livro['id']; ?>"> 
                    <div class="card h-100 border-0 shadow-sm book-card position-relative"> 
                        
                        <button onclick="prepararRemocao(<?php echo $livro['id']; ?>)" class="btn btn-light text-danger position-absolute top-0 start-0 m-2 rounded-circle shadow-sm border" style="z-index: 10;" title="Remover dos favoritos">
                            <i class="bi bi-trash-fill"></i>
                        </button>

                        <div class="overflow-hidden rounded-top position-relative">
                            <a href="livro.php?id=<?php echo $livro['id']; ?>">
                                <img src="<?php echo htmlspecialchars($livro['imagem_capa']); ?>" class="card-img-top object-fit-cover" style="aspect-ratio: 2/3; width: 100%;" alt="Capa">
                            </a>
                            
                            <span class="position-absolute top-0 end-0 bg-danger text-white p-2 rounded-bottom-start">
                                <i class="bi bi-heart-fill"></i>
                            </span>
                        </div>
                        
                        <div class="card-body text-center d-flex flex-column justify-content-between">
                            <div>
                                <h6 class="card-title fw-bold mb-1 text-dark">
                                    <a href="livro.php?id=<?php echo $livro['id']; ?>" class="text-dark text-decoration-none">
                                        <?php echo htmlspecialchars($livro['titulo']); ?>
                                    </a>
                                </h6>
                                <p class="card-text text-muted small mb-3">
                                    <?php echo htmlspecialchars($livro['autor']); ?>
                                </p>
                            </div>
                            
                            <a href="livro.php?id=<?php echo $livro['id']; ?>" class="btn btn-outline-dark rounded-pill w-100 btn-sm fw-medium mt-2">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
            
            <div id="msg-vazio" class="text-center py-5 d-none">
                <i class="bi bi-heartbreak display-1 text-muted opacity-25"></i>
                <h3 class="mt-3 text-secondary">A tua lista ficou vazia.</h3>
                <a href="index.php" class="btn btn-dark rounded-pill mt-3 px-4">Explorar Livros</a>
            </div>

        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-heartbreak display-1 text-muted opacity-25"></i>
                <h3 class="mt-3 text-secondary">Ainda não tens favoritos.</h3>
                <p class="text-muted">Explora o catálogo e guarda os livros que mais gostas.</p>
                <a href="index.php" class="btn btn-dark rounded-pill mt-3 px-4">Explorar Livros</a>
            </div>
        <?php endif; ?>

    </main>

    <?php require('includes/footer.php'); ?>

    <div class="modal fade" id="modalConfirmar" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h5 class="modal-title fw-bold text-danger">Remover Favorito</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center py-4">
            <p class="mb-0 fs-5">Tens a certeza que queres remover este livro da tua lista?</p>
          </div>
          <div class="modal-footer border-0 justify-content-center pb-4">
            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger rounded-pill px-4" onclick="confirmarRemocaoFinal()">Sim, remover</button>
          </div>
        </div>
      </div>
    </div>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
      <div id="toastRemovido" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body fs-6">
            <i class="bi bi-trash me-2"></i> Livro removido dos favoritos.
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <script>
    let idParaRemover = 0;
    
    function prepararRemocao(idLivro) {
        idParaRemover = idLivro;
        const modal = new bootstrap.Modal(document.getElementById('modalConfirmar'));
        modal.show();
    }

    function confirmarRemocaoFinal() {
        if(idParaRemover === 0) return;

        fetch('ajax/removerfav.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ livro_id: idParaRemover })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                // Fecha Modal
                const modalEl = document.getElementById('modalConfirmar');
                const modalInstance = bootstrap.Modal.getInstance(modalEl);
                modalInstance.hide();

                // Remove Cartão
                const card = document.getElementById('card-livro-' + idParaRemover);
                if(card) {
                    card.style.transition = 'opacity 0.5s';
                    card.style.opacity = '0';
                    setTimeout(() => {
                        card.remove();
                        
                        // Verifica se a lista ficou vazia APÓS remover o elemento
                        const container = document.getElementById('lista-favoritos');
                        if(container && container.children.length === 0) { 
                            container.style.display = 'none';
                            document.getElementById('msg-vazio').classList.remove('d-none');
                        }
                    }, 500);
                }

                // Mostra Toast
                const toastEl = document.getElementById('toastRemovido');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();

            } else {
                alert("Erro: " + data.message);
            }
        })
        .catch(err => {
            console.error(err);
            alert("Erro ao comunicar com o servidor.");
        });
    }
    </script>
</body>
</html>