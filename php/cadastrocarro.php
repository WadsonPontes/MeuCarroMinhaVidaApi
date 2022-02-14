<?php

require_once 'conexao.php';

if (!isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['placa']) || !isset($_POST['modelo']) || !isset($_POST['cor']) || !isset($_POST['ano'])) {
    $RESPOSTA['error'] = 'Dados enviados incompletos';
    echo json_encode($RESPOSTA);
    exit();
}

$caminho = 'files/';
$caminho .= basename($_FILES['imagem']['name']);
$RESPOSTA['imagem'] = $caminho;
$RESPOSTA['placa'] = $_POST['placa'];
$RESPOSTA['modelo'] = $_POST['modelo'];
$RESPOSTA['cor'] = $_POST['cor'];
$RESPOSTA['ano'] = intval($_POST['ano'], 10);
$RESPOSTA['email'] = $_POST['email'];
$RESPOSTA['senha'] = $_POST['senha'];

$sql = "SELECT * FROM usuario WHERE email = :email";
$selecao = $CONEXAO->prepare($sql);
$selecao->bindParam(':email', $RESPOSTA['email']);
$selecao->execute();
$r = $selecao->fetchAll();

$RESPOSTA['id_usuario'] = intval($r[0]['id_usuario'], 10);

$sql = "INSERT INTO carro (id_usuario, placa, modelo, cor, ano, imagem) VALUES (:id_usuario, :placa, :modelo, :cor, :ano, :imagem)";
$insercao = $CONEXAO->prepare($sql);
$insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
$insercao->bindParam(':placa', $RESPOSTA['placa']);
$insercao->bindParam(':modelo', $RESPOSTA['modelo']);
$insercao->bindParam(':cor', $RESPOSTA['cor']);
$insercao->bindParam(':ano', $RESPOSTA['ano']);
$insercao->bindParam(':imagem', $RESPOSTA['imagem']);
$insercao->execute();

move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>