# Exemplo Completo

Este guia apresenta um exemplo completo de ponta a ponta: desde a recepção dos dados até a geração do XML final da DPS.

## Cenário

Imagine que você está recebendo dados de um formulário de emissão de nota fiscal.

```php
use Nfse\Dto\DpsData;
use Nfse\Xml\DpsXmlBuilder;
use Illuminate\Validation\ValidationException;

// 1. Dados vindos da sua aplicação (ex: $request->all())
$dadosDoFormulario = [
    'versao' => '1.00',
    'infDPS' => [
        '@Id' => 'DPS123456',
        'tpAmb' => 2, // Homologação
        'dhEmi' => '2023-10-27T10:00:00',
        'verAplic' => '1.0',
        'serie' => '1',
        'nDPS' => '100',
        'dCompet' => '2023-10-27',
        'tpEmit' => 1,
        'cLocEmi' => '3550308',
        'prest' => [
            'CNPJ' => '12345678000199',
            'IM' => '12345',
            'xNome' => 'Minha Empresa Ltda'
        ],
        'toma' => [
            'CPF' => '11122233344',
            'xNome' => 'Cliente Exemplo'
        ],
        'serv' => [
            'cServ' => [
                'cTribNac' => '01.01',
                'xDescServ' => 'Desenvolvimento de Software'
            ]
        ],
        'valores' => [
            'vServPrest' => [
                'vServ' => 1000.00
            ],
            'trib' => [
                'tribMun' => [
                    'tribISSQN' => 1,
                    'tpRetISSQN' => 1
                ]
            ]
        ]
    ]
];

try {
    // 2. Validar e criar o DTO
    // Isso garante que todos os campos obrigatórios estão presentes e nos formatos corretos
    $dps = DpsData::validateAndCreate($dadosDoFormulario);

    // 3. Gerar o XML
    $builder = new DpsXmlBuilder();
    $xml = $builder->build($dps);

    // 4. Resultado
    header('Content-Type: application/xml');
    echo $xml;

} catch (ValidationException $e) {
    // 5. Tratar erros de validação
    // O $e->errors() conterá detalhes de quais campos falharam
    print_r($e->errors());
}
```

## O que aconteceu aqui?

1.  **Mapeamento**: O array usou nomes técnicos como `tpAmb` e `dhEmi`. O DTO mapeou isso automaticamente para propriedades como `$tipoAmbiente` e `$dataEmissao`.
2.  **Validação**: Se o `vServ` fosse uma string ou estivesse ausente, uma `ValidationException` seria lançada.
3.  **Tipagem**: Após o `validateAndCreate`, a variável `$dps` é um objeto fortemente tipado, eliminando erros de digitação de chaves de array.
4.  **Conformidade**: O XML gerado segue rigorosamente o esquema da NFS-e Nacional, pronto para ser assinado e enviado.
