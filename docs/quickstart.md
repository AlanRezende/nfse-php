---
title: Quickstart
sidebar_position: 2
---

## Instalação

Instale via Composer:

```bash
composer require nfse-nacional/nfse-php
```

## Exemplo rápido: emitir uma NFS-e (em 1 minuto)

1. Configure o contexto (caminho para o PFX e senha):

```php
use Nfse\Contribuinte\Configuration\NfseContext;
use Nfse\Contribuinte\Service\NfseService;

$context = new NfseContext(
    Environment::Homologation,
    '/path/to/certificate.pfx',
    'password'
);
$service = new NfseService($context);
```

2. Monte um DPS mínimo e emita:

```php
use Nfse\Dto\Nfse\DpsData;

$dps = new DpsData(
    versao: '1.00',
    infDps: [
        'id' => 'DPS123',
        'tipoAmbiente' => 2,
        'prestador' => ['cnpj' => '12345678000199'],
        'tomador' => ['cpf' => '11122233344'],
        'servico' => ['codigoTributacaoNacional' => '01.01'],
        'valores' => ['valorServicoPrestado' => ['valorServico' => 100.00]]
    ]
);

$nfse = $service->emitir($dps);
echo "Nota emitida! Número: {$nfse->infNfse->numeroNfse}";
```

Pronto — você emitiu sua primeira nota. Próximos passos recomendados: configurar corretamente o certificado, aprender a consultar notas e a tratar eventos (cancelamento).
