<?php
include_once "conexao.php";
session_start();
$id_locadora = $_SESSION["id_locadora"];

if($id_locadora > 0){
    $query = 
    "SELECT 
     locadora.id_locadora
    ,nome
    ,cnpj
    ,telefone
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
        INNER JOIN locadora 
            ON usuario.id_usuario = locadora.id_usuario 
        INNER JOIN locadora_endereco 
            ON locadora.id_locadora = locadora_endereco.id_locadora 
        INNER JOIN endereco 
            ON locadora_endereco.id_endereco = endereco.id_endereco
    WHERE locadora.id_locadora = :id_locadora
    ";


    $resultado = $conn->prepare($query);
    $resultado->bindParam(':id_locadora', $id_locadora);
    $resultado->execute();


    $row = $resultado->fetch(PDO::FETCH_ASSOC);
    $retorno["id"] = $row["id_locadora"];
    $retorno["nome"] = $row["nome"];
    $retorno["cnpj"] = $row["cnpj"];
    $retorno["telefone"] = $row["telefone"];
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
    $retorno["cnpj"] = "";
    $retorno["telefone"] = "";
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