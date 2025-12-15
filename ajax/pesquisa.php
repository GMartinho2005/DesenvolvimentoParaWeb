<?php
header('Content-Type: application/json');
require('../includes/connection.php');

$input = file_get_contents('php://input');
$data = json_decode($input, true);
$termo_original = $data['termo'] ?? '';

// Se for muito curto, não devolve nada
if (empty($termo_original) || strlen($termo_original) < 2) {
    echo json_encode(['livros' => []]);
    exit;
}

// Padrões de pesquisa (Começa com... OU Termina com...)
$termo_inicio = $termo_original . '%';
$termo_fim    = '%' . $termo_original;

try {
    // PESQUISAR APENAS LIVROS ATIVOS
    $sqlLivros = "SELECT l.id, l.titulo, a.nome as autor 
                  FROM livros l 
                  LEFT JOIN autores a ON l.autor_id = a.id
                  WHERE (l.titulo LIKE :inicio OR l.titulo LIKE :fim) AND l.ativo = 1
                  LIMIT 5";
                  
    $stmtL = $dbh->prepare($sqlLivros);
    $stmtL->execute([
        ':inicio' => $termo_inicio,
        ':fim'    => $termo_fim
    ]);
    $livros = $stmtL->fetchAll(PDO::FETCH_ASSOC);

    // Devolve apenas a lista de livros
    echo json_encode(['livros' => $livros]);

} catch (Exception $e) {
    echo json_encode(['livros' => []]);
}
?>