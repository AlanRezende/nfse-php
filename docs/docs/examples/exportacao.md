# Exportação de Serviços

Cenário onde o serviço é prestado para um tomador no exterior.

## Regras de Negócio

-   **Tributação**: `tributacaoIssqn` deve ser 3 (Exportação).
-   **Comércio Exterior**: Grupo `comExt` é obrigatório.
-   **NBS**: Código NBS (Nomenclatura Brasileira de Serviços) é obrigatório.

## Exemplo de Código

```php
use Nfse\Dto\ServicoData;
use Nfse\Dto\ComercioExteriorData;
use Nfse\Dto\CodigoServicoData;
use Nfse\Dto\TributacaoData;

// 1. Configurar Tributação como Exportação
$tributacao = new TributacaoData(
    tributacaoIssqn: 3, // 3 - Exportação
    tipoRetencaoIssqn: 1, // Não retido
    // ...
);

// 2. Configurar Serviço com Comércio Exterior
$servico = new ServicoData(
    // ...
    codigoServico: new CodigoServicoData(
        // ...
        codigoNbs: '123456789', // Obrigatório
        // ...
    ),
    comercioExterior: new ComercioExteriorData(
        modoPrestacao: 1, // 1 - Transfronteiriço
        vinculoPrestacao: 1, // 1 - Sem vínculo
        tipoMoeda: 'USD', // Dólar Americano
        valorServicoMoeda: 1000.00,
        mecanismoApoioComexPrestador: 'Nenhum',
        mecanismoApoioComexTomador: 'Nenhum',
        movimentacaoTemporariaBens: 'Não',
        numeroDeclaracaoImportacao: null,
        numeroRegistroExportacao: null,
        mdic: 'Não'
    ),
    localPrestacao: new LocalPrestacaoData(
        codigoLocalPrestacao: null,
        codigoPaisPrestacao: 'US' // País de destino
    )
);
```

## Validações Comuns

-   **Erro E0330**: Grupo `comExt` obrigatório para exportação.
-   **Erro E0318**: Item NBS obrigatório para exportação.
