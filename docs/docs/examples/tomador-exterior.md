# Tomador Estrangeiro

Este exemplo demonstra como preencher os dados para um tomador residente ou domiciliado no exterior.

## Regras de Negócio

-   **NIF (Número de Identificação Fiscal)**: Obrigatório para identificar o tomador no exterior.
-   **Endereço Exterior**: O grupo `endExt` deve ser preenchido, e `endNac` (endereço nacional) deve ser nulo ou ignorado.
-   **Código do País**: Deve seguir a tabela ISO2 (ex: 'US' para Estados Unidos).

## Exemplo de Código

```php
use Nfse\Dto\TomadorData;
use Nfse\Dto\EnderecoData;
use Nfse\Dto\EnderecoExteriorData;

$tomador = new TomadorData(
    cpf: null,
    cnpj: null,
    nif: '123456789', // Tax ID no país de origem
    codigoNaoNif: null, // Usar se não houver NIF (ver tabela de motivos)
    caepf: null,
    inscricaoMunicipal: null,
    nome: 'International Client Inc.',
    endereco: new EnderecoData(
        codigoMunicipio: null, // Não preencher para exterior
        cep: null,            // Não preencher para exterior
        logradouro: '5th Avenue',
        numero: '100',
        bairro: 'Manhattan',
        complemento: null,
        enderecoExterior: new EnderecoExteriorData(
            codigoPais: 'US', // Estados Unidos
            codigoEnderecamentoPostal: '10001',
            cidade: 'New York',
            estadoProvinciaRegiao: 'NY'
        )
    ),
    telefone: '15551234567',
    email: 'contact@client.com'
);
```

## Validações Comuns

-   **Erro E0223**: NIF ou cNaoNIF deve ser informado quando há endereço no exterior.
-   **Erro E0246**: Código de país inválido ou igual a 'BR'.
