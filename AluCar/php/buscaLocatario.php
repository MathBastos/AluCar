<?php
include_once "conexao.php";
session_start();
$id_locatario = $_SESSION["id_locatario"];

if($id_locatario > 0){
    $query = 
    "SELECT 
     locatario.id_locatario
    ,nome
    ,cpf
    ,celular
    ,data_nascimento
    ,email
    ,cep
    ,rua
    ,numero
    ,estado
    ,bairro
    ,cidade
    ,complemento
    ,usuario
    ,senha 
    FROM usuario 
        INNER JOIN locatario 
            ON usuario.id_usuario = locatario.id_usuario 
        INNER JOIN endereco 
            ON locatario.id_endereco = endereco.id_endereco
    WHERE locatario.id_locatario = :id_locatario
    ";


    $resultado = $conn->prepare($query);
    $resultado->bindParam(':id_locatario', $id_locatario);
    $resultado->execute();


    $row = $resultado->fetch(PDO::FETCH_ASSOC);
    $retorno["id"] = $row["id_locatario"];
    $retorno["nome"] = $row["nome"];
    $retorno["cpf"] = $row["cpf"];
    $retorno["celular"] = $row["celular"];
    $retorno["data_nascimento"] = $row["data_nascimento"];
    $retorno["email"] = $row["email"];
    $retorno["cep"] = $row['cep'];
    $retorno["rua"] = $row["rua"];
    $retorno["numero"] = $row["numero"];
    $retorno["estado"] = $row["estado"];
    $retorno["bairro"] = $row["bairro"];
    $retorno["cidade"] = $row['cidade'];
    $retorno["complemento"] = $row["complemento"];
    $retorno["usuario"] = $row["usuario"];
    

}else{
    $retorno["id"] = "";
    $retorno["nome"] = "";
    $retorno["cpf"] = "";
    $retorno["celular"] = "";
    $retorno["data_nascimento"] = "";
    $retorno["email"] = "";
    $retorno["cep"] = "";
    $retorno["rua"] = "";
    $retorno["numero"] = "";
    $retorno["estado"] = "";
    $retorno["bairro"] = "";
    $retorno["cidade"] = "";
    $retorno["complemento"] = "";
    $retorno["usuario"] = "";
    $retorno["senha"] = "";
}
echo json_encode($retorno);