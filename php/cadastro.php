<?php

require_once 'conexao.php';

if (!isset($_POST['email']) || !isset($_POST['senha'])) {
    $RESPOSTA['error'] = 'Dados enviados incompletos';
    echo json_encode($RESPOSTA);
    exit();
}

$RESPOSTA['email'] = $_POST['email'];

$sql = "SELECT COUNT(*) FROM usuario WHERE email = :email";
$selecao = $CONEXAO->prepare($sql);
$selecao->bindParam(':email', $RESPOSTA['email']);
$selecao->execute();
$r = $selecao->fetch(PDO::FETCH_ASSOC);

if ($r["COUNT(*)"] > 0) {
    $RESPOSTA['error'] = 'Já existe conta cadastrada com esse email';
    echo json_encode($RESPOSTA);
    exit();
}

$RESPOSTA['senha'] = $_POST['senha'];
$RESPOSTA['senha'] = password_hash($RESPOSTA['senha'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuario (email, senha) VALUES (:email, :senha)";
$insercao = $CONEXAO->prepare($sql);
$insercao->bindParam(':email', $RESPOSTA['email']);
$insercao->bindParam(':senha', $RESPOSTA['senha']);
$insercao->execute();

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>