<?php
include_once "conexao.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$id_reserva = $_POST["id_reserva"];
$quilometragem = $_POST['quilometragem'];

$query = "CALL FINALIZA_RESERVA($id_reserva, $quilometragem)";
$resultado = $conn->prepare($query);
$resultado ->execute();

$retorno = "Reserva Finalizada";

echo json_encode($retorno);