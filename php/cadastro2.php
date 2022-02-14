<?php

require_once 'conexao.php';

if (!isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['nome']) || !isset($_POST['cpf']) || !isset($_POST['cep']) || !isset($_POST['cidade']) || !isset($_POST['estado'])) {
    $RESPOSTA['error'] = 'Dados enviados incompletos';
    echo json_encode($RESPOSTA);
    exit();
}

$RESPOSTA['nome'] = $_POST['nome'];
$RESPOSTA['cpf'] = $_POST['cpf'];
$RESPOSTA['cep'] = $_POST['cep'];
$RESPOSTA['cidade'] = $_POST['cidade'];
$RESPOSTA['estado'] = $_POST['estado'];
$RESPOSTA['email'] = $_POST['email'];
$RESPOSTA['senha'] = $_POST['senha'];
$RESPOSTA['senha'] = password_hash($RESPOSTA['senha'], PASSWORD_DEFAULT);

$sql = "UPDATE usuario SET nome = :nome, cpf = :cpf, cep = :cep, cidade = :cidade, estado = :estado WHERE email = :email";
$insercao = $CONEXAO->prepare($sql);
$insercao->bindParam(':nome', $RESPOSTA['nome']);
$insercao->bindParam(':cpf', $RESPOSTA['cpf']);
$insercao->bindParam(':cep', $RESPOSTA['cep']);
$insercao->bindParam(':cidade', $RESPOSTA['cidade']);
$insercao->bindParam(':estado', $RESPOSTA['estado']);
$insercao->bindParam(':email', $RESPOSTA['email']);
$insercao->execute();

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>