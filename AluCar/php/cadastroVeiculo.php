<?php
include_once "conexao.php";
session_start();
$id_veiculo = $_SESSION["id_veiculo"];
$time = time();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$countfiles = count($_FILES['files']['name']);

if($id_veiculo > 0){
    $query_veiculo = 
    "UPDATE veiculo 
        SET  modelo = :modelo
            ,marca = :marca
            ,img_name = :img_name
            ,imagem = :imagem
            ,ano = :ano
            ,cambio = :cambio
            ,direcao = :direcao
            ,categoria = :categoria
            ,chassi = :chassi
            ,placa = :placa
            ,cor = :cor
            ,motor = :motor
            ,portas = :portas
            ,qtd_passageiros = :qtd_passageiros
            ,ar_condicionado = :ar_condicionado
            ,valor_dia = :valor_dia
            ,valor_seguro = :valor_seguro
        WHERE id_veiculo = :id_veiculo"; 
}else{
    
    $query_veiculo = 
    "INSERT
        INTO veiculo(
             modelo
            ,marca
            ,img_name
            ,imagem
            ,ano
            ,cambio
            ,direcao
            ,categoria
            ,chassi
            ,placa
            ,cor
            ,motor
            ,portas
            ,qtd_passageiros
            ,ar_condicionado
            ,valor_dia
            ,valor_seguro
            ,flag_reservado
            ,id_locadora
            ) 
        VALUES (
         :modelo
        ,:marca
        ,:img_name
        ,:imagem
        ,:ano
        ,:cambio
        ,:direcao
        ,:categoria
        ,:chassi
        ,:placa
        ,:cor
        ,:motor
        ,:portas
        ,:qtd_passageiros
        ,:ar_condicionado
        ,:valor_dia
        ,:valor_seguro
        ,'N'
        ,:id_locadora
        )";
}

$cad_veiculo = $conn->prepare($query_veiculo);

 // Loop all files
for($i = 0; $i < $countfiles; $i++) {
  
    // File name
    $filename = $_FILES['files']['name'][$i];
  
    // Location
    $target_file = '../image/'.$filename;
  
    // file extension
    $file_extension = pathinfo(
        $target_file, PATHINFO_EXTENSION);
         
    $file_extension = strtolower($file_extension);

    // Valid image extension
    $valid_extension = array("png","jpeg","jpg");
  
    if(in_array($file_extension, $valid_extension)) {

        // Upload file
        if(move_uploaded_file(
            $_FILES['files']['tmp_name'][$i],
            $target_file)){
                $cad_veiculo->bindParam(':modelo', $dados['modelo']);
                $cad_veiculo->bindParam(':marca', $dados['marca']);
                $cad_veiculo->bindParam(':img_name', $filename);
                $cad_veiculo->bindParam(':imagem', $target_file);
                $cad_veiculo->bindParam(':ano', $dados['ano']);
                $cad_veiculo->bindParam(':cambio', $dados['cambio']);
                $cad_veiculo->bindParam(':direcao', $dados['direcao']);
                $cad_veiculo->bindParam(':categoria', $dados['categoria']);
                $cad_veiculo->bindParam(':chassi', $dados['chassi']);
                $cad_veiculo->bindParam(':placa', $dados['placa']);
                $cad_veiculo->bindParam(':cor', $dados['cor']);
                $cad_veiculo->bindParam(':motor', $dados['motor']);
                $cad_veiculo->bindParam(':portas', $dados['portas']);
                $cad_veiculo->bindParam(':qtd_passageiros', $dados['qtd_passageiros']);
                $cad_veiculo->bindParam(':ar_condicionado', $dados['ar_condicionado']);
                $cad_veiculo->bindParam(':valor_dia', $dados['valor_dia']);
                $cad_veiculo->bindParam(':valor_seguro', $dados['valor_seguro']);
                $cad_veiculo->bindParam(':id_locadora', $_SESSION['id_locadora']);
            }
        }
}





if($id_veiculo > 0){
    $cad_veiculo->bindParam(':id_veiculo', $id_veiculo);
    $cad_veiculo->execute();
    $retorna = "Veículo atualizado com sucesso!";
}else{
    $sql = "SELECT * FROM veiculo WHERE (placa) = (:placa)";
    $pegaDados = $conn->prepare($sql);
    $pegaDados->bindParam(':placa', $dados['placa']);
    $pegaDados->execute();
    if($pegaDados->rowCount() == 1){
        $retorna = "Placa já cadastrada em nosso Banco de Dados!";
    }else{
        $cad_veiculo->execute();
        if($cad_veiculo->rowCount() == 1){
            $retorna = "Veículo cadastrado com sucesso!";
        }else{
            $retorna = "Não foi possível cadastrar o veículo, verificar os campos";
        }
    }
}
echo json_encode($retorna);