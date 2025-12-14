<?php
// ajax/recomendarLivro.php
header('Content-Type: application/json');
require('../includes/connection.php');

// Receber a categoria do JavaScript
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$categoria_url = $data['categoria'] ?? '';

if (empty($categoria_url)) {
    echo json_encode(['success' => false, 'message' => 'Categoria inválida.']);
    exit;
}

try {
    // 1. Descobrir o ID e Nome da Categoria
    $stmtCat = $dbh->prepare("SELECT id, nome FROM categorias WHERE nome_url = ?");
    $stmtCat->execute([$categoria_url]);
    $cat = $stmtCat->fetch(PDO::FETCH_ASSOC);

    if (!$cat) {
        // Fallback se não encontrar (ex: manda um livro de ficção)
        $cat = ['id' => 1, 'nome' => 'Ficção Científica'];
    }

    // 2. Buscar um livro aleatório dessa categoria
    // Fazemos JOIN com autores para ter o nome do autor
    $sql = "SELECT l.id, l.titulo, l.imagem_capa, a.nome as nome_autor 
            FROM livros l 
            LEFT JOIN autores a ON l.autor_id = a.id
            WHERE l.categoria_id = :cid 
            ORDER BY RAND() LIMIT 1";
            
    $stmtBook = $dbh->prepare($sql);
    $stmtBook->execute([':cid' => $cat['id']]);
    $livro = $stmtBook->fetch(PDO::FETCH_ASSOC);

    if ($livro) {
        echo json_encode([
            'success' => true,
            'categoria_nome' => $cat['nome'],
            'livro' => [
                'id' => $livro['id'],
                'titulo' => $livro['titulo'],
                'autor' => $livro['nome_autor'] ?? 'Autor Desconhecido',
                'imagem' => $livro['imagem_capa']
            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nenhum livro encontrado nesta categoria.']);
    }

} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erro de servidor.']);
}
exit;
?>