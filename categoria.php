<?php
require('includes/connection.php');

// --- CONFIGURAÇÃO DA PAGINAÇÃO ---
$limite_padrao = 8; 
$pagina = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($pagina - 1) * $limite_padrao;

// Identificar o tipo
$tipo_categoria = isset($_GET['tipo']) ? $_GET['tipo'] : 'ficcao';

// Buscar Info da Categoria
$sqlCat = "SELECT * FROM categorias WHERE nome_url = :tipo" ;
$stmtCat = $dbh->prepare($sqlCat);
$stmtCat->bindValue(':tipo', $tipo_categoria);
$stmtCat->execute();
$categoria = $stmtCat->fetch(PDO::FETCH_ASSOC);

if (!$categoria) die("Página não encontrada.");

// --- PREPARAR QUERY INTELIGENTE ---
$sqlBase = "SELECT l.*, 
                   COUNT(a.id) as reviews, 
                   COALESCE(AVG(a.estrelas), 0) as rating 
            FROM livros l
            LEFT JOIN avaliacoes a ON l.id = a.livro_id ";

$total_registos = 0;
$limite_sql = $limite_padrao; 
$link_extra = ''; // Variável para passar a origem no URL

if ($tipo_categoria == 'melhoravaliados') {
    // --- MELHOR AVALIADOS ---
    $stmtCount = $dbh->query("SELECT COUNT(*) FROM livros WHERE ativo = 1");
    $real_total = $stmtCount->fetchColumn();
    $total_registos = min($real_total, 8);

    $restantes = 8 - $offset;
    $limite_sql = ($restantes > 0) ? min($limite_padrao, $restantes) : 0;

    $sqlFinal = $sqlBase . " WHERE l.ativo = 1 GROUP BY l.id ORDER BY rating DESC, reviews DESC LIMIT :limite OFFSET :offset";
    $stmtLivros = $dbh->prepare($sqlFinal);
    
    $link_extra = '&origem=melhoravaliados';

} elseif ($tipo_categoria == 'novidadesnperder') {
    // --- NOVIDADES ---
    $stmtCount = $dbh->query("SELECT COUNT(*) FROM livros WHERE ativo = 1");
    $real_total = $stmtCount->fetchColumn();
    $total_registos = min($real_total, 10);

    $restantes = 10 - $offset;
    $limite_sql = ($restantes > 0) ? min($limite_padrao, $restantes) : 0;

    $sqlFinal = $sqlBase . " WHERE l.ativo = 1 GROUP BY l.id ORDER BY l.id DESC LIMIT :limite OFFSET :offset";
    $stmtLivros = $dbh->prepare($sqlFinal);
    
    $link_extra = '&origem=novidadesnperder';

} else {
    // --- CATEGORIA NORMAL ---
    $stmtCount = $dbh->prepare("SELECT COUNT(*) FROM livros WHERE categoria_id = :cat_id AND ativo = 1");
    $stmtCount->bindValue(':cat_id', $categoria['id']);
    $stmtCount->execute();
    $total_registos = $stmtCount->fetchColumn();

    $limite_sql = $limite_padrao;

    $sqlFinal = $sqlBase . " WHERE l.categoria_id = :cat_id AND l.ativo = 1 GROUP BY l.id LIMIT :limite OFFSET :offset";
    $stmtLivros = $dbh->prepare($sqlFinal);
    $stmtLivros->bindValue(':cat_id', $categoria['id']);
}

$total_paginas = ceil($total_registos / $limite_padrao);

$stmtLivros->bindValue(':limite', $limite_sql, PDO::PARAM_INT);
$stmtLivros->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtLivros->execute();
$livros = $stmtLivros->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($categoria['nome']); ?> - Letrário Coimbra</title>
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

<div class="flex-grow-1">
    
    <?php 
    $tem_banner = !empty($categoria['imagem_banner']) && $categoria['imagem_banner'] !== 'NULL'; 
    ?>

    <?php if ($tem_banner): ?>
        <div class="banner-container position-relative text-white banner-img-container">
            <img src="<?php echo htmlspecialchars($categoria['imagem_banner']); ?>" class="banner-img">
            <div class="banner-content mx-auto p-3 p-md-0 text-center text-md-start">
                <h1 class="fw-bold display-6"><?php echo htmlspecialchars($categoria['titulo_banner'] ?? $categoria['nome']); ?></h1>
            </div>
        </div>
    <?php else: ?>
        <div class="mt-5"></div> 
    <?php endif; ?>

    <div class="container my-5">
        
        <div class="pb-3 mb-4 border-bottom">
            <h1 class="h2 fw-bold"><?php echo htmlspecialchars($categoria['nome']); ?></h1>
            <?php if(!empty($categoria['texto_intro'])): ?>
                <p class="text-muted"><?php echo htmlspecialchars($categoria['texto_intro']); ?></p>
            <?php endif; ?>
        </div>

        <div class="row">
            <?php if (count($livros) > 0): ?>
                <?php foreach ($livros as $livro): ?>
                
                <div class="col-lg-6 mb-4">
                    <div class="row g-3 g-md-4">
                        <div class="col-4">
                            <a href="livro.php?id=<?php echo $livro['id'] . $link_extra; ?>">
                                <img src="<?php echo htmlspecialchars($livro['imagem_capa']); ?>" class="img-fluid rounded shadow-sm" alt="Capa">
                            </a>
                        </div>
                        
                        <div class="col-8">
                            <h5 class="fw-bold mb-1">
                                <a href="livro.php?id=<?php echo $livro['id'] . $link_extra; ?>" class="text-dark text-decoration-none">
                                    <?php echo htmlspecialchars($livro['titulo']); ?>
                                </a>
                            </h5>
                            
                            <p class="small text-muted mb-2">de <?php echo htmlspecialchars($livro['autor']); ?></p>

                            <div class="rating-stars mb-2" title="Média: <?php echo round($livro['rating'], 1); ?>">
                               <?php 
                                $media = round($livro['rating']);
                                for ($i = 1; $i <= 5; $i++):
                                    echo ($i <= $media) ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                                endfor; 
                                ?>
                                <span class="small text-muted ms-1">(<?php echo $livro['reviews']; ?>)</span>
                            </div>

                            <p class="text-muted d-none d-md-block mt-2" style="font-size: 0.9rem;">
                                <?php echo htmlspecialchars($livro['descricao_curta']); ?>
                            </p>

                            <a href="livro.php?id=<?php echo $livro['id'] . $link_extra; ?>" class="btn rounded-pill btn-outline-dark btn-sm mt-1">
                                Ver mais
                            </a>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Ainda não há livros disponíveis nesta secção.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if ($total_paginas > 1): ?>
        <div class="mt-4">
            <ul class="pagination justify-content-center">
                
                <li class="page-item <?php if($pagina <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pagina <= 1){ echo '#'; } else { echo "?tipo=$tipo_categoria&page=".($pagina - 1); } ?>">Anterior</a>
                </li>

                <?php for($i = 1; $i <= $total_paginas; $i++): ?>
                    <li class="page-item <?php if($pagina == $i) { echo 'active'; } ?>">
                        <a class="page-link" href="?tipo=<?php echo $tipo_categoria; ?>&page=<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?php if($pagina >= $total_paginas){ echo 'disabled'; } ?>">
                    <a class="page-link" href="<?php if($pagina >= $total_paginas){ echo '#'; } else { echo "?tipo=$tipo_categoria&page=".($pagina + 1); } ?>">Próximo</a>
                </li>

            </ul>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php require('includes/footer.php'); ?>

</body>
</html>