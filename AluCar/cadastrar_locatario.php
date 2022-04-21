<?php
session_start();
include('conexao.php');

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$sobrenome = mysqli_real_escape_string($conexao, trim($_POST['sobrenome']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['cpf']));
$celular = mysqli_real_escape_string($conexao, trim($_POST['celular']));
$dataNasc = mysqli_real_escape_string($conexao, trim($_POST['dataNasc']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));

$sql = "select count(*) as total from locatario where usuario = '$usuario' or cpf = '$cpf' or email = '$email'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1){
    $_SESSION['usuario_existente'] = true;
    header('Location: cadastro_locatario.php');
    exit();
}

$sql = "INSERT INTO locatario (nome, sobrenome, cpf, celular, dataNasc, email, usuario, senha) VALUES ('$nome', '$sobrenome', 
                                '$cpf', '$celular', '$dataNasc', '$email', '$usuario', '$senha')";

if($conexao->query($sql) === TRUE){
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: cadastro_locatario.php');
exit();

?>