# Construção Civil (Obra)

Para serviços de construção civil, é obrigatório informar os dados da obra.

## Regras de Negócio

-   **Obrigatoriedade**: O grupo `obra` é obrigatório para códigos de tributação como `07.02.01`, `07.02.02`, `07.04.01`, `07.05.01`, etc.
-   **Endereço da Obra**: O CEP da obra deve pertencer ao município informado em `localPrestacao`.

## Exemplo de Código

```php
use Nfse\Dto\ServicoData;
use Nfse\Dto\ObraData;
use Nfse\Dto\EnderecoData;
use Nfse\Dto\LocalPrestacaoData;
use Nfse\Dto\CodigoServicoData;

$servico = new ServicoData(
    localPrestacao: new LocalPrestacaoData(
        codigoLocalPrestacao: '3550308', // Município da obra (São Paulo)
        codigoPaisPrestacao: null
    ),
    codigoServico: new CodigoServicoData(
        codigoTributacaoNacional: '07.02.01', // Execução de obras...
        codigoTributacaoMunicipal: '702',
        descricaoServico: 'Construção Civil',
        codigoNbs: '123456789',
        codigoInternoContribuinte: null
    ),
    obra: new ObraData(
        inscricaoImobiliariaFiscal: '123.456.789-0', // Inscrição na prefeitura
        codigoObra: 'ART-2023/001',                  // Código ART ou Alvará
        endereco: new EnderecoData(
            codigoMunicipio: '3550308',
            cep: '01001000',
            logradouro: 'Rua da Obra',
            numero: 'SN',
            bairro: 'Centro',
            complemento: 'Lote 1',
            enderecoExterior: null
        )
    ),
    // ... outros campos
    comercioExterior: null,
    atividadeEvento: null
);
```

## Validações Comuns

-   **Erro E0370**: Grupo obra não informado para serviço de construção.
-   **Erro E0380**: CEP da obra não corresponde ao município da prestação.
