<?php
session_start();
include('conexao.php');

$nomeFantasia = mysqli_real_escape_string($conexao, trim($_POST['nomeFantasia']));
$cnpj = mysqli_real_escape_string($conexao, trim($_POST['cnpj']));
$cep = mysqli_real_escape_string($conexao, trim($_POST['cep']));
$logradouro = mysqli_real_escape_string($conexao, trim($_POST['logradouro']));
$numero = mysqli_real_escape_string($conexao, trim($_POST['numero']));
$estado = mysqli_real_escape_string($conexao, trim($_POST['estado']));
$cidade = mysqli_real_escape_string($conexao, trim($_POST['cidade']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));

$sql = "select count(*) as total from locatario where usuario = '$cnpj' or email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1){
    $_SESSION['usuario_existente'] = true;
    header('Location: cadastro_locadora.php');
    exit();
}

$sql = "INSERT INTO locadora (nomeFantasia, cnpj, cep, logradouro, numero, estado, cidade, email, senha) VALUES ('$nomeFantasia', '$cnpj', 
                                '$cep', '$logradouro', '$numero', '$estado', '$cidade', '$email', '$senha')";

if($conexao->query($sql) === TRUE){
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: cadastro_locadora.php');
exit();

?>