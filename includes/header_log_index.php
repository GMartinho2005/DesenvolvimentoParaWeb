<?php 
include_once 'connection.php'; 
?>

<link rel="stylesheet" href="css/home.css">

<header class="custom-header py-3 border-bottom bg-body-tertiary">
  <div class="container text-center">
    <!-- Linha com logo + pesquisa + conta -->
    <div class="top-header d-flex justify-content-center align-items-center flex-wrap mb-3">
      
      <!-- LOGO -->
      <div class="header-logo">
        <a href="index.php">
          <img src="imgs/Design sem nome.png" class="logo">
        </a>
      </div>

      <!-- Barra de pesquisa - MANTENDO ESTILO ATUAL EXATO -->
      <form class="search-bar d-flex align-items-center" role="search" id="searchForm">
        <div class="position-relative">
          <input 
            class="form-control me-2" 
            type="search" 
            placeholder="Pesquisar" 
            aria-label="Pesquisar"
            id="searchInput"
            autocomplete="off"
          >
          <!-- Dropdown de sugestões -->
    <div class="search-suggestions" id="searchSuggestions">
    </div>
  </div>
  <button class="btn btn-outline-secondary">
    <i class="bi bi-search"></i>
  </button>
</form>

      <!-- Ícone da conta -->
      <div class="account-icon dropdown" style="z-index: 10;">
        
        <a href="#" class="text-decoration-none text-dark fs-4" data-bs-toggle="dropdown" aria-expanded="false" role="button" title="A Minha Conta">
            <i class="bi bi-person-circle"></i>
        </a>


        <ul class="dropdown-menu dropdown-menu-end">
            <?php 

            $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Utilizador';
            ?>
            <li><h6 class="dropdown-header">Olá, <?php echo $username; ?></h6></li>
            
            <li><a class="dropdown-item" href="contalog.php"><i class="bi bi-person-circle me-2"></i> Conta</a></li>
            <li><a class="dropdown-item" href="fav.php"><i class="bi bi-heart-fill me-2"></i> Favoritos</a></li>
            <li><a class="dropdown-item" href="ajuda.php"><i class="bi bi-question-circle-fill me-2"></i> Ajuda</a></li>
            
            <li><hr class="dropdown-divider"></li>
            
            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i> Sair</a></li>
        </ul>
      </div>

    </div>

    <nav class="navbar navbar-expand-lg">
      <div class="container justify-content-center">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasMenuLabel"> <img width="30%" src="imgs/Design sem nome.png" alt=""></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
              <li class="nav-item"><a class="nav-link" href="categoria.php?tipo=melhoravaliados">Melhor Avaliados</a></li>
              <li class="nav-item"><a class="nav-link" href="estantedigital.php">Estante Digital</a></li>
              <li class="nav-item"><a class="nav-link" href="recomendacoes.php">Recomendações</a></li>
              <li class="nav-item"><a class="nav-link" href="ajuda.php">Ajuda</a></li>
              <li class="nav-item"><a class="nav-link" href="sobrenos.php">Sobre Nós</a></li>
            </ul>
          </div>
        </div>
        
      </div>
    </nav>
  </div>
</header>