<?php
include_once "conexao.php";


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_veiculo = "INSERT INTO veiculo (modelo, marca, ano, cambio, direcao, categoria, chassi, placa, cor, motor, portas, qtdPassageiros, arCondicionado, valorHora, valorSeguro) 
                    VALUES (:modelo, :marca, :ano, :cambio, :direcao, :categoria, :chassi, :placa, :cor, :motor, :portas, :qtdPassageiros, :arCondicionado, :valorHora :valorSeguro)";

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
$cad_veiculo->bindParam(':qtdPassageiros', $dados['qtdPassageiros']);
$cad_veiculo->bindParam(':arCondicionado', $dados['arCondicionado']);
$cad_veiculo->bindParam(':valorHora', $dados['valorHora']);
$cad_veiculo->bindParam(':valorSeguro', $dados['valorSeguro']);
$cad_veiculo->execute();

if($cad_veiculo->rowCount()){
    $retorna = ['erro' => false, 'msg' => "Locadora cadastrada com sucesso"];
}else{
    $retorna = ['erro' => true, 'msg' => "Erro: Locadora não foi cadastrado!"];
}

echo json_encode($retorna);