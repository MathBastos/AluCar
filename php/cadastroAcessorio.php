<?php
include_once "conexao.php";
session_start();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_acessorio = "INSERT INTO acessorio (nome, descricao, qtd_acessorio, valor_acessorio, id_locadora) 
                    VALUES (:nome, :descricao, :qtd_acessorio, :valor_acessorio, :id_locadora)";

$cad_acessorio = $conn->prepare($query_acessorio);
$cad_acessorio->bindParam(':nome', $dados['nome']);
$cad_acessorio->bindParam(':descricao', $dados['descricao']);
$cad_acessorio->bindParam(':qtd_acessorio', $dados['qtd_acessorio']);
$cad_acessorio->bindParam(':valor_acessorio', $dados['valor_acessorio']);
$cad_acessorio->bindParam(':id_locadora', $_SESSION['id_locadora']);

$sql = "SELECT * FROM acessorio WHERE (nome) = (:nome) AND (descricao) = (:descricao)";
$pegaDados = $conn->prepare($sql);
$pegaDados->bindParam(':nome', $dados['nome']);
$pegaDados->bindParam(':descricao', $dados['descricao']);
$pegaDados->execute();
if($pegaDados->rowCount() == 1){
   $retorna = "Acessório ja cadastrado, verificar nome e/ou descrição";
}else{
    $cad_acessorio->execute();
    if($cad_acessorio->rowCount() == 1){
        $retorna = "Acessório cadastrado com sucesso!";
    }else{
        $retorna = "Não foi possível cadastrar o veículo, verificar os campos";
    }
}
echo json_encode($retorna);