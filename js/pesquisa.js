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

        fetch('ajax/pesquisa.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ termo: query })
        })
        .then(response => response.json())
        .then(data => {
            let html = '';

            // SE HOUVER LIVROS
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
            // SE NÃO HOUVER RESULTADOS
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

      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          closeSuggestions();
          searchInput.blur();
        }
      });

      // Redireciona para pesquisa geral se quiseres
      searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
      });
  }
});
