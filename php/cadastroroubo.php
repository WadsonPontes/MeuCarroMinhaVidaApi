<?php

require_once 'conexao.php';

$RESPOSTA['id_carro'] = intval($_POST['id_carro'], 10);
$RESPOSTA['id_usuario'] = intval($_POST['id_usuario'], 10);
$RESPOSTA['cep'] = $_POST['cep'];
$RESPOSTA['endereco'] = $_POST['endereco'];
$RESPOSTA['bairro'] = $_POST['bairro'];
$RESPOSTA['cidade'] = $_POST['cidade'];
$RESPOSTA['estado'] = $_POST['estado'];
$RESPOSTA['pais'] = $_POST['pais'];
$RESPOSTA['data'] = $_POST['data'];
$RESPOSTA['hora'] = $_POST['hora'];
$RESPOSTA['complemento'] = $_POST['complemento'];
$RESPOSTA['recompensa'] = floatval($_POST['recompensa']);

$sql = "INSERT INTO roubo (id_carro, id_usuario, cep, endereco, bairro, cidade, estado, pais, data, hora, complemento, recompensa) VALUES (:id_carro, :id_usuario, :cep, :endereco, :bairro, :cidade, :estado, :pais, :data, :hora, :complemento, :recompensa)";
$insercao = $CONEXAO->prepare($sql);
$insercao->bindParam(':id_carro', $RESPOSTA['id_carro']);
$insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
$insercao->bindParam(':cep', $RESPOSTA['cep']);
$insercao->bindParam(':endereco', $RESPOSTA['endereco']);
$insercao->bindParam(':bairro', $RESPOSTA['bairro']);
$insercao->bindParam(':cidade', $RESPOSTA['cidade']);
$insercao->bindParam(':estado', $RESPOSTA['estado']);
$insercao->bindParam(':pais', $RESPOSTA['pais']);
$insercao->bindParam(':data', $RESPOSTA['data']);
$insercao->bindParam(':hora', $RESPOSTA['hora']);
$insercao->bindParam(':complemento', $RESPOSTA['complemento']);
$insercao->bindParam(':recompensa', $RESPOSTA['recompensa']);
$insercao->execute();

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>