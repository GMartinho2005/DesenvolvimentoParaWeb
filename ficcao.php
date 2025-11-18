<?php
require('includes/connection.php');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melhor Avaliados - Letrário Coimbra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/outraspag.css">

</head>
<body class="d-flex flex-column min-vh-100">

   <?php
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    // Se estiver logado, carrega o header de utilizador
    require('includes/headerlog.php');
} else {
    // Se NÃO estiver logado, carrega o header padrão
    require('includes/header.php');
}
?>


<div class="flex-grow-1">
    <div class="banner-container position-relative text-white banner-img-container">
        <img src="imgs/ficcao.jpeg" class="banner-img">
        <div class="banner-content mx-auto p-3 p-md-0 text-center text-md-start">
            <h1 class="fw-bold display-6">Para lá das estrelas, a imaginação não tem limites</h1>
        </div>
    </div>

    <div class="container my-5">

        <div class="pb-3 mb-4 border-bottom">
            <h1 class="h2 fw-bold">Ficção Científica</h1>
        </div>

        <?php
        $livros_avaliados = [
            [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "O Nome do Vento", 
                "author" => "Patrick Rothfuss", 
                "description" => "A história de Kvothe, um herói e vilão lendário, contada nas suas próprias palavras. Uma aventura de magia, música e mistério.",
                "rating" => 5,
                "reviews" => 129,
                "link" => "livro1.php"
            ],
            [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "1984", 
                "author" => "George Orwell", 
                "subtitle" => "Edição Comemorativa",
                "description" => "Num mundo distópico de vigilância total, Winston Smith luta pela verdade e pelo amor. Um clássico intemporal.",
                "rating" => 5,
                "reviews" => 245,
                "link" => "#"
            ],
            [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "A Sombra do Vento", 
                "author" => "Carlos Ruiz Zafón", 
                "subtitle" => "O Cemitério dos Livros Esquecidos: Livro 1",
                "description" => "Em Barcelona, o jovem Daniel Sempere encontra um livro que muda a sua vida e o leva a desvendar um segredo obscuro.",
                "rating" => 4,
                "reviews" => 98,
                "link" => "#"
            ],
            [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "O Pequeno Príncipe", 
                "author" => "Antoine de Saint-Exupéry", 
                "subtitle" => "",
                "description" => "Um piloto perdido no deserto encontra um pequeno príncipe vindo de outro planeta. Uma história sobre o que é essencial na vida.",
                "rating" => 5,
                "reviews" => 510,
                "link" => "#"
            ],
            [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "Harry Potter e a Pedra Filosofal", 
                "author" => "J.K. Rowling", 
                "subtitle" => "Harry Potter: Livro 1",
                "description" => "Um jovem órfão descobre que é um feiticeiro e é convidado a frequentar a Escola de Magia e Feitiçaria de Hogwarts.",
                "rating" => 5,
                "reviews" => 840,
                "link" => "#"
            ],
             [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "O Hobbit", 
                "author" => "J.R.R. Tolkien", 
                "subtitle" => "",
                "description" => "A aventura de Bilbo Baggins, um hobbit que é levado a uma demanda inesperada por um tesouro guardado por um dragão.",
                "rating" => 4,
                "reviews" => 320,
                "link" => "#"
            ],
             [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "Harry Potter e a Pedra Filosofal", 
                "author" => "J.K. Rowling", 
                "subtitle" => "Harry Potter: Livro 1",
                "description" => "Um jovem órfão descobre que é um feiticeiro e é convidado a frequentar a Escola de Magia e Feitiçaria de Hogwarts.",
                "rating" => 5,
                "reviews" => 840,
                "link" => "#"
            ],
             [
                "img" => "imgs/b1bd2a5bad30e595246e62ba2f3a3117.webp", 
                "title" => "O Hobbit", 
                "author" => "J.R.R. Tolkien", 
                "subtitle" => "",
                "description" => "A aventura de Bilbo Baggins, um hobbit que é levado a uma demanda inesperada por um tesouro guardado por um dragão.",
                "rating" => 4,
                "reviews" => 320,
                "link" => "#"
            ],
        ];
        ?>

        <div class="row">

                <?php 
                foreach ($livros_avaliados as $livro): 
                ?>
                
                <div class="col-lg-6 mb-4">
                    <div class="row g-3 g-md-4">

                        <div class="col-4">
                            <a href="<?php echo htmlspecialchars($livro['link']); ?>">
                                <img src="<?php echo htmlspecialchars($livro['img']); ?>" class="img-fluid rounded shadow-sm" alt="Capa <?php echo htmlspecialchars($livro['title']); ?>">
                            </a>
                        </div>
                        
                        <div class="col-8">
                            
                            <h5 class="fw-bold mb-1">
                                <a href="<?php echo htmlspecialchars($livro['link']); ?>" class="text-dark text-decoration-none">
                                    <?php echo htmlspecialchars($livro['title']); ?>
                                </a>
                            </h5>
                            
                            <?php if (!empty($livro['subtitle'])): ?>
                                <p class="small text-muted mb-1"><em><?php echo htmlspecialchars($livro['subtitle']); ?></em></p>
                            <?php endif; ?>

                            <p class="small text-muted mb-2">de <?php echo htmlspecialchars($livro['author']); ?></p>

                            <div class="rating-stars mb-2" title="Rating: <?php echo $livro['rating']; ?> de 5 estrelas">
                               <?php 
                                for ($i = 1; $i <= 5; $i++):
                                    if ($i <= $livro['rating']):
                                        echo '<i class="bi bi-star-fill"></i>';
                                    else:
                                        echo '<i class="bi bi-star"></i>';
                                    endif;
                                endfor; 
                                ?>
                                <span class="small text-muted ms-1">(<?php echo htmlspecialchars($livro['reviews']); ?>)</span>
                            </div>

                            <p class="text-muted d-none d-md-block mt-2" style="font-size: 0.9rem;">
                                <?php echo htmlspecialchars($livro['description']); ?>
                            </p>

                            <a href="<?php echo htmlspecialchars($livro['link']); ?>" class="btn rounded-pill btn-outline-dark btn-sm mt-1">
                                Ver mais
                            </a>
                        </div>
                    </div>
                </div>

                <?php 
                endforeach; 
                ?>

        </div>

        <div aria-label="Navegação de páginas" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled"><a class="page-link" href="#">Anterior</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="ficcao2.php">2</a></li>
                <li class="page-item"><a class="page-link" href="ficcao2.php">Próximo</a></li>
            </ul>
        </div>

    </div>


    <?php 
    require('includes/footer.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>