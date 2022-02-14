<?php

require_once 'conexao.php';

$RESPOSTA['id_roubo'] = $_POST['id_roubo'];
$RESPOSTA['id_usuario_enviou'] = $_POST['id_usuario_enviou'];
$RESPOSTA['id_usuario_recebeu'] = $_POST['id_usuario_recebeu'];
$RESPOSTA['mensagem'] = $_POST['mensagem'];

$sql = "INSERT INTO mensagem (id_roubo, id_usuario_enviou, id_usuario_recebeu, mensagem) VALUES (:id_roubo, :id_usuario_enviou, :id_usuario_recebeu, :mensagem)";
$insercao = $CONEXAO->prepare($sql);
$insercao->bindParam(':id_roubo', $RESPOSTA['id_roubo']);
$insercao->bindParam(':id_usuario_enviou', $RESPOSTA['id_usuario_enviou']);
$insercao->bindParam(':id_usuario_recebeu', $RESPOSTA['id_usuario_recebeu']);
$insercao->bindParam(':mensagem', $RESPOSTA['mensagem']);
$insercao->execute();

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>