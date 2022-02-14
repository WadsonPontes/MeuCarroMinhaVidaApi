<?php

date_default_timezone_set("America/Fortaleza");
// error_reporting(0);
error_reporting(E_ALL);

require_once 'util.php';

$__SERVIDOR = "localhost";
$__USUARIO = "root";
$__SENHA = "";
$__BANCO = "meucarro";
$CONEXAO = NULL;
$RESPOSTA = [];
$RESPOSTA["status"] = "error";

try {
    $CONEXAO = new PDO("mysql:host=".$__SERVIDOR.";dbname=".$__BANCO.";charset=utf8", $__USUARIO, $__SENHA);
    $CONEXAO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $CONEXAO->query("SET time_zone = '-03:00'");
}
catch (PDOException $e) {
    $RESPOSTA["error"] = "Falha na conexão: " . $e->getMessage();
}

?>