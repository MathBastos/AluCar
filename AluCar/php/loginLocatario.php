<?php
include_once "conexao.php";
session_start();


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$senha_md5 = md5($dados['senha']);

$query_login_locatario = "SELECT * FROM usuario WHERE usuario = :usuario AND senha = :senha";
$login_locatario = $conn->prepare($query_login_locatario);
$login_locatario->bindParam(':usuario', $dados['usuario']);
$login_locatario->bindParam(':senha', $senha_md5);
$login_locatario->execute();

$row = $login_locatario->rowCount();

if($row == 1){
    $user_locatario = $login_locatario->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id_usuario'] = $user_locatario['id_usuario'];
    $_SESSION['nome'] = $user_locatario['nome'];
    $flag_bloqueado = $user_locatario['flag_bloqueado'];

    if($_SESSION['nome'] == "admin"){
        $retorna = ["admin"];
    }else{
        if($flag_bloqueado == "S"){
            $retorna = ["bloqueado"];
        }else{
            $retorna = ["sucesso"];
        }
    }
}else{
    $retorna = ["erro"];
}
echo json_encode($retorna);