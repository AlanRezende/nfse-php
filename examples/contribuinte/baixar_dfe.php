<?php

/** @var \Nfse\Nfse $nfse */
$nfse = require_once __DIR__ . '/../bootstrap.php';

try {
    $nsu = 1;
    
    echo "Baixando DF-e para o contribuinte (NSU: $nsu)...\n";
    
    $response = $nfse->contribuinte()->baixarDfe($nsu);
    
    echo "NSU Final: " . $response->ultimoNsu . "\n";
    echo "Quantidade de documentos: " . count($response->listaNsu) . "\n";
    // print_r($response);
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
