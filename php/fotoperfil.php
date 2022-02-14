<?php

require_once 'conexao.php';

if (!isset($_POST['email']) || !isset($_POST['senha'])) {
    $RESPOSTA['error'] = 'Dados enviados incompletos';
    echo json_encode($RESPOSTA);
    exit();
}

$caminho = 'files/';
$caminho .= basename($_FILES['imagem']['name']);
$RESPOSTA['imagem'] = $caminho;
$RESPOSTA['email'] = $_POST['email'];
$RESPOSTA['senha'] = $_POST['senha'];

$sql = "UPDATE usuario SET imagem = :imagem WHERE email = :email";
$insercao = $CONEXAO->prepare($sql);
$insercao->bindParam(':email', $RESPOSTA['email']);
$insercao->bindParam(':imagem', $RESPOSTA['imagem']);
$insercao->execute();

move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>