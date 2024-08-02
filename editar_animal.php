<?php
// Inicia a sessão para usar as variáveis de sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
include 'conexao.php';

// Verifica se o ID do animal foi passado na URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Obtém o ID do animal

    // Verifica se o formulário foi enviado (método POST)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtém os dados enviados pelo formulário
        $nome = $_POST['nome'];
        $especie = $_POST['especie'];
        $idade = $_POST['idade'];
        $descricao = $_POST['descricao'];
        $genero = $_POST['genero'];
        $opcao = $_POST['opcao'];
        $preco = $_POST['preco'];

        // Inicializa a variável $foto_sql como string vazia para uso posterior
        $foto_sql = "";

        // Verifica se uma nova foto foi enviada
        if ($_FILES['foto']['name']) {
            $foto = $_FILES['foto']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($foto);
            // Tenta mover o arquivo de foto enviado para o diretório de uploads
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                // Se o upload for bem-sucedido, adiciona a parte da foto na consulta SQL
                $foto_sql = ", foto=?";
            } else {
                // Exibe uma mensagem de erro se o upload falhar
                echo "Erro ao mover o arquivo da foto.";
            }
        }

        // Prepara a consulta SQL para atualizar o animal no banco de dados
        $sql = "UPDATE animais SET nome=?, especie=?, idade=?, descricao=?, genero=?, opcao_compra=?, preco=? $foto_sql WHERE id=?";
        $stmt = $conn->prepare($sql);

        // Se uma nova foto foi enviada, inclui o parâmetro da foto na consulta
        if ($foto_sql) {
            $stmt->bind_param("ssissdis", $nome, $especie, $idade, $descricao, $genero, $opcao, $preco, $foto, $id);
        } else {
            $stmt->bind_param("ssissdii", $nome, $especie, $idade, $descricao, $genero, $opcao, $preco, $id);
        }

        // Executa a consulta e verifica se foi bem-sucedida
        if ($stmt->execute()) {
            // Redireciona para o painel de administração em caso de sucesso
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Exibe uma mensagem de erro se houver falha na execução
            echo "Erro: " . $stmt->error;
        }
    }

    // Prepara a consulta SQL para buscar os dados do animal a ser editado
    $sql = "SELECT * FROM animais WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    // Obtém os dados do animal como um array associativo
    $animal = $result->fetch_assoc();
    $stmt->close();
}
?>
