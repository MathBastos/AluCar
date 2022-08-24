<?php
include_once "conexao.php";
session_start();
$id_locatario = $_GET["id_locatario"];
$_SESSION["id_locatario"] = $id_locatario;

$retorno = "sucesso";

echo json_encode($retorno);