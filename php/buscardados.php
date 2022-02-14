<?php

require_once 'conexao.php';

if (!isset($_POST['email'])) {
    $RESPOSTA['error'] = 'Dados enviados incompletos';
    echo json_encode($RESPOSTA);
    exit();
}

$RESPOSTA['email'] = $_POST['email'];
$RESPOSTA['roubo'] = json_decode($_POST['roubo'], true);

if ($RESPOSTA['roubo'] !== NULL && $RESPOSTA['roubo'] !== '' && mb_strtolower($RESPOSTA['roubo'] !== 'null')) {
    if ($RESPOSTA['roubo']['id_roubo']) {
        $RESPOSTA['roubo']['id_roubo'] = intval($RESPOSTA['roubo']['id_roubo']);
        
        $sql = "SELECT COUNT(*) as qtd FROM roubo r WHERE r.id_roubo = :id_roubo";
        $selecao = $CONEXAO->prepare($sql);
        $selecao->bindParam(':id_roubo', $RESPOSTA['roubo']['id_roubo']);
        $selecao->execute();
        $r = $selecao->fetchAll();
        
        if ($r[0]['qtd'] > 0) {
            $sql = "SELECT r.*, c.*, u.imagem as fotoperfil, u.nome as nome_usuario, 0 as qtd_mensagens, '[]' as mensagens FROM roubo r JOIN carro c ON c.id_carro = r.id_carro JOIN usuario u ON u.id_usuario = r.id_usuario WHERE r.id_roubo = :id_roubo";
            $selecao = $CONEXAO->prepare($sql);
            $selecao->bindParam(':id_roubo', $RESPOSTA['roubo']['id_roubo']);
            $selecao->execute();
            $r = $selecao->fetchAll();
            
            $RESPOSTA['roubo'] = $r[0];
        }
        else {
            $RESPOSTA['roubo'] = [];
            $RESPOSTA['roubo']['id_roubo'] = 0;
        }
    }
    else {
        $RESPOSTA['roubo']['id_roubo'] = 0;
    }
}
else {
    $RESPOSTA['roubo'] = [];
    $RESPOSTA['roubo']['id_roubo'] = 0;
}

$sql = "SELECT *, (SELECT COUNT(*) FROM carro c WHERE c.id_usuario = u.id_usuario) as qtd_carros, (SELECT COUNT(*) FROM roubo) as qtd_roubos FROM usuario u WHERE u.email = :email";
$selecao = $CONEXAO->prepare($sql);
$selecao->bindParam(':email', $RESPOSTA['email']);
$selecao->execute();
$r = $selecao->fetchAll();

$RESPOSTA['id_usuario'] = intval($r[0]["id_usuario"], 10);
$RESPOSTA['nome'] = $r[0]["nome"];
$RESPOSTA['cpf'] = $r[0]["cpf"];
$RESPOSTA['cep'] = $r[0]["cep"];
$RESPOSTA['cidade'] = $r[0]["cidade"];
$RESPOSTA['estado'] = $r[0]["estado"];
$RESPOSTA['imagem'] = $r[0]["imagem"];
$RESPOSTA['qtd_carros'] = $r[0]["qtd_carros"];
$RESPOSTA['qtd_roubos'] = $r[0]["qtd_roubos"];

$sql = "SELECT *, CASE WHEN (SELECT COUNT(*) FROM roubo r WHERE r.id_carro = c.id_carro) > 0 THEN 'sim' ELSE 'nao' END as roubado FROM carro c WHERE c.id_usuario = :id_usuario";
$selecao = $CONEXAO->prepare($sql);
$selecao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
$selecao->execute();
$r = $selecao->fetchAll();

$RESPOSTA['carros'] = $r;

$sql = "SELECT r.*, c.*, u.imagem as fotoperfil, u.nome as nome_usuario, 0 as qtd_mensagens, '[]' as mensagens FROM roubo r JOIN carro c ON c.id_carro = r.id_carro JOIN usuario u ON u.id_usuario = r.id_usuario";
$selecao = $CONEXAO->prepare($sql);
$selecao->execute();
$r = $selecao->fetchAll();

$RESPOSTA['roubos'] = $r;

if ($RESPOSTA['roubo']['id_roubo'] !== 0) {
    $sql = "SELECT * FROM mensagem m WHERE m.id_roubo = :id_roubo AND (m.id_usuario_enviou = :id_usuario OR m.id_usuario_recebeu = :id_usuario)";
    $selecao = $CONEXAO->prepare($sql);
    $selecao->bindParam(':id_roubo', $RESPOSTA['roubo']['id_roubo']);
    $selecao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $selecao->execute();
    $r = $selecao->fetchAll();
    
    $RESPOSTA['roubo']['mensagens'] = $r;
    
    $sql = "SELECT COUNT(*) as qtd_mensagens FROM mensagem m WHERE m.id_roubo = :id_roubo AND (m.id_usuario_enviou = :id_usuario OR m.id_usuario_recebeu = :id_usuario)";
    $selecao = $CONEXAO->prepare($sql);
    $selecao->bindParam(':id_roubo', $RESPOSTA['roubo']['id_roubo']);
    $selecao->bindParam(':id_usuario', $RESPOSTA['id_usuario']);
    $selecao->execute();
    $r = $selecao->fetchAll();
    
    $RESPOSTA['roubo']['qtd_mensagens'] = intval($r[0]['qtd_mensagens']);
}
else {
    $RESPOSTA['roubo']['mensagens'] = [];
    $RESPOSTA['roubo']['qtd_mensagens'] = 0;
}

$RESPOSTA['senha'] = '';
$RESPOSTA['status'] = 'success';

echo json_encode($RESPOSTA);

?>