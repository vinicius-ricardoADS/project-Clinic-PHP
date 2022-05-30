<?php

/* 
    Exemplo:
    parametroValidos($_POST, ["id", "nome"]);
*/
function parametrosValidos($metodo, $lista)
{
    $obtidos = array_keys($metodo);
    $nao_encontrados = array_diff($lista, $obtidos);
    if (empty($nao_encontrados)) {
        foreach ($lista as $p) {
            if (empty(trim($metodo[$p])) and trim($metodo[$p]) != "0") {
                return false;
            }
        }
        return true;
    }
    return false;
}

/* 
    Exemplo:
    isMetodo("PUT");
*/
function isMetodo($metodo)
{
    if (!strcasecmp($_SERVER['REQUEST_METHOD'], $metodo)) {
        return true;
    }
    return false;
}


function filterIsInt($v) {
    return filter_var($v, FILTER_VALIDATE_INT);
}

function filterIsEmail($v) {
    return filter_var($v, FILTER_VALIDATE_EMAIL);
}


function emptyString($str) {
    if(strlen(trim($str)) == 0) {
        return true;
    } 
    return false;
}



function verificaNome($string){
    if(is_numeric(filter_var($string, FILTER_SANITIZE_NUMBER_INT))){
        
        return 0;
    }

    if (!(preg_match('/^[a-zA-Z0-9]+/', $string))) {
        return 1;
    }

    return true;
    
}

function verificaMarca($string){
    if(is_numeric(filter_var($string, FILTER_SANITIZE_NUMBER_INT))){
        
        return 0;
    }

    if (!(preg_match('/^[a-zA-Z0-9]+/', $string))) {
        return 1;
    }

    return true;
    
}

function verificaAno($ano){

    $ano = (int) $ano;
    
    if(is_string($ano)){
        echo json_encode([
            "msg" => "O ano nao deve ser do tipo String!"
        ]);
        return false;
    }

    if(is_float($ano)){
        echo json_encode([
            "msg" => "O ano nao deve ser do tipo Float!"
        ]);
        return false;
    }

    $anostr = strval($ano);
    if(strlen($anostr) > 4 || strlen($anostr) < 4){
        echo json_encode([
            "msg" => "O ano possui tamanho invalido!"
        ]);
        return false;
    }

    $ano = (int) $ano;

    if($ano > 2022){
        echo json_encode([
            "msg" => "O ano possui maximo eh 2022!"
        ]);
        return false;
    }

    return true;
}


function verificaSenha($senha){
    $anostr = strval($senha);
    if(strlen($senha) < 6 ){
        return 0;
    }

    if(strlen($senha) > 24 ){
        
        return 1;
    }

    return true;
}

