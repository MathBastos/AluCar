<?php
session_start();
include('conexao.php');

if(empty($_POST['cnpj']) || empty($_POST['senha'])){
    header('location: logar_locadora.php');
    exit();
}

$cnpj = mysqli_real_escape_string($conexao, $_POST['cnpj']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select nomeFantasia from locadora where cnpj = '{$cnpj}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);
if($row == 1){
    $usuario_bd = mysqli_fetch_assoc($result);
    $_SESSION['nome'] = $usuario_bd['nomeFantasia'];
    header('Location: ponte.php');
    exit();
} else{
    $_SESSION['nao_autenticado'] = true;
    header('Location: logar_locadora.php');
}
?>