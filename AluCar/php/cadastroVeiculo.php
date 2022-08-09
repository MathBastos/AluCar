<?php
include_once "conexao.php";
include "valida_login.php";
session_start();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_veiculo = "INSERT INTO veiculo (modelo, marca, ano, cambio, direcao, categoria, chassi, placa, cor, motor, portas, qtd_passageiros, ar_condicionado, valor_hora, valor_seguro, id_locadora) 
                    VALUES (:modelo, :marca, :ano, :cambio, :direcao, :categoria, :chassi, :placa, :cor, :motor, :portas, :qtd_passageiros, :ar_condicionado, :valor_hora, :valor_seguro, :id_locadora)";

$cad_veiculo = $conn->prepare($query_veiculo);
$cad_veiculo->bindParam(':modelo', $dados['modelo']);
$cad_veiculo->bindParam(':marca', $dados['marca']);
$cad_veiculo->bindParam(':ano', $dados['ano']);
$cad_veiculo->bindParam(':cambio', $dados['cambio']);
$cad_veiculo->bindParam(':direcao', $dados['direcao']);
$cad_veiculo->bindParam(':categoria', $dados['categoria']);
$cad_veiculo->bindParam(':chassi', $dados['chassi']);
$cad_veiculo->bindParam(':placa', $dados['placa']);
$cad_veiculo->bindParam(':cor', $dados['cor']);
$cad_veiculo->bindParam(':motor', $dados['motor']);
$cad_veiculo->bindParam(':portas', $dados['portas']);
$cad_veiculo->bindParam(':qtd_passageiros', $dados['qtd_passageiros']);
$cad_veiculo->bindParam(':ar_condicionado', $dados['ar_condicionado']);
$cad_veiculo->bindParam(':valor_hora', $dados['valor_hora']);
$cad_veiculo->bindParam(':valor_seguro', $dados['valor_seguro']);
$cad_veiculo->bindParam(':id_locadora', $_SESSION['id_locadora']);

$sql = "SELECT * FROM veiculo WHERE (placa) = (:placa)";
$pegaDados = $conn->prepare($sql);
$pegaDados->bindParam(':placa', $dados['placa']);
$pegaDados->execute();
if($pegaDados->rowCount() == 1){
   $retorna = "Placa já cadastrada em nosso Banco de Dados!";
}else{
    $cad_veiculo->execute();
    if($cad_veiculo->rowCount() == 1){
        $retorna = "Veículo cadastrado com sucesso!";
    }else{
        $retorna = "Não foi possível cadastrar o veículo, verificar os campos";
    }
}
echo json_encode($retorna);