
<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'conexao.php';

$sql = "SELECT id, nome, mensagem, avaliacao, foto FROM depoimentos ORDER BY id DESC";

$resultado = $conexao->query($sql);

$depoimentos = [];

if ($resultado) {
    while ($linha = $resultado->fetch_assoc()) {
        $depoimentos[] = $linha;
    }
}

echo json_encode($depoimentos, JSON_UNESCAPED_UNICODE);

$conexao->close();
?>