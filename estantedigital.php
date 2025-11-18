<?php require('includes/connection.php'); ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Estante Digital - Letrário Coimbra</title>
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

    <div class="container my-5 flex-grow-1">
        <div class="pb-3 mb-4 border-bottom">
            <h1 class="h2 fw-bold">Estante Digital</h1>
            <p class="text-muted">Explore todas as nossas categorias.</p>
        </div>

        <div class="row g-3 g-md-4">
            
            <div class="col-6 col-md-4 col-lg-2">
                <a href="romance.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_odhu84odhu84odhu.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Romance</h5>
                    </div>
                </a>
            </div>
            
             <div class="col-6 col-md-4 col-lg-2">
                <a href="ficcao.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_20ytyy20ytyy20yt.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Ficção Científica</h5>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <a href="fantasia.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_ck9jvlck9jvlck9j.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Fantasia</h5>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <a href="policial.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_vsuyyqvsuyyqvsuy.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Policial</h5>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <a href="humor.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_v5xbkwv5xbkwv5xb.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Humor</h5>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <a href="biografia.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_b3yz4hb3yz4hb3yz.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Biografia</h5>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <a href="historia.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_psqrh3psqrh3psqr.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">História</h5>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <a href="conto.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_ljahy6ljahy6ljah.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Conto</h5>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-4 col-lg-2">
                <a href="poesia.php" class="card text-white category-card shadow-sm text-decoration-none h-100">
                    <img src="imgs/Gemini_Generated_Image_x7tuekx7tuekx7tu.png" class="card-img h-100">
                    <div class="category-title-box">
                        <h5 class="card-title mb-0 fw-bold">Poesia</h5>
                    </div>
                </a>
            </div>

        </div> 
    </div>

<?php require('includes/footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>