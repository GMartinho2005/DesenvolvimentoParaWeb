<?php
require('includes/connection.php');

// 1. VERIFICAR SE TEMOS ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$id = (int)$_GET['id'];

// 2. BUSCAR OS DADOS DO LIVRO ATUAL
$stmt = $dbh->prepare("SELECT * FROM livros WHERE id = :id");
$stmt->execute([':id' => $id]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$livro) {
    die("Livro não encontrado.");
}

// 3. BUSCAR LISTAS (Categorias e Autores)
$cats = $dbh->query("SELECT * FROM categorias ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$autores = $dbh->query("SELECT * FROM autores ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// 4. PROCESSAR A GRAVAÇÃO (QUANDO CLICAS EM "ATUALIZAR")
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Receber dados de texto
    $titulo = $_POST['titulo'];
    $categoria_id = (int)$_POST['categoria_id'];
    $editora = $_POST['editora'];
    $isbn = $_POST['isbn'];
    $paginas = $_POST['paginas'];
    $idioma = $_POST['idioma'];
    $edicao = $_POST['edicao'];
    $sinopse = $_POST['sinopse_completa'];
    $descricao_curta = $_POST['descricao_curta'];
    
    // --- LÓGICA DE AUTOR (HÍBRIDA) ---
    $autor_id = 0;
    $nome_autor_txt = "";

    if (!empty($_POST['novo_autor_nome'])) {
        // Criar novo autor
        $novo_nome = $_POST['novo_autor_nome'];
        $nova_bio = $_POST['novo_autor_bio'] ?? '';

        $sqlAutor = "INSERT INTO autores (nome, biografia) VALUES (:nome, :bio)";
        $stmtAutor = $dbh->prepare($sqlAutor);
        $stmtAutor->execute([':nome' => $novo_nome, ':bio' => $nova_bio]);
        
        $autor_id = $dbh->lastInsertId();
        $nome_autor_txt = $novo_nome;
    } else {
        // Usar existente
        $autor_id = (int)$_POST['autor_id'];
        foreach($autores as $a) {
            if($a['id'] == $autor_id) { $nome_autor_txt = $a['nome']; break; }
        }
    }

    // --- LÓGICA DE IMAGEM (IMPORTANTE) ---
    // Se o utilizador carregou uma nova imagem, usamos essa.
    // Se NÃO carregou nada, mantemos a que já estava na base de dados ($livro['imagem_capa'])
    $caminho_imagem = $livro['imagem_capa']; // Começa com a antiga
    
    if (isset($_FILES['imagem_capa']) && $_FILES['imagem_capa']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem_capa']['name'], PATHINFO_EXTENSION);
        $novo_nome_img = "livro_" . uniqid() . "." . $extensao;
        $destino = "imgs/" . $novo_nome_img;
        
        if (move_uploaded_file($_FILES['imagem_capa']['tmp_name'], $destino)) {
            $caminho_imagem = $destino; // Atualiza para a nova
        }
    }

    // 5. EXECUTAR O UPDATE
    if($autor_id > 0) {
        $sql = "UPDATE livros SET 
                titulo = :titulo, 
                categoria_id = :cat_id, 
                autor_id = :aut_id, 
                autor = :aut_nome,
                editora = :editora, 
                isbn = :isbn, 
                paginas = :paginas, 
                idioma = :idioma, 
                edicao = :edicao, 
                sinopse_completa = :sinopse, 
                descricao_curta = :desc_curta, 
                imagem_capa = :img 
                WHERE id = :id";
        
        $stmt = $dbh->prepare($sql);
        $params = [
            ':titulo' => $titulo,
            ':cat_id' => $categoria_id,
            ':aut_id' => $autor_id,
            ':aut_nome' => $nome_autor_txt,
            ':editora' => $editora,
            ':isbn' => $isbn,
            ':paginas' => $paginas,
            ':idioma' => $idioma,
            ':edicao' => $edicao,
            ':sinopse' => $sinopse,
            ':desc_curta' => $descricao_curta,
            ':img' => $caminho_imagem,
            ':id' => $id
        ];

        if ($stmt->execute($params)) {
            header("Location: admin.php?editado=1");
            exit;
        } else {
            $erro = "Erro ao atualizar o livro.";
        }
    } else {
        $erro = "Autor inválido.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Editar Livro - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5" style="max-width: 800px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Editar Livro <span class="text-muted fs-5">#<?php echo $livro['id']; ?></span></h2>
        <a href="admin.php" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>
    
    <?php if(isset($erro)): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        
        <div class="mb-3">
            <label class="form-label fw-bold">Título do Livro</label>
            <input type="text" name="titulo" class="form-control" value="<?php echo htmlspecialchars($livro['titulo']); ?>" required>
        </div>

        <div class="card bg-light border-0 p-3 mb-4">
            <h5 class="fs-6 fw-bold text-primary mb-3">Autor</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small text-muted">Alterar para Existente</label>
                    <select name="autor_id" class="form-select">
                        <?php foreach($autores as $autor): ?>
                            <option value="<?php echo $autor['id']; ?>" <?php if($autor['id'] == $livro['autor_id']) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($autor['nome']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 border-start">
                    <label class="form-label small text-muted">Ou Criar Novo (Isto substitui o atual)</label>
                    <input type="text" name="novo_autor_nome" class="form-control mb-2" placeholder="Nome do Novo Autor">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Categoria</label>
                <select name="categoria_id" class="form-select" required>
                    <?php foreach($cats as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $livro['categoria_id']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($cat['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Editora</label>
                <input type="text" name="editora" class="form-control" value="<?php echo htmlspecialchars($livro['editora']); ?>">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-control" value="<?php echo htmlspecialchars($livro['isbn']); ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Páginas</label>
                <input type="number" name="paginas" class="form-control" value="<?php echo htmlspecialchars($livro['paginas']); ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Idioma</label>
                <input type="text" name="idioma" class="form-control" value="<?php echo htmlspecialchars($livro['idioma']); ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label">Edição</label>
                <input type="text" name="edicao" class="form-control" value="<?php echo htmlspecialchars($livro['edicao']); ?>">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Descrição Curta</label>
            <input type="text" name="descricao_curta" class="form-control" maxlength="150" value="<?php echo htmlspecialchars($livro['descricao_curta']); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Sinopse Completa</label>
            <textarea name="sinopse_completa" class="form-control" rows="5"><?php echo htmlspecialchars($livro['sinopse_completa']); ?></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold text-primary">Imagem de Capa</label>
            <div class="d-flex align-items-center gap-3 mb-2">
                <?php if(!empty($livro['imagem_capa'])): ?>
                    <img src="<?php echo htmlspecialchars($livro['imagem_capa']); ?>" style="height: 80px; width: auto; border: 1px solid #ddd; padding: 2px;">
                    <span class="text-muted small">Capa atual</span>
                <?php else: ?>
                    <span class="text-muted small">Sem capa definida</span>
                <?php endif; ?>
            </div>
            <input type="file" name="imagem_capa" class="form-control" accept="image/*">
            <div class="form-text">Deixa em branco para manter a imagem atual. Se carregares uma nova, a antiga será substituída.</div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="admin.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-primary px-5 fw-bold">Atualizar Livro</button>
        </div>

    </form>
</div>

</body>
</html>