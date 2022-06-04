<?php
	$conexao = mysqli_connect("localhost", "root", "", "supermercado");

	$query = "SELECT * FROM produtos";
	$resultado = mysqli_query($conexao, $query);

	$contador = 0;
	
	while($row = mysqli_fetch_assoc($resultado)){
		$retorno[$contador]["id"] = $row["id"];
		$retorno[$contador]["marca"] = $row["marca"];
		$retorno[$contador]["nome"] = $row["nome"];
		$retorno[$contador]["tipo"] = $row["tipo"];
		$retorno[$contador]["fabricacao"] = $row["fabricacao"];
		$retorno[$contador]["validade"] = $row["validade"];
		
		$contador++;
	}
	
	mysqli_close($conexao);
	
	echo json_encode($retorno);
?>