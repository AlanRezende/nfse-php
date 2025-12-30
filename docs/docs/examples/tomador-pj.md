# Tomador Pessoa Jurídica

Este exemplo demonstra como instanciar o DTO `TomadorData` para um tomador pessoa jurídica (CNPJ).

## Regras de Negócio

-   **CNPJ**: Obrigatório e deve ser válido.
-   **Inscrição Municipal (IM)**: Recomendado informar se o tomador possuir cadastro no município emissor.
-   **Endereço**: Deve conter o código IBGE do município (`cMun`) válido.

## Exemplo de Código

```php
use Nfse\Dto\TomadorData;
use Nfse\Dto\EnderecoData;

$tomador = new TomadorData(
    cpf: null,
    cnpj: '12345678000199',
    nif: null,
    codigoNaoNif: null,
    caepf: null,
    inscricaoMunicipal: '123456', // Se houver
    nome: 'Empresa Exemplo Ltda',
    endereco: new EnderecoData(
        codigoMunicipio: '3550308', // São Paulo - SP
        cep: '01310100',
        logradouro: 'Av. Paulista',
        numero: '1000',
        bairro: 'Bela Vista',
        complemento: 'Conj 101',
        enderecoExterior: null
    ),
    telefone: '1133334444',
    email: 'financeiro@empresaexemplo.com.br'
);
```

## Validações Comuns

-   **Erro E0188**: CNPJ inválido.
-   **Erro E0190**: CNPJ não encontrado no cadastro (se validação online estiver ativa).
