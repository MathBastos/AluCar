<?php
include_once "conexao.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id_reserva = $_GET["id_reserva"];

$queryCalculo = "CALL CONFIRMA_RESERVA($id_reserva)";
$resultadoCalculo = $conn->prepare($queryCalculo);
$resultadoCalculo ->execute();

$retorno = "Reserva Confirmada";

echo json_encode($retorno);