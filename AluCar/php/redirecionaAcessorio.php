<?php
include_once "conexao.php";
session_start();
$id_acessorio = $_GET["id_acessorio"];
$_SESSION["id_acessorio"] = $id_acessorio;

$retorno = "sucesso";

echo json_encode($retorno);