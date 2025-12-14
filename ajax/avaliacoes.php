<?php
header('Content-Type: application/json');

// Ajuste do caminho: '..' sobe um nível para sair da pasta ajax e entrar em includes
require('../includes/connection.php');

$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verifica se o ID foi enviado, senão define como 0
$id = isset($data['id']) ? (int)$data['id'] : 0;
$total = 0;
$media = 0;

if ($id > 0) {
    // Busca o TOTAL de avaliações e a MÉDIA das estrelas
    $sql = 'SELECT COUNT(id) AS total, AVG(estrelas) as media FROM avaliacoes WHERE livro_id = :livro_id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':livro_id', $id);
    $stmt->execute();

    if ($stmt && $stmt->rowCount() > 0) {
        $row = $stmt->fetchObject();
        $total = $row->total;
        // Se a media for null (0 avaliações), assume 0
        $media = $row->media ? (float)$row->media : 0;
    }
}

echo json_encode([
    'total' => $total, 
    'media' => $media
]);
exit;
?>