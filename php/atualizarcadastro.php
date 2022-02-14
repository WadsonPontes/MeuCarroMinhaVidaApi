<?php

require_once 'conexao.php';

if (!isset($_POST['id_usuario']) || !isset($_POST['email']) || !isset($_POST['senha']) || !isset($_POST['nome']) || !isset($_POST['cpf']) || !isset($_POST['cep']) || !isset($_POST['cidade']) || !isset($_POST['estado'])) {
    $RESPOSTA['error'] = 'Dados enviados incompletos';
    echo json_encode($RESPOSTA);
    exit();
}

$RESPOSTA['id_usuario'] = intval($_POST['id_usuario']);
$RESPOSTA['email'] = $_POST['email'];
$RESPOSTA['senha'] = $_POST['senha'];
$RESPOSTA['nome'] = $_POST['nome'];
$RESPOSTA['cpf'] = $_POST['cpf'];
$RESPOSTA['cep'] = $_POST['cep'];
$RESPOSTA['cidade'] = $_POST['cidade'];
$RESPOSTA['estado'] = $_POST['estado'];

if (trim($RESPOSTA['email'])) {
    $sql = "SELECT COUNT(*) FROM usuario WHERE email = :email AND id_usuario != :id_usuario";
    $selecao = $CONEXAO->prepare($sql);
    $selecao->bindParam(':email', $RESPOSTA['email']);
    $selecao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $selecao->execute();
    $r = $selecao->fetch(PDO::FETCH_ASSOC);
    
    if ($r["COUNT(*)"] > 0) {
        $RESPOSTA['error'] = 'Já existe conta cadastrada com esse email';
        echo json_encode($RESPOSTA);
        exit();
    }
    
    $sql = "UPDATE usuario SET email = :email WHERE id_usuario = :id_usuario";
    $insercao = $CONEXAO->prepare($sql);
    $insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $insercao->bindParam(':email', $RESPOSTA['email']);
    $insercao->execute();
}

if (trim($RESPOSTA['senha'])) {
    $RESPOSTA['senha'] = password_hash($RESPOSTA['senha'], PASSWORD_DEFAULT);
    
    $sql = "UPDATE usuario SET senha = :senha WHERE id_usuario = :id_usuario";
    $insercao = $CONEXAO->prepare($sql);
    $insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $insercao->bindParam(':senha', $RESPOSTA['senha']);
    $insercao->execute();
}

if (trim($RESPOSTA['nome'])) {
    $sql = "UPDATE usuario SET nome = :nome WHERE id_usuario = :id_usuario";
    $insercao = $CONEXAO->prepare($sql);
    $insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $insercao->bindParam(':nome', $RESPOSTA['nome']);
    $insercao->execute();
}

if (trim($RESPOSTA['cpf'])) {
    $sql = "UPDATE usuario SET cpf = :cpf WHERE id_usuario = :id_usuario";
    $insercao = $CONEXAO->prepare($sql);
    $insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $insercao->bindParam(':cpf', $RESPOSTA['cpf']);
    $insercao->execute();
}

if (trim($RESPOSTA['cep'])) {
    $sql = "UPDATE usuario SET cep = :cep WHERE id_usuario = :id_usuario";
    $insercao = $CONEXAO->prepare($sql);
    $insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $insercao->bindParam(':cep', $RESPOSTA['cep']);
    $insercao->execute();
}

if (trim($RESPOSTA['cidade'])) {
    $sql = "UPDATE usuario SET cidade = :cidade WHERE id_usuario = :id_usuario";
    $insercao = $CONEXAO->prepare($sql);
    $insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $insercao->bindParam(':cidade', $RESPOSTA['cidade']);
    $insercao->execute();
}

if (trim($RESPOSTA['estado'])) {
    $sql = "UPDATE usuario SET estado = :estado WHERE id_usuario = :id_usuario";
    $insercao = $CONEXAO->prepare($sql);
    $insercao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $insercao->bindParam(':estado', $RESPOSTA['estado']);
    $insercao->execute();
}

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>