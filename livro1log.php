<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Livro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  
  <link rel="stylesheet" href="css/outraspag.css">
</head>
<body>

 <?php 
  require('includes/header.php');
  ?>
  
   <main class="container my-5">

        <div aria-label="breadcrumb" class="mb-4 fs-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="link-secondary">Início</a></li>
                <li class="breadcrumb-item"><a href="#" class="link-secondary">Romance</a></li> 
                <li class="breadcrumb-item active" aria-current="page">Inventário da Solidão</li> 
            </ol>
        </div>

        <div class="row gy-4 gy-md-0"> 
            <div class="col-sm-4 col-md-4 col-lg-3 text-center text-md-start"> 
                <img src="imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp" alt="Capa do Livro Inventário da Solidão" class="img-fluid rounded shadow-sm mb-3 book-cover-img">
            </div>

            <div class="col-sm-8 col-md-8 col-lg-9"> 
                <h1 class="titulo-livro display-5 fw-bold mb-1 ms-5">Inventário da Solidão</h1>
                <p class="autor h5 mb-2 text-muted ms-5">de <a href="#sobre-autor" class="link-danger text-decoration-none fw-medium ">João Tordo</a></p>
                <p class="small text-muted mb-3 ms-5">
                    Editor: Companhia das Letras <br>
                    Edição: outubro de 2025
                </p>

                <p class="text-uppercase small fw-bold mb-2 ms-5">Formatos Disponíveis:</p>
                <div class="mb-4">
                    <span class="badge bg-danger me-2 p-2 ms-5">Ler Online</span>
                    <span class="badge bg-secondary p-2 ">PDF</span>
                </div>
                 
                <div class="d-flex flex-wrap gap-2 mb-4">
                    <a href="#" class="btn btn-danger btn-md ms-5">Ler Online</a> 
                    <a href="#" class="btn btn-outline-secondary btn-md ">Download PDF</a>
                </div>
            </div>
        </div>

        <div class="row mb-4"> 
            <div class="col-12">
                <h2 class="collapse-sinopse mb-0 text-uppercase fw-bold"> 
                    <button class="sobre-autor btn btn-link text-dark text-decoration-none text-uppercase fw-bold p-0 d-flex justify-content-between w-100" 
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseSinopse" aria-expanded="false"  
                            aria-controls="collapseSinopse">Sinopse<span class="collapse-icon d-md-none ms-2">▼</span> 
                    </button>
                </h2>
                <div class="collapse d-md-block" id="collapseSinopse">
                    <div class="pt-3"> <p class="mb-3">
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
                         <p class="mb-3">
                            Será que, na revisitação desse passado de segredos, encontrará resposta para a solidão que o
                            consome? Conseguirá ele, com a morte do seu primeiro amor, apaziguar-se com o rapaz que foi e o
                            homem que se tornou?
                        </p>
                         <p>
                            Mais do que um romance sobre o vazio que os grandes amores deixam em nós quando terminam,
                            Inventário da Solidão é um livro poderoso sobre as doenças invisíveis que corroem o espírito, as
                            matérias perigosas de que todos somos feitos.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 d-md-none"> <div class="row mb-5"> 
            <div class="col-12">
                <h2 class="mb-0 text-uppercase fw-bold"> <button class="sobre-autor btn btn-link text-dark text-decoration-none text-uppercase fw-bold p-0 d-flex justify-content-between w-100" 
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseDetalhes" aria-expanded="false" 
                    aria-controls="collapseDetalhes">Detalhes do Livro <span class="collapse-icon d-md-none ms-2">▼</span>
                    </button>
                </h2>
                
                <div class="collapse d-md-block" id="collapseDetalhes">
                    <div class="pt-3">
                         <ul class="list-unstyled mb-0">
                            <li class="mb-2"><strong>ISBN:</strong> 978-XXXXXXXXXX</li>
                            <li class="mb-2"><strong>Edição:</strong> 1ª Edição</li>
                            <li class="mb-2"><strong>Páginas:</strong> 350</li>
                            <li class="mb-2"><strong>Editora:</strong> Companhia das Letras</li> <li class="mb-2"><strong>Idioma:</strong> Português</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 d-none d-md-block"> 

        <div class="row mb-5" id="sobre-autor">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="sobre-autor text-uppercase fw-bold mb-0">Sobre o Autor</h2>
                </div>
                
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start gap-4">
                    <img src="imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp" alt="" class="author-img shadow-sm"> 
                    <div>
                        <h3 class="sobre-autor h4 fw-bold mb-2">João Tordo</h3>
                        <p class="mb-2">
                            João Tordo nasceu em Lisboa em 1975.
                            É autor de dezasseis livros, divididos entre o romance, o policial e o ensaio.
                        </p>
                        <p>
                            Venceu o Prémio Literário José Saramago em 2009, com o romance <em>As três
                            vidas</em>, e o Prémio Literário Fernando Namora em 2021, com <em>Felicidade</em>. (...)
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
           </div>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="sobre-autor text-uppercase fw-bold mb-0 me-1">Outros Livros do Autor</h2>
            <a class="subtitulo text-decoration-none text-dark fw-semibold me-4 fs-6" href="#">Ver +</a>
        </div>

        <div class="row g-4 justify-content-center"> 
            
            <div class="col-6 col-sm-6 col-md-4 col-lg-3"> 
                <div class="card book-card h-100"> 
                    <img src="imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp" class="card-img-top" alt="">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-semibold">O Nome do Vento</h6>
                        <p class="card-text text-muted small mb-2">Patrick Rothfuss</p>
                        <a href="livro1.php" class="btn btn-outline-dark btn-sm">Ver mais</a>
                    </div>
                </div>
            </div>
                         
            <div class="col-6 col-sm-6 col-md-4 col-lg-3"> 
                <div class="card book-card h-100"> 
                    <img src="imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp" class="card-img-top" alt="">
                    <div class="card-body text-center">
                        <h6 class="card-title fw-semibold">O Nome do Vento</h6>
                        <p class="card-text text-muted small mb-2">Patrick Rothfuss</p>
                        <a href="livro1.php" class="btn btn-outline-dark btn-sm">Ver mais</a>
                    </div>
                </div>
            </div>                        
            
        </div> </div> </div>
</main>

<?php 
  require('includes/footerlog.php');
  ?>
        <script>
// SISTEMA DE SUGESTÕES - SEM ALTERAR COMPORTAMENTO DA BARRA
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const searchSuggestions = document.getElementById('searchSuggestions');
  const searchForm = document.getElementById('searchForm');

  // Mostrar sugestões apenas quando há texto
  searchInput.addEventListener('input', function() {
    if (this.value.length > 0) {
      searchSuggestions.classList.add('show');
    } else {
      searchSuggestions.classList.remove('show');
    }
  });

  // Mostrar sugestões também quando clicar (se já tiver texto)
  searchInput.addEventListener('focus', function() {
    if (this.value.length > 0) {
      searchSuggestions.classList.add('show');
    }
  });

  // Ocultar sugestões quando clicar fora
  document.addEventListener('click', function(e) {
    if (!searchForm.contains(e.target)) {
      searchSuggestions.classList.remove('show');
    }
  });

  // Clicar numa sugestão preenche o input
  document.querySelectorAll('.suggestion-item').forEach(item => {
    item.addEventListener('click', function() {
      const title = this.querySelector('.suggestion-title').textContent;
      searchInput.value = title;
      searchSuggestions.classList.remove('show');
      searchInput.focus(); // Mantém o foco no input
    });
  });

  // Tecla ESC fecha sugestões
  searchInput.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      searchSuggestions.classList.remove('show');
      searchInput.blur(); // Remove o foco
    }
  });

  // Clicar em "Ver todos" submete o form
  document.querySelector('.see-all-link').addEventListener('click', function(e) {
    e.preventDefault();
    searchForm.submit();
  });
});
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>