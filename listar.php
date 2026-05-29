<?php
/**
endpoint - retornar dados cadastrados 
endpoint de leitura responde um json*/

header("Content-Type: application/json; charset=UTF-8")
//garante os caracteres especiais ex: açucar
//vou testar se a pagina me enviou uma requisição "get"
if($_SERVER["REQUEST_METHOD"] !== "GET"){
//se o metodo nao for o get, vou encerrar
    http_response_code(405); // metodo nao permitido
    echo json_encode(["erro" => "Metodo não Permitido"], 
    JSON_UNESCAPED_UNICODE);
    exit;
}

/*fazer a leitura do arquivo json*/
$arquivo = __DIR__ . "/registros.json";

/*tratar um erro, caso o arquivo nao */
if(!file_exists($arquivo)){
    echo json_encode([], JSON_UNESCAPED_UNICODE);
    exit;
}

/*ler o conteudo do json */
$conteudo = file_get_contents($arquivo);

/*transformar ele em json */
$registro = json_decode($conteudo, true);

/*mostrar o conteudo do json*/ 
echo json_encode($registro, JSON_UNESCAPED_UNICODE);
?>
