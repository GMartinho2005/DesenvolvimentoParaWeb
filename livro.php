<?php
require('includes/connection.php');

// Validar ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$livro_id = (int)$_GET['id'];

// QUERY PRINCIPAL
$sql = "SELECT l.*, 
               c.nome as nome_categoria, c.nome_url,
               a.nome as nome_autor, a.biografia as bio_autor,
               COUNT(av.id) as reviews, 
               COALESCE(AVG(av.estrelas), 0) as rating 
        FROM livros l
        LEFT JOIN categorias c ON l.categoria_id = c.id
        LEFT JOIN autores a ON l.autor_id = a.id
        LEFT JOIN avaliacoes av ON l.id = av.livro_id
        WHERE l.id = :id AND l.ativo = 1
        GROUP BY l.id";

$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $livro_id);
$stmt->execute();
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$livro) {
    die("Livro não encontrado.");
}

// Dados para layout
$media_exata = $livro['rating'];
$estrelas_visual = round($media_exata);
$total_reviews = $livro['reviews'];

// QUERY SECUNDÁRIA: Outros livros DO MESMO AUTOR
$sqlSugestao = "SELECT id, titulo, imagem_capa, autor_id 
                FROM livros 
                WHERE autor_id = :aid AND id != :lid AND ativo = 1
                ORDER BY RAND() LIMIT 5";

$stmtSug = $dbh->prepare($sqlSugestao);
$stmtSug->bindValue(':aid', $livro['autor_id']); 
$stmtSug->bindValue(':lid', $livro_id);          
$stmtSug->execute();
$todos_sugestao = $stmtSug->fetchAll(PDO::FETCH_ASSOC);

$mostrar_ver_todos = (count($todos_sugestao) >= 5);
$outros_livros = array_slice($todos_sugestao, 0, 4);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($livro['titulo']); ?> - Letrário Coimbra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">    
    <link rel="stylesheet" href="css/outraspag.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-white">
    
    <?php
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        require('includes/headerlog.php'); 
    } else {
        require('includes/header.php');
    }
    ?>
 
    <main class="container my-5 flex-grow-1">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-secondary">Início</a></li>
                
                <?php 
                // Captura a origem para decidir o link do meio
                $origem = $_GET['origem'] ?? '';

                if ($origem === 'novidadesnperder') {
                    // SE VIER DE NOVIDADES
                    echo '<li class="breadcrumb-item"><a href="categoria.php?tipo=novidadesnperder" class="text-decoration-none text-secondary">Novidades a Não Perder</a></li>';
                } 
                elseif ($origem === 'melhoravaliados') {
                    // SE VIER DE MELHOR AVALIADOS
                    echo '<li class="breadcrumb-item"><a href="categoria.php?tipo=melhoravaliados" class="text-decoration-none text-secondary">Melhor Avaliados</a></li>';
                } 
                elseif ($origem === 'foco') {
                    // SE VIER DE FOCO (Não mostra categoria intermédia, só inicio > livro)
                } 
                else {
                    // SE VIER DE UMA CATEGORIA NORMAL
                    ?>
                    <li class="breadcrumb-item">
                        <a href="categoria.php?tipo=<?php echo htmlspecialchars($livro['nome_url'] ?? 'ficcao'); ?>" class="text-decoration-none text-secondary">
                            <?php echo htmlspecialchars($livro['nome_categoria'] ?? 'Geral'); ?>
                        </a>
                    </li> 
                    <?php 
                } 
                ?>
                
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">
                    <?php echo htmlspecialchars($livro['titulo']); ?>
                </li> 
            </ol>
        </nav>

        <div class="row gx-lg-5 gy-4"> 
            
            <div class="col-12 col-md-4 col-lg-3 text-center"> 
                <img src="<?php echo htmlspecialchars($livro['imagem_capa']); ?>" class="img-fluid rounded shadow w-100 object-fit-cover" style="max-width: 300px;" alt="Capa do livro">
            </div>

            <div class="col-12 col-md-8 col-lg-9 ps-md-4"> 
                <h1 class="display-5 fw-bold mb-2 text-dark"><?php echo htmlspecialchars($livro['titulo']); ?></h1>
                <p class="h5 mb-3 text-secondary">de <a href="#sobre-autor" class="link-danger text-decoration-none fw-bold"><?php echo htmlspecialchars($livro['nome_autor'] ?? 'Autor Desconhecido'); ?></a></p>
                
                <div class="mb-3 text-warning d-flex align-items-center" title="Rating: <?php echo number_format($media_exata, 1); ?>">
                    <div class="me-2" id="box-estrelas">
                        <?php 
                        for ($i = 1; $i <= 5; $i++):
                            echo ($i <= $estrelas_visual) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                        endfor; 
                        ?>
                    </div>
                    <span class="small text-muted text-black">
                        (<span id="total-avaliacoes" data-livroid="<?php echo $livro['id']; ?>"><?php echo $total_reviews; ?></span> avaliações)
                    </span>
                </div>

                <div class="mb-4 text-muted small">
                    <p class="mb-1"><strong>Editora:</strong> <?php echo htmlspecialchars($livro['editora']); ?></p>
                    <p class="mb-0"><strong>Edição:</strong> <?php echo htmlspecialchars($livro['edicao']); ?></p>
                </div>

                <p class="text-uppercase small fw-bold mb-2 text-secondary">Formatos Disponíveis:</p>
                <div class="mb-4">
                    <span class="badge bg-secondary p-2">PDF</span>
                </div>
                
                <div class="d-grid gap-2 d-md-block">
                    <a href="pdfs/livro.html" download class="btn btn-dark btn-lg px-4 rounded-pill">Download PDF</a>
                    
                    <?php if(isset($_SESSION['username'])): ?>
                        <button type="button" class="btn btn-outline-danger btn-lg px-4 rounded-pill ms-md-2" onclick="adicionarFavorito()">
                            <i class="bi bi-heart"></i> Adicionar aos Favoritos
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-pill ms-md-2" data-bs-toggle="modal" data-bs-target="#modalAvaliacao">
                            Avaliar
                        </button>
                    <?php else: ?>
    <?php 
        // Cria o link atual para saber para onde voltar
        $link_atual = "livro.php?id=" . $livro['id'];
        
        if(isset($_GET['origem'])) {
            $link_atual .= "&origem=" . htmlspecialchars($_GET['origem']);
        }

        $link_retorno = urlencode($link_atual);
    ?>

    <a href="conta.php?voltar=<?php echo $link_retorno; ?>" class="btn btn-outline-danger btn-lg px-4 rounded-pill ms-md-2">Login para Favoritos</a>
    <a href="conta.php?voltar=<?php echo $link_retorno; ?>" class="btn btn-outline-secondary btn-lg px-4 rounded-pill ms-md-2">Login para Avaliar</a>
<?php endif; ?>
                </div>
            </div>
        </div>

        <hr class="my-5 text-secondary opacity-25">

        <div class="row mb-4"> 
            <div class="col-12">
                <h2 class="d-none d-md-block text-uppercase fw-bold mb-3">Sinopse</h2>
                
                <button class="btn btn-link text-dark text-decoration-none text-uppercase fw-bold p-0 d-flex justify-content-between w-100 d-md-none mb-2" 
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseSinopse" aria-expanded="false" aria-controls="collapseSinopse">
                    Sinopse <span class="bi bi-chevron-down"></span>
                </button>

                <div class="collapse d-md-block" id="collapseSinopse">
                    <div class="text-secondary lh-lg">
                        <?php echo nl2br(htmlspecialchars($livro['sinopse_completa'])); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5"> 
            <div class="col-12">
                <h2 class="d-none d-md-block text-uppercase fw-bold mb-3">Detalhes do Livro</h2>
                <button class="btn btn-link text-dark text-decoration-none text-uppercase fw-bold p-0 d-flex justify-content-between w-100 d-md-none mb-2" 
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseDetalhes" aria-expanded="false" aria-controls="collapseDetalhes">
                    Detalhes do Livro <span class="bi bi-chevron-down"></span>
                </button>
                <div class="collapse d-md-block" id="collapseDetalhes">
                    <div class="pt-2"> 
                         <div class="row">
                             <div class="col-md-6">
                                <ul class="list-unstyled mb-0 text-secondary">
                                    <li class="mb-2"><strong>ISBN:</strong> <?php echo htmlspecialchars($livro['isbn']); ?></li>
                                    <li class="mb-2"><strong>Edição:</strong> <?php echo htmlspecialchars($livro['edicao']); ?></li>
                                    <li class="mb-2"><strong>Páginas:</strong> <?php echo htmlspecialchars($livro['paginas']); ?></li>
                                </ul>
                             </div>
                             <div class="col-md-6">
                                 <ul class="list-unstyled mb-0 text-secondary">
                                    <li class="mb-2"><strong>Editora:</strong> <?php echo htmlspecialchars($livro['editora']); ?></li> 
                                    <li class="mb-2"><strong>Idioma:</strong> <?php echo htmlspecialchars($livro['idioma']); ?></li>
                                </ul>
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 text-secondary opacity-25">

        <div class="row mb-5" id="sobre-autor">
            <div class="col-12">
                <h2 class="text-uppercase fw-bold mb-4">Sobre o Autor</h2>
                
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-4 p-4 bg-white rounded shadow-sm border">
                                        
                    <div class="text-center text-md-start">
                        <h3 class="h4 fw-bold mb-2"><?php echo htmlspecialchars($livro['nome_autor'] ?? 'Autor Desconhecido'); ?></h3>
                        <p class="text-secondary mb-2">
                            <?php echo nl2br(htmlspecialchars($livro['bio_autor'] ?? 'Biografia não disponível.')); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-uppercase fw-bold mb-0 fs-4">Mais livros de <?php echo htmlspecialchars($livro['nome_autor']); ?></h2>
                    
                    <?php if ($mostrar_ver_todos): ?>
                    <a class="text-decoration-none text-secondary fw-semibold small" href="index.php?q=<?php echo urlencode($livro['nome_autor']); ?>">
                        Ver todos <i class="bi bi-arrow-right"></i>
                    </a>
                    <?php endif; ?>
                </div>

                <div class="row row-cols-2 row-cols-md-4 g-4"> 
                    <?php if (count($outros_livros) > 0): ?>
                        <?php foreach ($outros_livros as $sugestao): ?>
                        <div class="col"> 
                            <div class="card h-100 border-0 shadow-sm book-card"> 
                                <div class="overflow-hidden rounded-top">
                                    <?php $link_extra = isset($_GET['origem']) ? '&origem=' . htmlspecialchars($_GET['origem']) : ''; ?>
                                    <a href="livro.php?id=<?php echo $sugestao['id'] . $link_extra; ?>">
                                        <img src="<?php echo htmlspecialchars($sugestao['imagem_capa']); ?>" class="card-img-top object-fit-cover" style="aspect-ratio: 2/3; width: 100%;" alt="Capa">
                                    </a>
                                </div>
                                
                                <div class="card-body text-center d-flex flex-column justify-content-between">
                                    <div>
                                        <h6 class="card-title fw-bold mb-1 text-dark">
                                            <a href="livro.php?id=<?php echo $sugestao['id'] . $link_extra; ?>" class="text-decoration-none text-dark">
                                                <?php echo htmlspecialchars($sugestao['titulo']); ?>
                                            </a>
                                        </h6>
                                        <p class="card-text text-muted small mb-3">
                                            <?php echo htmlspecialchars($livro['nome_autor']); ?>
                                        </p>
                                    </div>
                                    
                                    <a href="livro.php?id=<?php echo $sugestao['id'] . $link_extra; ?>" class="btn btn-outline-dark rounded-pill w-100 btn-sm fw-medium mt-2">
                                        Ver mais
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted w-100 text-center">Este autor ainda não tem outros livros registados.</p>
                    <?php endif; ?>
                </div> 
            </div> 
        </div>

        <div class="modal fade" id="modalAvaliacao" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Avaliar este livro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                <p class="text-muted mb-3">Quantas estrelas merece esta obra?</p>
                <div class="fs-1 text-warning mb-3 user-select-none" id="estrelas-selecao" style="cursor: pointer;">
                    <i class="bi bi-star star-input" data-value="1"></i><i class="bi bi-star star-input" data-value="2"></i><i class="bi bi-star star-input" data-value="3"></i><i class="bi bi-star star-input" data-value="4"></i><i class="bi bi-star star-input" data-value="5"></i>
                </div>
                <input type="hidden" id="rating-final" value="0">
                <div id="msg-feedback" class="small text-danger mb-2 fw-bold"></div>
              </div>
              <div class="modal-footer border-0 justify-content-center pb-4">
                <button type="button" class="btn btn-dark px-5 rounded-pill" onclick="enviarAvaliacao()">Enviar Avaliação</button>
              </div>
            </div>
          </div>
        </div>

    </main>

    <?php require('includes/footer.php'); ?>

    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
      <div id="toastSucesso" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body fs-6">
            <i class="bi bi-check-circle-fill me-2"></i> Avaliação registada com sucesso!
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
      <div id="toastFavorito" class="toast align-items-center text-bg-danger border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body fs-6">
            <i class="bi bi-heart-fill me-2"></i> Livro adicionado aos favoritos!
            <div class="mt-2 pt-2 border-top border-light border-opacity-25">
                <a href="fav.php" class="btn btn-sm btn-light text-danger fw-bold w-100">Ver os meus favoritos</a>
            </div>
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto align-self-start" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
      <div id="toastJaExiste" class="toast align-items-center text-bg-warning border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body fs-6 text-dark">
            <i class="bi bi-exclamation-circle-fill me-2"></i> Este livro já está nos teus favoritos!
          </div>
          <button type="button" class="btn-close btn-close-dark me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
    
    <script>
    const totalAvaliacoes = document.getElementById('total-avaliacoes');
    const boxEstrelas = document.getElementById('box-estrelas');
    
    function adicionarFavorito() {
        if(!totalAvaliacoes) return;
        const livroId = totalAvaliacoes.dataset.livroid;

        fetch('ajax/adicionarfav.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ livro_id: livroId })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                if(data.status === 'added') {
                    const toastEl = document.getElementById('toastFavorito');
                    const toast = new bootstrap.Toast(toastEl);
                    toast.show();
                } else if (data.status === 'exists') {
                    const toastEl = document.getElementById('toastJaExiste');
                    const toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }
            } else {
                alert(data.message || "Erro ao adicionar favoritos.");
            }
        })
        .catch(err => console.error(err));
    }

    const estrelasInput = document.querySelectorAll('.star-input');
    const ratingInput = document.getElementById('rating-final');
    
    estrelasInput.forEach(star => {
        star.addEventListener('click', function() {
            let valor = this.dataset.value;
            ratingInput.value = valor; 
            estrelasInput.forEach(s => {
                s.classList.remove(s.dataset.value <= valor ? 'bi-star' : 'bi-star-fill');
                s.classList.add(s.dataset.value <= valor ? 'bi-star-fill' : 'bi-star');
            });
        });
    });

    function enviarAvaliacao() {
        const valor = ratingInput.value;
        const livroId = totalAvaliacoes.dataset.livroid;
        const feedback = document.getElementById('msg-feedback');

        if(valor == 0) {
            feedback.innerText = "Selecione pelo menos 1 estrela.";
            return;
        }

        fetch('ajax/adicionarAvaliacao.php', {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ livro_id: livroId, estrelas: valor })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const modalEl = document.getElementById('modalAvaliacao');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
                
                ratingInput.value = 0;
                estrelasInput.forEach(s => { s.classList.remove('bi-star-fill'); s.classList.add('bi-star'); });
                feedback.innerText = "";

                atualizarAvaliacoes();

                const toastEl = document.getElementById('toastSucesso');
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
            } else {
                feedback.innerText = data.message || "Erro ao enviar.";
            }
        })
        .catch(err => console.error(err));
    }

    function atualizarAvaliacoes() {
        const URL = 'ajax/avaliacoes.php'; 
        if(!totalAvaliacoes) return;
        const livroId = totalAvaliacoes.dataset.livroid; 

        fetch(URL, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({id: livroId}) 
        })
        .then(response => response.json())
        .then(data => {
            totalAvaliacoes.innerHTML = data['total']; 
            if(boxEstrelas && data['media'] !== undefined) {
                renderizarEstrelas(data['media']);
            }
        })
        .catch(err => console.error(err));
    }

    function renderizarEstrelas(media) {
        let html = '';
        let rating = Math.round(media); 
        for (let i = 1; i <= 5; i++) {
            html += (i <= rating) ? '<i class="bi bi-star-fill"></i> ' : '<i class="bi bi-star"></i> ';
        }
        boxEstrelas.innerHTML = html;
    }

    setInterval(atualizarAvaliacoes, 5000);
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchInput');
      const searchSuggestions = document.getElementById('searchSuggestions');
      const searchForm = document.getElementById('searchForm');
      
      if (searchForm && searchInput && searchSuggestions) {
          searchInput.addEventListener('input', function() {
            if (this.value.length > 0) searchSuggestions.classList.add('show');
            else searchSuggestions.classList.remove('show');
          });
          document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target)) searchSuggestions.classList.remove('show');
          });
      }
    });
    </script>
</body>
</html>