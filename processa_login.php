<?php
session_start();
include 'conexao.php'; // Inclua o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o usuário existe no banco de dados
    $sql = "SELECT id, nome, telefone, endereco FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $email;
        $_SESSION['telefone'] = $usuario['telefone'];
        $_SESSION['endereco'] = $usuario['endereco'];
        header("Location: index.html");
    } else {
        echo "Email ou senha incorretos!";
    }

    $stmt->close();
    $conn->close();
}
?>