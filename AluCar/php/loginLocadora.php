<?php
include_once "conexao.php";
session_start();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha_md5 = md5($dados['senha']);

$query_login_locadora = "SELECT * FROM usuario WHERE usuario = :usuario AND senha = :senha";
$login_locadora = $conn->prepare($query_login_locadora);
$login_locadora->bindParam(':usuario', $dados['usuario']);
$login_locadora->bindParam(':senha', $senha_md5);
$login_locadora->execute();


$row = $login_locadora->rowCount();

if($row == 1){
    
    $user_locadora = $login_locadora->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id_usuario'] = $user_locadora['id_usuario'];
    $_SESSION['nome'] = $user_locadora['nome'];
    $flag_bloqueado = $user_locadora['flag_bloqueado'];

    $query_login_locadora_locadora = "SELECT * FROM locadora WHERE id_usuario = :id_usuario";
    $sessao_locadora = $conn->prepare($query_login_locadora_locadora);
    $sessao_locadora->bindParam(':id_usuario', $user_locadora['id_usuario']);
    $sessao_locadora->execute();

    $dados_locadora = $sessao_locadora->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id_locadora'] = $dados_locadora['id_locadora'];
    if($flag_bloqueado == "S"){
        $retorna = ["bloqueado"];
    }else{
        $retorna = ["sucesso"];
    }
}else{
    $retorna = ["erro"];
}

echo json_encode($retorna);