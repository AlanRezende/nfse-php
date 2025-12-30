# Data Transfer Objects (DTOs)

A biblioteca `nfse-php` utiliza DTOs (Data Transfer Objects) para representar a estrutura complexa da NFS-e Nacional. Esses objetos facilitam a manipulação de dados, garantem a integridade através de validações e permitem a geração automática de tipos para o frontend.

## Estrutura Principal

Os DTOs são baseados no layout oficial da NFS-e Nacional e estão organizados de forma hierárquica.

### DpsData

O objeto raiz que representa a **Declaração de Prestação de Serviço (DPS)**.

-   **Versão**: Versão do layout.
-   **Informações da DPS**: Objeto `InfDpsData` contendo os dados detalhados.

### InfDpsData

Contém o corpo principal da declaração.

-   **Identificação**: ID, série, número, data de emissão.
-   **Ambiente**: Identificação do ambiente (Produção/Homologação).
-   **Atores**: Prestador, Tomador e Intermediário.
-   **Serviço**: Detalhes do serviço prestado e local de prestação.
-   **Valores**: Valores do serviço, deduções e tributação.

## Atores

### PrestadorData

Identifica quem está prestando o serviço.

-   CNPJ, Inscrição Municipal, Telefone e E-mail.
-   Regime Tributário (Simples Nacional, MEI, etc).

### TomadorData

Identifica quem está contratando o serviço.

-   CPF/CNPJ, Nome/Razão Social.
-   Endereço (Nacional ou Exterior).

## Como Instanciar DTOs

Existem duas formas principais de criar instâncias dos DTOs:

### 1. Usando o método `from()`

Ideal quando você já confia na origem dos dados ou quer apenas mapear um array.

```php
$dps = DpsData::from([
    'infDps' => [
        'tpAmb' => 2,
        // ...
    ]
]);
```

### 2. Usando `validateAndCreate()`

Recomendado para dados vindos de requisições externas, pois dispara uma exceção se as regras de validação não forem atendidas.

```php
try {
    $dps = DpsData::validateAndCreate($requestData);
} catch (\Illuminate\Validation\ValidationException $e) {
    // Tratar erros
}
```

## Mapeamento Automático

Graças ao `spatie/laravel-data`, todos os DTOs suportam mapeamento automático de nomes.

> [!TIP]
> Utilizamos o atributo `#[MapInputName]` para vincular o nome técnico do layout nacional (ex: `dhEmi`) à propriedade PHP legível. Isso permite que você trabalhe com nomes amigáveis no seu código enquanto mantém a compatibilidade com o padrão oficial.

## Componentes Reutilizáveis

A biblioteca utiliza diversos componentes menores para organizar os dados:

-   **EnderecoData**: Gerencia endereços nacionais e internacionais.
-   **ServicoData**: Detalha o serviço prestado (CST, Descrição, Local).
-   **ValoresData**: Consolida os valores financeiros da operação.
-   **TributacaoData**: Detalha a retenção de impostos (ISSQN, PIS, COFINS).
-   **DeducaoReducaoData**: Gerencia deduções e reduções da base de cálculo.
