<?php
include_once "conexao.php";


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$senha_md5 = md5($dados['senha']);

$query_loginLocatario = "SELECT * FROM locatario WHERE usuario = :usuario AND senha = :senha";
$login_locatario = $conn->prepare($query_loginLocatario);
$login_locatario->bindParam(':usuario', $dados['usuario']);
$login_locatario->bindParam(':senha', $senha_md5);
$login_locatario->execute();

$row = $login_locatario->rowCount();

if($row == 1){
    
    $user_locatario = $login_locatario->fetch(PDO::FETCH_ASSOC);
    $_SESSION['idLocatario'] = $user_locatario['idLocatario'];
    $_SESSION['locatario'] = $user_locatario['nome'];
    
    $retorna = ["sucesso"];
}else{
    $retorna = ['erro' => true, 'msg' => "Erro: Usuario não foi cadastrado!"];
}

echo json_encode($retorna);