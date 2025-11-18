

<div class="colecao-melhor-avaliados mt-5">
    
    <!-- Título da Secção -->
    <div class="d-flex justify-content-between align-items-center mx-4">
        <div class="titulo fw-bold fs-3 ms-5"><?php echo htmlspecialchars($row_title); ?></div>
        
        <?php 
        if ($row_link): 
        ?>
            <a class="subtitulo text-decoration-none text-dark fw-semibold me-5" href="<?php echo htmlspecialchars($row_link); ?>">Ver +</a>
        <?php endif; ?>
    </div>

    <div class="container mt-4 scroll-wrapper-mobile">
        <div class="row g-4 justify-content-center horizontal-scroll-mobile">
            
            <?php 

            foreach ($books as $book): 
            ?>
                <div class="col-6 col-sm-6 col-md-3 col-lg-2">
                    <div class="card book-card h-100 border-0 shadow-sm">
                        
                        <a href="<?php echo htmlspecialchars($book['link']); ?>">
                            <img src="<?php echo htmlspecialchars($book['img']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">
                        </a>

                        <div class="card-body text-center">
                            <h6 class="card-title fw-semibold">
                                <a href="<?php echo htmlspecialchars($book['link']); ?>" class="text-decoration-none text-dark">
                                    <?php echo htmlspecialchars($book['title']); ?>
                                </a>
                            </h6>
                            <p class="card-text text-muted small mb-2"><?php echo htmlspecialchars($book['author']); ?></p>
                            <a href="<?php echo htmlspecialchars($book['link']); ?>" class="btn btn-outline-dark btn-sm">Ver mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>