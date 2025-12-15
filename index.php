<?php
require('includes/connection.php');

// BUSCAR DADOS: HALLOWEEN (ID 8) ---
$sqlH = "SELECT l.id, l.titulo, l.imagem_capa, a.nome as nome_autor 
         FROM livros l 
         LEFT JOIN autores a ON l.autor_id = a.id 
         WHERE l.categoria_id = 8 AND l.ativo = 1 LIMIT 6";
$stmtH = $dbh->prepare($sqlH);
$stmtH->execute();
$db_halloween = $stmtH->fetchAll(PDO::FETCH_ASSOC);

// Vai buscar os 6 últimos livros inseridos na base de dados (qualquer categoria)
$sqlN = "SELECT l.id, l.titulo, l.imagem_capa, a.nome as nome_autor 
         FROM livros l 
         LEFT JOIN autores a ON l.autor_id = a.id 
         WHERE l.ativo = 1
         ORDER BY l.id DESC LIMIT 6"; 
$stmtN = $dbh->prepare($sqlN);
$stmtN->execute();
$db_novidades = $stmtN->fetchAll(PDO::FETCH_ASSOC);

// BUSCAR LIVRO EM FOCO ---
$id_fixo = 32; 

$sqlF = "SELECT l.id, l.titulo, l.imagem_capa, a.nome as nome_autor 
         FROM livros l 
         LEFT JOIN autores a ON l.autor_id = a.id 
         WHERE l.id = :id AND l.ativo = 1";

$stmtF = $dbh->prepare($sqlF);
$stmtF->bindValue(':id', $id_fixo);
$stmtF->execute();
$foco = $stmtF->fetch(PDO::FETCH_ASSOC);

// BUSCAR DADOS: CARROSSEL (IDs 7, 5, 12) ---
$sqlC = "SELECT * FROM categorias WHERE id IN (7, 5, 12)";
$stmtC = $dbh->prepare($sqlC);
$stmtC->execute();
$carousel_cats = $stmtC->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Letrário Coimbra</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="css/home.css">
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
        
        <div class="hero-banner position-relative">
          <img width="100%" src="imgs/banner.jpeg" class="hero-img">
          <div class="hero-content text-white">
            <h1 class="fw-bold">Descobre novas leituras, vive novas histórias!</h1>
            <a href="estantedigital.php" class="btn btn-white btn-lg mt-3">Explorar →</a>
          </div>
        </div>

        <?php 
        $row_title = "Especiais de Halloween";
        $row_link = "categoria.php?tipo=halloween"; 
        
        $books = [];
        foreach($db_halloween as $db_book) {
            $books[] = [
                "img" => $db_book['imagem_capa'],
                "title" => $db_book['titulo'],
                "author" => $db_book['nome_autor'] ?? 'Autor Desconhecido',
                "link" => "livro.php?id=" . $db_book['id']
            ];
        }
        
        if(count($books) > 0) {
            include 'includes/book_row.php'; 
        }
        ?>

        <?php if ($foco): ?>
        <div class="container my-5 py-md-5">
            <div class="row align-items-center gy-4">
                
                <div class="col-12 col-md-4 order-1 order-md-2 text-center">
                    <a href="livro.php?id=<?php echo $foco['id']; ?>&origem=foco"> 
                        <img src="<?php echo htmlspecialchars($foco['imagem_capa']); ?>" class="img-fluid rounded-3 shadow-sm" style="max-width: 300px;"> 
                    </a>
                </div>
              
                <div class="col-12 col-md-7 order-2 order-md-1 text-center text-md-start">
                    <h1 class="display-6 fw-bold mb-3">O Livro em Foco</h1>
                    <p class="lead">Todas as semanas destacamos um livro especial que é o nosso Livro em Foco.</p>
                    <p>Esta semana, o destaque vai para 
                        <a href="livro.php?id=<?php echo $foco['id']; ?>&origem=foco" class="link-danger fw-bold text-decoration-none">
                            <?php echo htmlspecialchars($foco['titulo']); ?>
                        </a>, do autor <?php echo htmlspecialchars($foco['nome_autor'] ?? 'Autor Desconhecido'); ?>.
                    </p>
                </div>

            </div>
        </div>
        <?php endif; ?>

        <?php 
        $row_title = "Novidades a Não Perder";
        $row_link = "categoria.php?tipo=novidadesnperder"; 
        
        $books = [];
        foreach($db_novidades as $db_book) {
            $books[] = [
                "img" => $db_book['imagem_capa'],
                "title" => $db_book['titulo'],
                "author" => $db_book['nome_autor'] ?? 'Autor Desconhecido',
                "link" => "livro.php?id=" . $db_book['id'] . "&origem=novidadesnperder"
            ];
        }
        
        if(count($books) > 0) {
            include 'includes/book_row.php'; 
        }
        ?>

        <div id="carouselExampleAutoplaying" class="carousel slide carousel-fade mt-5" data-bs-ride="carousel" data-bs-interval="3000">
          <div class="carousel-inner">
            
            <div class="carousel-item active position-relative">
              <img src="imgs/financarousel.jpeg" class="carousel-img d-block mx-auto w-100">
                
                <div class="position-absolute bottom-0 start-0 p-4 p-lg-5">
                    <h3 class="text-white fw-bold display-6 mb-1">
                        Para Quem...
                    </h3>
                    <p class="text-white fs-5 mb-3">
                        Gosta de Literatura Financeira
                    </p>
                    <a href="categoria.php?tipo=financas" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-uppercase shadow">
                        Ver
                    </a>
                </div>
            </div>

            <div class="carousel-item position-relative">
              <img src="imgs/classcarousel.jpeg" class="carousel-img d-block mx-auto w-100">
              
              <div class="position-absolute bottom-0 start-0 p-4 p-lg-5">
                <h3 class="text-white fw-bold display-6 mb-1">
                    Para Quem...
                </h3>
                <p class="text-white fs-5 mb-3">
                    Gosta de Literatura Clássica
                </p>
                <a href="categoria.php?tipo=classica" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-uppercase shadow">
                    Ver
                </a>
              </div>
            </div>

            <div class="carousel-item position-relative">
              <img src="imgs/musicacarousel.jpeg" class="carousel-img d-block mx-auto w-100">
              
                    <div class="position-absolute bottom-0 start-0 p-4 p-lg-5">
                        <h3 class="text-white fw-bold display-6 mb-1" >
                            Para Quem...
                        </h3>
                        <p class="text-white fs-5 mb-3">
                            É amante de Música
                        </p>
                        <a href="categoria.php?tipo=musica" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-uppercase shadow">
                            Ver
                        </a>
                    </div>
            </div>

          </div>
          
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Próximo</span>
          </button>
        </div>
      
    </main>

    <?php require('includes/footer.php'); ?>

</body>
</html>