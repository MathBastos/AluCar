<?php
include_once "conexao.php";
session_start();
$id_locadora = $_GET["id_locadora"];
$_SESSION["id_locadora"] = $id_locadora;

$retorno = "sucesso";

echo json_encode($retorno);