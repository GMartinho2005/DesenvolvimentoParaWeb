<?php
// 1. Inicia a sessão
session_start();

// 2. Remove todas as variáveis da sessão
session_unset();

// 3. Destrói a sessão
session_destroy();

// 4. Redireciona para a página inicial
header("Location: index.php");
exit;
?>