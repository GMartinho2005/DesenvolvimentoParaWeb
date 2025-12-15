<?php
// DETEÇÃO INTELIGENTE
// Verifica se o ficheiro que está a ser executado está dentro da pasta 'ajax'.
// Se estiver, pára imediatamente. Isto impede que o código <script>
// estrague o JSON das funcionalidades (login, favoritos, password).
if (strpos($_SERVER['SCRIPT_NAME'], '/ajax/') !== false) {
    return;
}

// SEGURANÇA VISUAL
// Só executa se o user estiver logado
if (isset($_SESSION['username'])) {
    echo "
    <script>
        // O PHP diz que estás logado. Vamos ver se o Browser concorda.
        // Se não existir a chave 'sessao_ativa' no sessionStorage, 
        // significa que o browser foi fechado e reaberto.
        if (!sessionStorage.getItem('sessao_ativa')) {
            // Força o logout para limpar o PHP também
            window.location.href = 'logout.php';
        }
    </script>
    ";
}
?>