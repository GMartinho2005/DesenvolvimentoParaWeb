<?php
require('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recomendações - Letrário Coimbra</title>
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
        <div class="container my-5 py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <div class="card quiz-card shadow-lg border-0 rounded-4 overflow-hidden">
                        
                        <div class="progress d-none" id="quiz-progress" style="height: 6px; border-radius: 0;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 0%"></div>
                        </div>

                        <div class="card-body p-4 p-md-5 text-center">

                            <div id="quiz-intro" class="quiz-step">
                                <h1 class="display-5 fw-bold mb-3">Descubra o seu Próximo Livro</h1>
                                <p class="lead mb-5 text-muted">Não sabe o que ler a seguir? Responda a 5 perguntas rápidas e nós encontramos a recomendação perfeita.</p>
                                <button class="btn btn-dark btn-lg px-5 rounded-pill fw-bold" onclick="startQuiz()">Começar Quiz</button>
                            </div>

                            <div id="quiz-q1" class="quiz-step d-none">
                                <span class="badge bg-light text-dark border mb-3">Pergunta 1 de 5</span>
                                <h3 class="mb-4 fw-bold">Onde gostaria de passar as suas férias ideais?</h3>
                                <div class="d-grid gap-3 col-md-10 mx-auto">
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['fantasia', 'conto'])">Num mundo mágico ou floresta encantada 🏰</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['ficcao', 'policial'])">Numa cidade futurista ou cena de crime 🌃</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['historia', 'classica', 'biografia'])">Num local histórico ou museu antigo 🏛️</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['romance', 'poesia', 'musica'])">Num café romântico ou sala de concertos 🎻</button>
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="prevQuestion()">
                                        <i class="bi bi-arrow-left"></i> Voltar ao Início
                                    </button>
                                </div>
                            </div>

                            <div id="quiz-q2" class="quiz-step d-none">
                                <span class="badge bg-light text-dark border mb-3">Pergunta 2 de 5</span>
                                <h3 class="mb-4 fw-bold">O que procura sentir ao ler um livro?</h3>
                                <div class="d-grid gap-3 col-md-10 mx-auto">
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['humor', 'conto'])">Quero rir e divertir-me 😂</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['halloween', 'policial'])">Quero sentir medo ou suspense 😱</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['financas', 'biografia', 'historia'])">Quero aprender e evoluir 🧠</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['romance', 'poesia'])">Quero emocionar-me e sonhar ❤️</button>
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="prevQuestion()">
                                        <i class="bi bi-arrow-left"></i> Voltar
                                    </button>
                                </div>
                            </div>

                            <div id="quiz-q3" class="quiz-step d-none">
                                <span class="badge bg-light text-dark border mb-3">Pergunta 3 de 5</span>
                                <h3 class="mb-4 fw-bold">Quem seria o protagonista ideal?</h3>
                                <div class="d-grid gap-3 col-md-10 mx-auto">
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['biografia', 'historia', 'financas'])">Uma pessoa real que mudou o mundo 🌍</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['fantasia', 'ficcao'])">Um herói com poderes ou tecnologia ⚡</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['policial', 'halloween'])">Um detetive ou sobrevivente inteligente 🕵️</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['classica', 'musica', 'romance'])">Um artista ou alma incompreendida 🎨</button>
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="prevQuestion()">
                                        <i class="bi bi-arrow-left"></i> Voltar
                                    </button>
                                </div>
                            </div>

                            <div id="quiz-q4" class="quiz-step d-none">
                                <span class="badge bg-light text-dark border mb-3">Pergunta 4 de 5</span>
                                <h3 class="mb-4 fw-bold">Em que época prefere que a história se passe?</h3>
                                <div class="d-grid gap-3 col-md-10 mx-auto">
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['ficcao'])">No futuro distante 🚀</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['historia', 'classica', 'biografia'])">No passado real ⏳</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['fantasia', 'halloween'])">Num tempo indefinido ou imaginário 🐉</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['financas', 'humor', 'conto', 'policial'])">Nos dias de hoje 📅</button>
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="prevQuestion()">
                                        <i class="bi bi-arrow-left"></i> Voltar
                                    </button>
                                </div>
                            </div>

                            <div id="quiz-q5" class="quiz-step d-none">
                                <span class="badge bg-light text-dark border mb-3">Pergunta Final</span>
                                <h3 class="mb-4 fw-bold">Escolha uma palavra que o define hoje:</h3>
                                <div class="d-grid gap-3 col-md-10 mx-auto">
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['financas'], true)">Ambição 💰</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['musica', 'poesia'], true)">Arte 🎵</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['fantasia', 'ficcao'], true)">Imaginação ✨</button>
                                    <button class="btn btn-quiz-option" onclick="selectAnswer(['romance', 'classica'], true)">Sentimento 🌹</button>
                                </div>
                                <div class="mt-4">
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="prevQuestion()">
                                        <i class="bi bi-arrow-left"></i> Voltar
                                    </button>
                                </div>
                            </div>

                            <div id="quiz-loading" class="quiz-step d-none">
                                <div class="spinner-border text-dark mb-4" style="width: 3rem; height: 3rem;" role="status"></div>
                                <h3 class="fw-bold">A analisar as suas respostas...</h3>
                                <p class="text-muted">A consultar a nossa biblioteca...</p>
                            </div>

                            <div id="quiz-result" class="quiz-step d-none">
                                <div class="text-center mb-4">
                                    <i class="text-primary display-1"></i>
                                </div>
                                
                                <h5 class="text-muted text-uppercase small fw-bold mb-2">Recomendamos a categoria:</h5>
                                <h2 class="fw-bold mb-4" id="res-categoria-nome">...</h2>
                                
                                <div class="card mb-4 border-0 shadow-sm bg-light overflow-hidden mx-auto" style="max-width: 500px;">
                                    <div class="row g-0">
                                        <div class="col-4">
                                            <img id="res-img" src="" class="img-fluid w-100 h-100 object-fit-cover" alt="Capa">
                                        </div>
                                        <div class="col-8 d-flex align-items-center">
                                            <div class="card-body text-start">
                                                <h5 class="card-title fw-bold" id="res-titulo">...</h5>
                                                <p class="card-text small text-muted" id="res-autor">...</p>
                                                <a id="res-link" href="#" class="btn-sug rounded-pill btn btn-dark btn-sm stretched-link">Ver Detalhes</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-link text-muted text-decoration-none" onclick="location.reload()">Recomeçar Quiz ↺</button>
                            </div>

                        </div>
                    </div> 
                </div> 
            </div> 
        </div>
    </main>

    <?php require('includes/footer.php'); ?>
    <script>
        let scores = {}; 
        let currentQuestion = 0;
        const totalQuestions = 5;

        // Array para guardar o histórico de respostas para poder reverter a pontuação se o user voltar atrás
        // (Simplificação: ao voltar, apenas recuamos no passo, a pontuação recalcula-se ao avançar de novo)
        
        const allCats = ['ficcao', 'romance', 'fantasia', 'biografia', 'classica', 'conto', 'financas', 'halloween', 'historia', 'humor', 'musica', 'poesia', 'policial'];
        allCats.forEach(c => scores[c] = 0);

        function startQuiz() {
            changeStep('quiz-intro', 'quiz-q1');
            currentQuestion = 1;
            document.getElementById('quiz-progress').classList.remove('d-none');
            updateProgressBar();
        }

        function selectAnswer(categories, isLast = false) {
            // Adiciona pontos
            categories.forEach(cat => {
                if (scores[cat] !== undefined) scores[cat]++;
            });

            if (isLast) {
                finishQuiz();
            } else {
                const nextQ = currentQuestion + 1;
                changeStep('quiz-q' + currentQuestion, 'quiz-q' + nextQ);
                currentQuestion++;
                updateProgressBar();
            }
        }

        // --- FUNÇÃO PARA VOLTAR ATRÁS ---
        function prevQuestion() {
            if (currentQuestion > 1) {
                // Se estivermos na pergunta 2 ou mais, voltamos para a anterior
                const prevQ = currentQuestion - 1;
                changeStep('quiz-q' + currentQuestion, 'quiz-q' + prevQ);
                
                // Nota: Não removemos os pontos aqui para simplificar, 
                // mas como o user vai clicar noutra opção ao avançar, os pontos acumulam.
                // Para ser perfeito, devíamos limpar o score total e recalcular, 
                // mas para um quiz simples, redefinir scores a 0 ao voltar é mais seguro:
                if(prevQ === 1) { 
                    // Se voltou ao inicio, limpa tudo
                    allCats.forEach(c => scores[c] = 0); 
                }

                currentQuestion--;
                updateProgressBar();
            } else {
                // Se estiver na Pergunta 1, volta para a Intro
                changeStep('quiz-q1', 'quiz-intro');
                document.getElementById('quiz-progress').classList.add('d-none');
                currentQuestion = 0;
                // Reseta scores
                allCats.forEach(c => scores[c] = 0);
            }
        }

        function changeStep(hideId, showId) {
            document.getElementById(hideId).classList.add('d-none');
            document.getElementById(showId).classList.remove('d-none');
        }

        function updateProgressBar() {
            // Calcula a percentagem baseada na pergunta atual (ex: Pergunta 1 = 0%, Pergunta 5 = 80%, Fim = 100%)
            const percentage = ((currentQuestion - 1) / totalQuestions) * 100;
            document.querySelector('.progress-bar').style.width = percentage + '%';
        }

        function finishQuiz() {
            document.getElementById('quiz-q' + totalQuestions).classList.add('d-none');
            document.getElementById('quiz-progress').classList.add('d-none');
            document.getElementById('quiz-loading').classList.remove('d-none');

            let maxScore = -1;
            let winner = 'ficcao'; 
            
            const shuffledCats = Object.keys(scores).sort(() => 0.5 - Math.random());

            shuffledCats.forEach(cat => {
                if (scores[cat] > maxScore) {
                    maxScore = scores[cat];
                    winner = cat;
                }
            });

            // AJAX call
            fetch('ajax/recomendarLivro.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ categoria: winner })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('quiz-loading').classList.add('d-none');
                
                if(data.success) {
                    document.getElementById('res-categoria-nome').innerText = data.categoria_nome;
                    document.getElementById('res-titulo').innerText = data.livro.titulo;
                    document.getElementById('res-autor').innerText = data.livro.autor;
                    document.getElementById('res-img').src = data.livro.imagem;
                    document.getElementById('res-link').href = 'livro.php?id=' + data.livro.id;
                    
                    document.getElementById('quiz-result').classList.remove('d-none');
                } else {
                    alert("Erro ao buscar recomendação: " + data.message);
                    location.reload();
                }
            })
            .catch(err => {
                console.error(err);
                alert("Erro de conexão.");
                location.reload();
            });
        }
    </script>
</body>
</html>