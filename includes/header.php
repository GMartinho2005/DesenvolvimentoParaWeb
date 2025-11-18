<?php 
include_once 'connection.php'; 
?>



<header class="custom-header py-3 border-bottom bg-body-tertiary">
  <div class="container text-center">
    <!-- Linha com logo + pesquisa + conta -->
    <div class="top-header justify-content-center align-items-center flex-wrap mb-3">
      
      <!-- LOGO -->
      <div class="header-logo">
        <a href="index.php">
          <img src="imgs/Design sem nome.png" class="logo">
        </a>
      </div>

      <!-- Barra de pesquisa -->
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
      <div class="suggestion-header">
        <small>Títulos Sugeridos</small>
      </div>
      
      <div class="suggestion-item">
        <span class="suggestion-title">O Nome do Vento</span>
        <small class="suggestion-author">Patrick Rothfuss</small>
      </div>
      <div class="suggestion-item">
        <span class="suggestion-title">1984</span>
        <small class="suggestion-author">George Orwell</small>
      </div>
      <div class="suggestion-item">
        <span class="suggestion-title">A Sombra do Vento</span>
        <small class="suggestion-author">Carlos Ruiz Zafón</small>
      </div>

      <div class="suggestion-divider"></div>

      <div class="suggestion-item">
        <span class="suggestion-title">Patrick Rothfuss</span>
        <small class="suggestion-type">Autor</small>
      </div>
      <div class="suggestion-item">
        <span class="suggestion-title">George Orwell</span>
        <small class="suggestion-type">Autor</small>
      </div>

      <div class="suggestion-divider"></div>

      <div class="suggestion-footer">
        <a href="#" class="see-all-link">Ver todos os resultados</a>
      </div>
    </div>
  </div>
  <button class="btn btn-outline-secondary" type="submit">
    <i class="bi bi-search"></i>
  </button>
</form>

      <!-- Ícone da conta -->
      <div class="account-icon">
        <a href="conta.php" class="text-decoration-none text-dark fs-4">
          <i class="bi bi-person-circle"></i>
        </a>
      </div>
    </div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
  <div class="container justify-content-center">
    <!-- BOTÃO TOGGLE -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENU OFFCANVAS (abre da esquerda) -->
    <div class="offcanvas offcanvas-start " tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasMenuLabel"> <img width="30%" src="imgs/Design sem nome.png" alt=""></h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">
          <li class="nav-item"><a class="nav-link" href="melhoravaliados.php">Melhor Avaliados</a></li>
          <li class="nav-item"><a class="nav-link" href="estantedigital.php">Estante Digital</a></li>
          <li class="nav-item"><a class="nav-link" href="recomendacoes.php">Recomendações</a></li>
          <li class="nav-item"><a class="nav-link" href="ajuda.php">Ajuda</a></li>
          <li class="nav-item"><a class="nav-link" href="sobrenos.php">Sobre Nós</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
</header>