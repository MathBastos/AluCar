<?php
session_start();
include('conexao.php');

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
$dataNasc = mysqli_real_escape_string($conexao, trim($_POST['dataNasc']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));

$sql = "select count(*) as total from locatario where usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1){
    $_SESSION['usuario_existente'] = true;
    header('Location: cadastro.php');
    exit();
}

$sql = "INSERT INTO locatario (nome, cpf, dataNasc, usuario, senha) VALUES ('$nome', '$cpf', '$dataNasc', '$usuario', '$senha')";

if($conexao->query($sql) === TRUE){
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: cadastro.php');
exit();

?>