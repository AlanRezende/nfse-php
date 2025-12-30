# Tomador Pessoa Física

Este exemplo demonstra como instanciar o DTO `TomadorData` para um tomador pessoa física (CPF).

## Regras de Negócio

-   **CPF**: Obrigatório e deve ser válido.
-   **Endereço**: Deve conter o código IBGE do município (`cMun`) válido.

## Exemplo de Código

```php
use Nfse\Dto\TomadorData;
use Nfse\Dto\EnderecoData;

$tomador = new TomadorData(
    cpf: '12345678901',
    cnpj: null,
    nif: null,
    codigoNaoNif: null,
    caepf: null, // Opcional, se houver
    inscricaoMunicipal: null,
    nome: 'João da Silva',
    endereco: new EnderecoData(
        codigoMunicipio: '3550308', // São Paulo - SP
        cep: '01001000',
        logradouro: 'Praça da Sé',
        numero: '1',
        bairro: 'Sé',
        complemento: 'Lado ímpar',
        enderecoExterior: null
    ),
    telefone: '11999999999',
    email: 'joao.silva@email.com'
);
```

## Validações Comuns

-   **Erro E0206**: CPF inválido.
-   **Erro E0238**: Código do município inexistente.
