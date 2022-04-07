<?php
global $server ;
global $user;
global $password;
global $db;

$server = "localhost:3306";
$user = "root";
$password = "";
$db = "alucar";

$conexao = mysqli_connect($server, $user, $password, $db) or die ("Não foi possível conectar");
?>