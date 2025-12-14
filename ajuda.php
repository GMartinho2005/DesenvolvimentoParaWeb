<?php require('includes/connection.php'); ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajuda e FAQ - Letrário Coimbra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/outraspag.css"> 
</head>
<body class="d-flex flex-column min-vh-100">
    
<?php
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    require('includes/headerlog.php');
} else {
    require('includes/header.php');
}
?>

<main class="flex-grow-1">
    <div class="banner-container position-relative text-white banner-img-container">
        <img src="imgs/a-realistic-horizontal-photographic-bann_2vM2opncSoiYxLnbY74OgA_YLcLwR7nS1uiVLfO2-DqPA.jpeg" class="banner-img">
        <div class="banner-content mx-auto p-3 p-md-0 text-center text-md-start">
            <h1 class="fw-bold display-6">Se tem dúvidas, nós temos as respostas e poderá encontrá-las nesta área</h1>
        </div>
    </div>

    <div class="container my-5">
        <div class="accordion" id="helpAccordion">
            
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingRegisto">
                    <button class="accordion-button collapsed faq-item" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegisto">
                        <i class="bi bi-person-circle"></i> ACESSO E REGISTO
                    </button>
                </h2>
                <div id="collapseRegisto" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                    <div class="accordion-body p-0">
                        <div class="accordion accordion-flush nested-accordion" id="nestedAccordionRegisto">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingRegisto1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegisto1">
                                        COMO ME REGISTAR NA PLATAFORMA?
                                    </button>
                                </h2>
                                <div id="collapseRegisto1" class="accordion-collapse collapse" data-bs-parent="#nestedAccordionRegisto">
                                    <div class="accordion-body">O registo é efetuado através do ícone de utilizador.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingRegisto2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegisto2">
                                        É NECESSÁRIO PAGAR PARA ACEDER Á ESTANTE?
                                    </button>
                                </h2>
                                <div id="collapseRegisto2" class="accordion-collapse collapse" data-bs-parent="#nestedAccordionRegisto">
                                    <div class="accordion-body">Não. O acesso ao Letrário Coimbra é e será sempre 100% gratuito.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingRegisto3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRegisto3">
                                        ESQUECI-ME DA MINHA PALAVRA-PASSE. COMO RECUPERAR?
                                    </button>
                                </h2>
                                <div id="collapseRegisto3" class="accordion-collapse collapse" data-bs-parent="#nestedAccordionRegisto">
                                    <div class="accordion-body">Na página "Conta", encontrará um botão "RECUPERAR PASSWORD".</div>
                                </div>
                            </div>
                        </div> 
                    </div> 
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEstante">
                    <button class="accordion-button collapsed faq-item" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEstante">
                        <i class="bi bi-book"></i> A ESTANTE DIGITAL
                    </button>
                </h2>
                <div id="collapseEstante" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                    <div class="accordion-body p-0">
                        <div class="accordion accordion-flush nested-accordion" id="nestedAccordionEstante">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEstante1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEstante1">
                                        COMO FAÇO UMA SUGESTÃO DE NOVO TÍTULO?
                                    </button>
                                </h2>
                                <div id="collapseEstante1" class="accordion-collapse collapse" data-bs-parent="#nestedAccordionEstante">
                                    <div class="accordion-body">Adoramos sugestões! Embora não possamos garantir que todas são adicionadas devido aos direitos autorais, analisamos cuidadosamente todos os pedidos para futuras atualizações da nossa estante.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingDispositivos">
                    <button class="accordion-button collapsed faq-item" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDispositivos">
                        <i class="bi bi-tablet"></i> LEITURA E DISPOSITIVOS
                    </button>
                </h2>
                <div id="collapseDispositivos" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                    <div class="accordion-body p-0">
                        <div class="accordion accordion-flush nested-accordion" id="nestedAccordionDispositivos">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingDisp1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDisp1">
                                        POSSO LER OS LIVROS NO MEU TELEMÓVEL?
                                    </button>
                                </h2>
                                <div id="collapseDisp1" class="accordion-collapse collapse" data-bs-parent="#nestedAccordionDispositivos">
                                    <div class="accordion-body">Sim, se descarregar o PDF.</div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingDisp2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDisp2">
                                        OS LIVROS SÃO COMPATÍVEIS COM O KINDLE?
                                    </button>
                                </h2>
                                <div id="collapseDisp2" class="accordion-collapse collapse" data-bs-parent="#nestedAccordionDispositivos">
                                    <div class="accordion-body">Atualmente, os nossos ficheiros são disponibilizados apenas em PDF.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingPoliticas">
                    <button class="accordion-button collapsed faq-item" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePoliticas">
                        <i class="bi bi-shield-lock"></i> POLÍTICA DE PRIVACIDADE E TERMOS
                    </button>
                </h2>
                <div id="collapsePoliticas" class="accordion-collapse collapse" data-bs-parent="#helpAccordion">
                    <div class="accordion-body p-0">
                        <div class="accordion accordion-flush nested-accordion" id="nestedAccordionPoliticas">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingPol1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePol1">
                                        QUAL É A NOSSA POLÍTICA DE PRIVACIDADE?
                                    </button>
                                </h2>
                                <div id="collapsePol1" class="accordion-collapse collapse" data-bs-parent="#nestedAccordionPoliticas">
                                    <div class="accordion-body">Nunca partilhamos os seus dados pessoais com terceiros.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    </div>

    <div class="apoio-section">
        <div class="container">
            <div class="row align-items-center g-4 flex-column-reverse flex-md-row text-center text-md-start">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">FALE COM O NOSSO APOIO</h2>
                    <p class="lead">Precisa de ajuda direta? A nossa equipa está pronta para o apoiar.</p>
                    <p class="lead">Envie um e-mail para <strong>apoio@lc.pt</strong></p>
                </div>
                <div class="col-md-4 text-center">
                    <img class="img-fluid rounded-circle shadow w-auto mx-auto d-block" style="max-width: 250px;" src="imgs/a-realistic-photograph-of-gentle-hands-h_dha7AHUATMW-zxNaSq8qVw_f6NrXX3iStiJMzJtbAil6w.jpeg" alt="Mãos segurando um tablet com um ponto de interrogação">
                </div>
            </div>
        </div>
    </div>
</main>

<?php require('includes/footer.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.getElementById('searchInput');
  const searchSuggestions = document.getElementById('searchSuggestions');
  const searchForm = document.getElementById('searchForm');

  if(searchInput && searchSuggestions && searchForm){
      
      // Função para fechar
      function closeSuggestions() {
          searchSuggestions.classList.remove('show');
      }

      searchInput.addEventListener('input', function() {
        const query = this.value.trim();

        if (query.length < 2) {
            closeSuggestions();
            return;
        }

        // Chamada AJAX
        fetch('ajax/pesquisa.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ termo: query })
        })
        .then(response => response.json())
        .then(data => {
            let html = '';

            // 1. SE HOUVER LIVROS
            if (data.livros && data.livros.length > 0) {
                html += '<div class="suggestion-header"><small>Livros Encontrados</small></div>';
                
                data.livros.forEach(livro => {
                    html += `
                        <div class="suggestion-item" onclick="window.location.href='livro.php?id=${livro.id}'">
                            <span class="suggestion-title">${livro.titulo}</span>
                            <small class="suggestion-author">${livro.autor || 'Autor Desconhecido'}</small>
                        </div>
                    `;
                });
            } 
            // 2. SE NÃO HOUVER RESULTADOS
            else {
                html = '<div class="p-3 text-muted small text-center">Nenhum livro encontrado.</div>';
            }

            searchSuggestions.innerHTML = html;
            searchSuggestions.classList.add('show');
        })
        .catch(err => console.error(err));
      });

      // Fechar ao clicar fora
      document.addEventListener('click', function(e) {
        if (!searchForm.contains(e.target)) closeSuggestions();
      });

      // Tecla Escape
      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeSuggestions();
          searchInput.blur();
        }
      });

      // Submit do formulário (Enter) - Redireciona para pesquisa geral se quiseres
      searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Opcional: Podes manter isto se quiseres uma página de resultados
        /* const query = searchInput.value.trim();
        if(query) {
            window.location.href = 'index.php?q=' + encodeURIComponent(query);
        }
        */
      });
  }
});
</script>
</body>
</html>