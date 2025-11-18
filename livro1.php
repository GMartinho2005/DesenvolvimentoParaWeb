<?php
require('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventário da Solidão - Letrário Coimbra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">    
    <link rel="stylesheet" href="css/outraspag.css">
</head>
<body class="d-flex flex-column min-vh-100 bg-white">
    
    <?php
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        require('includes/headerlog.php'); // Ajustei para o nome padrão que usámos antes
    } else {
        require('includes/header.php');
    }
    ?>
 
    <main class="container my-5 flex-grow-1">

        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-secondary">Início</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-secondary">Romance</a></li> 
                <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page">Inventário da Solidão</li> 
            </ol>
        </nav>

        <div class="row gx-lg-5 gy-4"> 
            
            <div class="col-12 col-md-4 col-lg-3 text-center"> 
                <img src="imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp" class="img-fluid rounded shadow w-100 object-fit-cover" style="max-width: 300px;" alt="Capa do livro Inventário da Solidão">
            </div>

            <div class="col-12 col-md-8 col-lg-9 ps-md-4"> 
                <h1 class="display-5 fw-bold mb-2 text-dark">Inventário da Solidão</h1>
                <p class="h5 mb-3 text-secondary">de <a href="#sobre-autor" class="link-danger text-decoration-none fw-bold">João Tordo</a></p>
                
                <?php
                $book_rating = 5; 
                $book_reviews = 129; 
                ?>

                <div class="mb-3 text-warning d-flex align-items-center" title="Rating: <?php echo $book_rating; ?> de 5 estrelas">
                    <div class="me-2">
                        <?php 
                        for ($i = 1; $i <= 5; $i++):
                            echo ($i <= $book_rating) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                        endfor; 
                        ?>
                    </div>
                    <span class="small text-muted text-black">(<?php echo $book_reviews; ?> avaliações)</span>
                </div>

                <div class="mb-4 text-muted small">
                    <p class="mb-1"><strong>Editor:</strong> Companhia das Letras</p>
                    <p class="mb-0"><strong>Edição:</strong> Outubro de 2025</p>
                </div>

                <p class="text-uppercase small fw-bold mb-2 text-secondary">Formatos Disponíveis:</p>
                <div class="mb-4">
                    <span class="badge bg-secondary p-2">PDF</span>
                </div>
                
                <div class="d-grid gap-2 d-md-block">
                    <a href="#" class="btn btn-dark btn-lg px-4 rounded-pill">Download PDF</a>
                    <a href="#" class="btn btn-outline-secondary btn-lg px-4 rounded-pill ms-md-2">Adicionar aos Favoritos</a>
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
                        <p class="mb-3">
                            Ao fim de quase quarenta anos de silêncios e ausências, um antigo grupo de colegas da faculdade
                            reúne-se na Irlanda para um último adeus a Rebecca Connelly, cuja morte, súbita e inesperada, traz
                            ao de cima fantasmas há muito enterrados.
                        </p>
                        <p class="mb-3">
                            De todos a mais intrépida, mas também a mais inconstante, ninguém poderia imaginar o rumo que a
                            vida de Becca levaria, nem a devastação que traria na sua esteira. Ninguém, exceto o rapaz que a
                            amou durante os tempos de faculdade — o narrador, agora sexagenário, que tenta ainda fazer
                            sentido de todos os caminhos que trilharam o seu destino.
                        </p>
                        <p>
                            Mais do que um romance sobre o vazio que os grandes amores deixam em nós quando terminam,
                            Inventário da Solidão é um livro poderoso sobre as doenças invisíveis que corroem o espírito.
                        </p>
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
                                    <li class="mb-2"><strong>ISBN:</strong> 978-XXXXXXXXXX</li>
                                    <li class="mb-2"><strong>Edição:</strong> 1ª Edição</li>
                                    <li class="mb-2"><strong>Páginas:</strong> 350</li>
                                </ul>
                             </div>
                             <div class="col-md-6">
                                 <ul class="list-unstyled mb-0 text-secondary">
                                    <li class="mb-2"><strong>Editora:</strong> Companhia das Letras</li> 
                                    <li class="mb-2"><strong>Idioma:</strong> Português</li>
                                    <li class="mb-2"><strong>Género:</strong> Romance</li>
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
                    <div class="flex-shrink-0">
                        <img src="imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp" alt="Foto de João Tordo" class="rounded-circle object-fit-cover" style="width: 120px; height: 120px;"> 
                    </div>
                    
                    <div class="text-center text-md-start">
                        <h3 class="h4 fw-bold mb-2">João Tordo</h3>
                        <p class="text-secondary mb-2">
                            João Tordo nasceu em Lisboa em 1975. É autor de dezasseis livros, divididos entre o romance, o policial e o ensaio.
                        </p>
                        <p class="text-secondary mb-0">
                            Venceu o Prémio Literário José Saramago em 2009, com o romance <em>As três vidas</em>.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-uppercase fw-bold mb-0 fs-4">Outros Livros do Autor</h2>
                    <a class="text-decoration-none text-secondary fw-semibold small" href="#">Ver todos <i class="bi bi-arrow-right"></i></a>
                </div>

                <?php
                // Dados atualizados conforme a sua imagem de exemplo
                $outros_livros = [
                    [
                        "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", // Substitua pelas capas corretas
                        "title" => "Drácula", 
                        "author" => "Bram Stoker", 
                        "link" => "#"
                    ],
                    [
                        "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                        "title" => "Frankenstein", 
                        "author" => "Mary Shelley", 
                        "link" => "#"
                    ],
                    [
                        "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                        "title" => "O Chamado de Cthulhu", 
                        "author" => "H.P. Lovecraft", 
                        "link" => "#"
                    ],
                    [
                        "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                        "title" => "It", 
                        "author" => "Stephen King", 
                        "link" => "#"
                    ]
                ];
                ?>

                <div class="row row-cols-2 row-cols-md-4 g-4"> 
                    <?php foreach ($outros_livros as $livro): ?>
                    <div class="col"> 
                        <div class="card h-100 border-0 shadow-sm book-card"> 
                            <div class="overflow-hidden rounded-top">
                                <img src="<?php echo $livro['img']; ?>" class="card-img-top object-fit-cover" style="aspect-ratio: 2/3; width: 100%;" alt="Capa">
                            </div>
                            
                            <div class="card-body text-center d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="card-title fw-bold mb-1 text-dark">
                                        <?php echo $livro['title']; ?>
                                    </h6>
                                    <p class="card-text text-muted small mb-3">
                                        <?php echo $livro['author']; ?>
                                    </p>
                                </div>
                                
                                <a href="<?php echo $livro['link']; ?>" class="btn btn-outline-dark rounded-pill w-100 btn-sm fw-medium mt-2">
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div> 
            </div> 
        </div>
    </main>

    <?php 
    require('includes/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.getElementById('searchInput');
      const searchSuggestions = document.getElementById('searchSuggestions');
      const searchForm = document.getElementById('searchForm');
      const seeAllLink = document.querySelector('.see-all-link');

      if (searchForm && searchInput && searchSuggestions) {
          searchInput.addEventListener('input', function() {
            if (this.value.length > 0) searchSuggestions.classList.add('show');
            else searchSuggestions.classList.remove('show');
          });
          searchInput.addEventListener('focus', function() {
            if (this.value.length > 0) searchSuggestions.classList.add('show');
          });
          document.addEventListener('click', function(e) {
            if (!searchForm.contains(e.target)) searchSuggestions.classList.remove('show');
          });
          searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
              searchSuggestions.classList.remove('show');
              searchInput.blur();
            }
          });
      }
      document.querySelectorAll('.suggestion-item').forEach(item => {
        item.addEventListener('click', function() {
          const title = this.querySelector('.suggestion-title').textContent;
          if(searchInput) { searchInput.value = title; searchInput.focus(); }
          if(searchSuggestions) { searchSuggestions.classList.remove('show'); }
        });
      });
      if (seeAllLink && searchForm) {
          seeAllLink.addEventListener('click', function(e) {
            e.preventDefault();
            searchForm.submit();
          });
      }
    });
    </script>
</body>
</html>