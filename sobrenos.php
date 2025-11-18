<?php require('includes/connection.php'); ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós - Letrário Coimbra</title>
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
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <img src="imgs/a-photorealistic-image-of-a-modern-spaci_wn3zUQyCR5ym1SAb-JxuSA_GX0pJWXJTeS8riZ-XK3kIw.jpeg"
                         class="img-fluid rounded shadow-lg w-100">
                </div>
                <div class="col-lg-6 text-center text-lg-start">
                    <h1 class="display-5 fw-bold mb-3">A nossa missão</h1>
                    <p class="lead text-muted mb-4">
                        O "Letrário Coimbra" é mais do que um site; é uma biblioteca digital de acesso livre nascida da paixão pela literatura.
                    </p>
                    <p>
                        A nossa missão é simples: democratizar o acesso à cultura. Acreditamos que todos devem ter a oportunidade de descobrir novas histórias, independentemente de barreiras geográficas.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-light py-5">
            <div class="container">
                <div class="row text-center mb-4">
                    <div class="col-12">
                        <h2 class="fw-bold">Os Nossos Valores</h2>
                    </div>
                </div>
                <div class="row g-4">
                    <div class="col-md-4 text-center">
                        <i class="bi bi-book-half fs-1 text-dark"></i>
                        <h4 class="fw-semibold my-3">Acesso Livre</h4>
                        <p class="text-muted">Todos os livros na nossa estante são de acesso gratuito. Sem custos, sem subscrições.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-compass-fill fs-1 text-dark"></i>
                        <h4 class="fw-semibold my-3">Facilitar a Descoberta</h4>
                        <p class="text-muted">Acreditamos que encontrar o livro certo deve ser fácil e intuitivo.</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="bi bi-people-fill fs-1 text-dark"></i>
                        <h4 class="fw-semibold my-3">Comunidade</h4>
                        <p class="text-muted">Este é um espaço construído para leitores. Valorizamos a sua curadoria.</p>
                    </div>
                </div>
            </div>
        </div>

       <div class="container my-5 py-5">
            <div class="row text-center mb-5">
                <div class="col-12">
                    <h2 class="fw-bold">Quem Somos</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center text-md-start">
                    <p class="lead mb-4">O Letrário Coimbra é, acima de tudo, um projeto de paixão. Eu sou Guilherme Martinho, o fundador.</p>
                    <p class="fs-5 mb-4">Como estudante de Informática de Gestão e um leitor ávido, senti a necessidade de criar um espaço digital rico e gratuito.</p>
                    <p class="fs-5">Trato pessoalmente da gestão das coleções e da manutenção da plataforma.</p>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-secondary text-white">
            <div class="container text-center py-5">
                <h2 class="display-5 fw-bold mb-3">Junte-se à nossa comunidade</h2>
                <p class="lead mb-4">O seu próximo livro favorito está à sua espera.</p>
                <a href="estantedigital.php" class="btn btn-light btn-lg fw-bold px-4 rounded-pill">Explorar a Estante</a>
            </div>
        </div>
    </main>

<?php require('includes/footer.php'); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>