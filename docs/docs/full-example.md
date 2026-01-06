# Exemplo Completo

Este guia apresenta um exemplo completo de ponta a ponta: desde a recepção dos dados até a geração do XML final da DPS.

## Cenário

Imagine que você está recebendo dados de um formulário de emissão de nota fiscal.

```php
use Nfse\Dto\Nfse\DpsData;
use Nfse\Xml\DpsXmlBuilder;
use Nfse\Support\IdGenerator;
use Nfse\Signer\XmlSigner;
use Nfse\Http\NfseContext;
use Nfse\Http\Client\SefinClient;
use Nfse\Enums\TipoAmbiente;
use Nfse\Enums\EmitenteDPS;
use Nfse\Enums\TributacaoIssqn;
use Nfse\Enums\TipoRetencaoIssqn;
use Nfse\Validator\DpsValidator;

// 1. Gerar o ID da DPS
$idDps = IdGenerator::generateDpsId(
    '12345678000199', // CNPJ Emitente
    '3550308',        // Código Município
    '1',              // Série
    '100'             // Número DPS
);

// 2. Dados vindos da sua aplicação
$dadosDoFormulario = [
    '@attributes' => ['versao' => '1.00'],
    'infDPS' => [
        '@attributes' => ['Id' => $idDps],
        'tpAmb' => TipoAmbiente::Homologacao,
        'dhEmi' => '2023-10-27T10:00:00',
        'verAplic' => '1.0',
        'serie' => '1',
        'nDPS' => '100',
        'dCompet' => '2023-10-27',
        'tpEmit' => EmitenteDPS::Prestador,
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
                    'tribISSQN' => TributacaoIssqn::OperacaoTributavel,
                    'tpRetISSQN' => TipoRetencaoIssqn::NaoRetido
                ]
            ]
        ]
    ]
];

try {
    // 3. Criar o DTO
    $dps = new DpsData($dadosDoFormulario);

    // 4. Validar
    $validator = new DpsValidator();
    $result = $validator->validate($dps);

    if ($result->fails()) {
        print_r($result->getErrors());
        exit;
    }

    // 5. Gerar o XML
    $builder = new DpsXmlBuilder();
    $xml = $builder->build($dps);

    // 6. Assinar o XML
    $certificado = new \Nfse\Signer\Certificate(
        '/caminho/para/certificado.p12',
        'sua-senha'
    );
    $signer = new XmlSigner($certificado);
    $xmlAssinado = $signer->sign($xml, 'infDPS');

    // 7. Transmitir para a SEFIN Nacional
    $context = new NfseContext(
        ambiente: TipoAmbiente::Homologacao,
        certificatePath: '/caminho/para/certificado.p12',
        certificatePassword: 'sua-senha'
    );

    $sefin = new SefinClient($context);

    // O XML deve ser enviado compactado em GZip e Base64
    $xmlGZipB64 = base64_encode(gzencode($xmlAssinado));
    $response = $sefin->emitirNfse($xmlGZipB64);

    if ($response->erros) {
        print_r($response->erros);
    } else {
        echo "NFS-e emitida: " . $response->chaveAcesso;
    }

} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}
```

## O que aconteceu aqui?

1.  **Mapeamento**: O array usou nomes técnicos como `tpAmb` e a estrutura `@attributes` para atributos XML. O DTO mapeou isso automaticamente para propriedades como `$tipoAmbiente` e `$dataEmissao`.
2.  **Validação**: Se o `vServ` fosse uma string ou estivesse ausente, uma `ValidationException` seria lançada.
3.  **Tipagem**: Após o `validateAndCreate`, a variável `$dps` é um objeto fortemente tipado, eliminando erros de digitação de chaves de array.
4.  **Conformidade**: O XML gerado segue rigorosamente o esquema da NFS-e Nacional, pronto para ser assinado e enviado.
