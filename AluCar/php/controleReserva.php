<?php
include_once "conexao.php";
session_start();
$id_usuario = $_SESSION["id_usuario"];

$contador = 0;
$sql_fk_usuario = "SELECT * FROM locadora WHERE id_usuario = :id_usuario";
$pega_dados_usuario = $conn->prepare($sql_fk_usuario);
$pega_dados_usuario->bindParam(':id_usuario', $id_usuario);
$pega_dados_usuario->execute();

$row = $pega_dados_usuario->rowCount();
$dados_usuario = $pega_dados_usuario->fetch(PDO::FETCH_ASSOC);
$id_locadora = $dados_usuario['id_locadora'];

$query_veiculo = 
"SELECT r.id_reserva, u.nome, v.modelo, r.valor, r.status_carro, r.data_inicio, r.data_final
    FROM reserva AS r 
        INNER JOIN locatario AS l 
            ON r.id_locatario = l.id_locatario 
        INNER JOIN veiculo AS v 
            ON r.id_veiculo = v.id_veiculo 
        INNER JOIN usuario AS u 
            ON l.id_usuario = u.id_usuario
        INNER JOIN locadora AS lc
            ON v.id_locadora = lc.id_locadora
    WHERE lc.id_locadora = :id_locadora
";

$pega_dados = $conn->prepare($query_veiculo);
$pega_dados->bindParam(':id_locadora', $id_locadora);
$pega_dados->execute();

while($row_reserva = $pega_dados->fetch(PDO::FETCH_ASSOC)){
    
    $retorno[$contador]["id"] = $row_reserva["id_reserva"];
    $retorno[$contador]["nome"] = $row_reserva["nome"];
    $retorno[$contador]["data_inicio"] = $row_reserva["data_inicio"];
    $retorno[$contador]["data_final"] = $row_reserva["data_final"];
    $retorno[$contador]["modelo"] = $row_reserva["modelo"];
    $retorno[$contador]["valor"] = $row_reserva["valor"];
    $retorno[$contador]["status_carro"] = $row_reserva["status_carro"];

    $contador++;
}
echo json_encode($retorno);