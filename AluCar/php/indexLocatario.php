<?php
include_once "conexao.php";


$query = "SELECT * FROM veiculo WHERE flag_reservado='N'";
$resultado = $conn->prepare($query);
$resultado->execute();
$contador = 0;

$row = $resultado->rowCount();

while($row = $resultado->fetch(PDO::FETCH_ASSOC)){

    $query_veiculo = "SELECT * FROM locadora WHERE id_locadora = :id_locadora";
    $pega_dados = $conn->prepare($query_veiculo);
    $pega_dados->bindParam(':id_locadora', $row['id_locadora']);
    $pega_dados->execute();

    $row_veiculo = $pega_dados->fetch(PDO::FETCH_ASSOC);
    
    $retorno[$contador]["id"] = $row["id_veiculo"];
    $retorno[$contador]["imagem"] = $row["imagem"];
    $retorno[$contador]["modelo"] = $row["modelo"];
    $retorno[$contador]["marca"] = $row['marca'];
    $retorno[$contador]["valor"] = $row['valor_dia'];
    $retorno[$contador]["cor"] = $row['cor'];

    $contador++;
}
echo json_encode($retorno);