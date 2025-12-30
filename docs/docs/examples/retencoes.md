# Retenção de ISS

Cenários onde o ISSQN é retido pelo tomador ou intermediário.

## Regras de Negócio

-   **Identificação do Tomador**: Se houver retenção pelo tomador (`tpRetISSQN = 2`), o tomador DEVE ser identificado por CPF ou CNPJ.
-   **Endereço do Tomador**: Obrigatório se houver retenção.

## Exemplo: Retido pelo Tomador

```php
use Nfse\Dto\ValoresData;
use Nfse\Dto\TributacaoData;
use Nfse\Dto\ValorServicoPrestadoData;

$valores = new ValoresData(
    valorServicoPrestado: new ValorServicoPrestadoData(
        valorServico: 5000.00,
        valorRecebido: null // Não preencher se emitente for prestador
    ),
    tributacao: new TributacaoData(
        tributacaoIssqn: 1, // 1 - Operação Tributável
        tipoRetencaoIssqn: 2, // 2 - Retido pelo Tomador
        tipoImunidade: null,
        tipoSuspensao: null,
        numeroProcessoSuspensao: null,
        beneficioMunicipal: null,
        cstPisCofins: null,
        percentualTotalTributosSN: null,
        indicadorTotalTributos: 0
    ),
    desconto: null,
    deducaoReducao: null
);
```

## Validações Comuns

-   **Erro E0204**: Retenção indicada mas tomador não identificado.
-   **Erro E0031**: Retenção pelo tomador não permitida se município de incidência for diferente do município do tomador (depende da regra específica do município).
