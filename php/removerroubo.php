<?php

require_once 'conexao.php';

if (!isset($_POST['id_carro'])) {
    $RESPOSTA['error'] = 'Dados enviados incompletos';
    echo json_encode($RESPOSTA);
    exit();
}

$RESPOSTA['id_carro'] = $_POST['id_carro'];

$sql = "DELETE FROM roubo WHERE id_carro = :id_carro";
$selecao = $CONEXAO->prepare($sql);
$selecao->bindParam(':id_carro', $RESPOSTA['id_carro']);
$selecao->execute();

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>