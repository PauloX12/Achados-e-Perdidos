<?php
header("Content-Type: application/json; charset=UTF-8");
if($_SERVER["REQUEEST_METHOD"] !== "POST"){
    //se o metodo nao for o get,vou encerrar
    http_response_code(405); //metodo não permitido
    echo json_encode([
        "sucesso" => false,
        "erro" => "Metodo não Permitido"],
    JSON_UNESCAPED_UNICODE);
    exit;
}
/*vou pegar a entrada do post */
$entrada = file_get_contents("php://input");

/*decodificar*/
$dados = json_decode($entrada, true);

if(is_array($dados)){
    http_response_code(400);
    echo json_encode([
        "sucesso" => false,
        "erro" => "JSON inválido"]
        , JSON_UNESCAPED_UNICODE);
        exit;
}

foreach($camposObrigatórios as $campo){
    if(!isset($dados[$campo]) || trim($dados[$campo]) ===""){
        http_response_code(400);
    echo json_encode([
        "sucesso" => false,
        "erro" => "O campo {$campo} é obrigatorio"]
        , JSON_UNESCAPED_UNICODE);
        exit;
    }
}

function limparTexto($valor, $limite = 300){
    /*função de segurança, para evitar injeção de códigos maliciosos, longe dos perigos noturnos */
    $valor = trim((string) $valor);
    //garante que pe texto e remove espaço nas bordas
    $valor - strip_tags($valor);
    //garante não injeção html
    return $valor;
}
?>