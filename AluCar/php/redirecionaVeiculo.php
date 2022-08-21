<?php
include_once "conexao.php";
session_start();
$id_veiculo = $_GET["id_veiculo"];
$_SESSION["id_veiculo"] = $id_veiculo;

$retorno = "sucesso";

echo json_encode($retorno);