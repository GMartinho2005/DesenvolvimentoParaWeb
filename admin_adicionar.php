<?php
require('includes/connection.php');

// 1. BUSCAR DADOS PARA AS DROPDOWNS
$cats = $dbh->query("SELECT * FROM categorias ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$autores = $dbh->query("SELECT * FROM autores ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// 2. PROCESSAR O FORMULÁRIO
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Dados básicos
    $titulo = $_POST['titulo'];
    $categoria_id = (int)$_POST['categoria_id'];
    $editora = $_POST['editora'];
    $isbn = $_POST['isbn'];
    $paginas = $_POST['paginas'];
    $idioma = $_POST['idioma'];
    $edicao = $_POST['edicao'];
    $sinopse = $_POST['sinopse_completa'];
    $descricao_curta = $_POST['descricao_curta'];
    
    // --- LÓGICA INTELIGENTE DE AUTOR ---
    $autor_id = 0;
    $nome_autor_txt = "";

    // Verificar se o utilizador preencheu o campo "Novo Autor"
    if (!empty($_POST['novo_autor_nome'])) {
        
        // 1. Criar o novo autor na tabela 'autores'
        $novo_nome = $_POST['novo_autor_nome'];
        $nova_bio = $_POST['novo_autor_bio'] ?? ''; // Pode vir vazio

        $sqlAutor = "INSERT INTO autores (nome, biografia) VALUES (:nome, :bio)";
        $stmtAutor = $dbh->prepare($sqlAutor);
        $stmtAutor->execute([':nome' => $novo_nome, ':bio' => $nova_bio]);
        
        // 2. Obter o ID que acabou de ser criado (Magia do PDO)
        $autor_id = $dbh->lastInsertId();
        $nome_autor_txt = $novo_nome;

    } else {
        // Se não escreveu nada novo, usa o ID da lista (dropdown)
        $autor_id = (int)$_POST['autor_id'];
        
        // Buscar o nome do autor existente para guardar o texto na tabela livros
        foreach($autores as $a) {
            if($a['id'] == $autor_id) { $nome_autor_txt = $a['nome']; break; }
        }
    }

    // 3. UPLOAD DA IMAGEM
    $caminho_imagem = "";
    if (isset($_FILES['imagem_capa']) && $_FILES['imagem_capa']['error'] == 0) {
        $extensao = pathinfo($_FILES['imagem_capa']['name'], PATHINFO_EXTENSION);
        $novo_nome_img = "livro_" . uniqid() . "." . $extensao;
        $destino = "imgs/" . $novo_nome_img;
        
        if (move_uploaded_file($_FILES['imagem_capa']['tmp_name'], $destino)) {
            $caminho_imagem = $destino;
        }
    }

    // 4. GRAVAR O LIVRO
    // Se o user não selecionou nem criou autor, dá erro (opcional, aqui assume 0)
    if($autor_id > 0) {
        $sql = "INSERT INTO livros (titulo, categoria_id, autor_id, autor, editora, isbn, paginas, idioma, edicao, sinopse_completa, descricao_curta, imagem_capa, ativo) 
                VALUES (:titulo, :cat_id, :aut_id, :aut_nome, :editora, :isbn, :paginas, :idioma, :edicao, :sinopse, :desc_curta, :img, 1)";
        
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
            ':img' => $caminho_imagem
        ];

        if ($stmt->execute($params)) {
            header("Location: admin.php?sucesso=1");
            exit;
        } else {
            $erro = "Erro ao gravar na base de dados.";
        }
    } else {
        $erro = "Tens de selecionar um autor ou criar um novo.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Livro - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5" style="max-width: 800px;">
    <h2 class="mb-4">Adicionar Novo Livro</h2>
    
    <?php if(isset($erro)): ?>
        <div class="alert alert-danger"><?php echo $erro; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        
        <div class="row mb-3">
            <div class="col-md-12">
                <label class="form-label fw-bold">Título do Livro</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>
        </div>

        <div class="card bg-light border-0 p-3 mb-4">
            <h5 class="fs-6 fw-bold text-primary mb-3">Quem é o Autor?</h5>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label small text-muted">Selecionar Existente</label>
                    <select name="autor_id" class="form-select">
                        <option value="">-- Escolha da lista --</option>
                        <?php foreach($autores as $autor): ?>
                            <option value="<?php echo $autor['id']; ?>"><?php echo htmlspecialchars($autor['nome']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6 border-start">
                    <label class="form-label small text-muted">Ou Criar Novo</label>
                    <input type="text" name="novo_autor_nome" class="form-control mb-2" placeholder="Nome do Novo Autor">
                    <textarea name="novo_autor_bio" class="form-control form-control-sm" rows="2" placeholder="Pequena biografia (opcional)"></textarea>
                </div>
            </div>
            <div class="form-text mt-2 text-center">Se preencheres o lado direito (Criar Novo), a seleção da esquerda será ignorada.</div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Categoria</label>
                <select name="categoria_id" class="form-select" required>
                    <option value="">Escolha uma categoria...</option>
                    <?php foreach($cats as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['nome']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Editora</label>
                <input type="text" name="editora" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label">ISBN</label>
                <input type="text" name="isbn" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Páginas</label>
                <input type="number" name="paginas" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label">Idioma</label>
                <input type="text" name="idioma" class="form-control" value="Português">
            </div>
            <div class="col-md-3">
                <label class="form-label">Edição</label>
                <input type="text" name="edicao" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Descrição Curta</label>
            <input type="text" name="descricao_curta" class="form-control" maxlength="150">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Sinopse Completa</label>
            <textarea name="sinopse_completa" class="form-control" rows="5"></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold text-primary">Imagem de Capa</label>
            <input type="file" name="imagem_capa" class="form-control" accept="image/*" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="admin.php" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success px-5 fw-bold">Gravar Livro</button>
        </div>

    </form>
</div>

</body>
</html>