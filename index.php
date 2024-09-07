<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Permitir todas as origens
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type"); // Cabeçalhos permitidos



// Função para calcular o IMC
function calcularIMC($peso, $altura) {
    return $peso / ($altura * $altura);
}

// Função para determinar a classificação do IMC
function classificarIMC($imc) {
    if ($imc < 18.5) {
        return "Abaixo do peso";
    } elseif ($imc >= 18.5 && $imc < 24.9) {
        return "Peso normal";
    } elseif ($imc >= 24.9 && $imc < 29.9) {
        return "Sobrepeso";
    } else {
        return "Obesidade";
    }
}

// Função para calcular o peso alvo para um IMC de 24.9
function calcularPesoAlvo($altura, $imcDesejado = 24.9) {
    return $imcDesejado * ($altura * $altura);
}

// Receber os dados via GET
$peso = isset($_GET['peso']) ? (float)$_GET['peso'] : null;
$altura = isset($_GET['altura']) ? (float)$_GET['altura'] : null;

// Verificar se os parâmetros são válidos
if ($peso === null || $altura === null || $altura <= 0) {
    echo json_encode(["error" => "Parâmetros inválidos. Forneça peso e altura corretos."]);
    exit;
}

// Calcular IMC
$imc = calcularIMC($peso, $altura);
$classificacao = classificarIMC($imc);

// Calcular peso alvo para IMC 24.9
$pesoAlvo = calcularPesoAlvo($altura);
$diferencaPeso = $pesoAlvo - $peso;

// Preparar a resposta
$resposta = [
    "imc" => $imc,
    "classificacao" => $classificacao,
    "pesoAlvo" => $pesoAlvo,
    "diferencaPeso" => $diferencaPeso
];

echo json_encode($resposta);
?>
