<?php
include_once "conexao.php";


$query = "SELECT * FROM veiculo";
$resultado = $conn->prepare($query);
$resultado->execute();
$contador = 0;

$row = $resultado->rowCount();

while($row = $resultado->fetch(PDO::FETCH_ASSOC)){

    $query_acessorio = "SELECT * FROM locadora WHERE id_locadora = :id_locadora";
    $pega_dados = $conn->prepare($query_acessorio);
    $pega_dados->bindParam(':id_locadora', $row['id_locadora']);
    $pega_dados->execute();

    $row_acessorio = $pega_dados->fetch(PDO::FETCH_ASSOC);
    
    $retorno[$contador]["id"] = $row["id_veiculo"];
    $retorno[$contador]["modelo"] = $row["modelo"];
    $retorno[$contador]["marca"] = $row["marca"];
    $retorno[$contador]["placa"] = $row['placa'];

    $contador++;
}
echo json_encode($retorno);