<?php
include_once "conexao.php";
session_start();
$id_usuario = $_SESSION["id_usuario"];

$valorTotal = $_POST['valorTotal'];
$dataInicio = $_POST['dataInicio'];
$dataFim = $_POST['dataFim'];
$id_veiculo = $_POST['id_veiculo'];
$id_acessorio = $_POST['id_acessorio'];
$status = "Reservado";


// Pega o ID locatario
$sql_fk_usuario = "SELECT * FROM locatario WHERE id_usuario = :id_usuario";
    $pega_dados_usuario = $conn->prepare($sql_fk_usuario);
    $pega_dados_usuario->bindParam(':id_usuario', $id_usuario);
    $pega_dados_usuario->execute();

    $row = $pega_dados_usuario->rowCount();
    $dados_usuario = $pega_dados_usuario->fetch(PDO::FETCH_ASSOC);
    $id_locatario = $dados_usuario['id_locatario'];

// Querry insert reseva
$query_reserva =
"INSERT 
    INTO reserva(
             data_inicio
            ,data_final
            ,valor
            ,status_carro
            ,id_acessorio
            ,id_veiculo
            ,id_locatario
            ) 
    VALUES (
    :data_inicio
    ,:data_final
    ,:valorTotal
    ,:status_carro
    ,:id_acessorio
    ,:id_veiculo
    ,:id_locatario
)";

$cad_reserva = $conn->prepare($query_reserva);
$cad_reserva->bindParam(':valorTotal', $valorTotal);
$cad_reserva->bindParam(':data_inicio', $dataInicio);
$cad_reserva->bindParam(':data_final', $dataFim);
$cad_reserva->bindParam(':status_carro', $status);
$cad_reserva->bindParam(':id_veiculo', $id_veiculo);
$cad_reserva->bindParam(':id_acessorio', $id_acessorio);
$cad_reserva->bindParam(':id_locatario', $id_locatario);

$cad_reserva->execute();

if($cad_reserva->rowCount() == 1){
    // Mundando a Flag do veiculo  
    $query_flag =
    "UPDATE veiculo 
        SET  
            flag_reservado = 'S'
        WHERE id_veiculo = :id_veiculo"; 

    $flag = $conn->prepare($query_flag);
    $flag->bindParam(':id_veiculo', $id_veiculo);
    $flag->execute();

    $retorna = "Veiculo Reservado com sucesso!";
}else{
    $retorna = "Não foi possível reservar o Veículo, tente novamente!";
}


echo json_encode($retorna);