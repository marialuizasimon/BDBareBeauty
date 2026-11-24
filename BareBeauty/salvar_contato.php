<?php
require_once "conexao.php";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        die("Acesso inválido.");
    }

    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $assunto = trim($_POST["assunto"] ?? "");
    $mensagem = trim($_POST["mensagem"] ?? "");

    if ($nome === "" || $email === "" || $mensagem === "") {
        die("Preencha todos os campos obrigatórios.");
    }

    $sql = "INSERT INTO contatos (nome, email, assunto, mensagem)
            VALUES (?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $assunto, $mensagem);
    $stmt->execute();

    echo "Deu certo krl";

    $stmt->close();

} catch (mysqli_sql_exception $e) {
    echo "Deu merda de novo: " . htmlspecialchars($e->getMessage());
}
?>