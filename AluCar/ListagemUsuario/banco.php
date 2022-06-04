<?php
	
	$conexao = mysqli_connect("localhost", "root", "", "supermercado");
	
	$marca = $_POST["marca"];
	$nome = $_POST["nome"];
	$tipo = $_POST["tipo"];
	$fabricacao = $_POST["fabricacao"];
	$validade = $_POST["validade"];
	$query = "INSERT INTO produtos(id, marca, nome, tipo, fabricacao, validade) 
	VALUES ('', '".$marca."', '".$nome."', '".$tipo."', '".$fabricacao."', '".$validade."')";
	
	
	mysqli_query($conexao, $query);

	mysql_close($conexao);

?>