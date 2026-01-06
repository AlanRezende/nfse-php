# IdGenerator

A classe `IdGenerator` facilita a criação de identificadores únicos exigidos pelo padrão nacional de NFS-e, garantindo conformidade com o formato especificado pela ABRASF.

## Instalação

Esta classe faz parte do pacote principal e está disponível no namespace `Nfse\Support`.

```php
use Nfse\Support\IdGenerator;
```

## Método Principal

### generateDpsId()

Gera o ID único da DPS (Declaração de Prestação de Serviço) seguindo rigorosamente o padrão nacional.

```php
$idDps = IdGenerator::generateDpsId(
    '12.345.678/0001-99',
    '3550308',
    '1',
    '123'
);

echo $idDps;
// DPS355030821234567800019900001000000000000123
```

**Assinatura:**

```php
public static function generateDpsId(
    string $cpfCnpj,
    string $codIbge,
    string $serieDps,
    string|int $numDps
): string
```

**Parâmetros:**

-   `$cpfCnpj` (string) - CPF ou CNPJ do emitente (aceita com ou sem formatação)
-   `$codIbge` (string) - Código IBGE do município de emissão (7 dígitos)
-   `$serieDps` (string) - Série da DPS (até 5 caracteres)
-   `$numDps` (string|int) - Número da DPS (até 15 dígitos)

**Retorno:**

-   (string) ID da DPS com exatamente **45 caracteres**

---

## Estrutura do ID

O ID da DPS é composto por 45 caracteres divididos em 6 componentes:

```
DPS + Município(7) + Tipo(1) + Inscrição(14) + Série(5) + Número(15)
```

### Tabela de Componentes

| Componente            | Posição | Tamanho | Descrição                           | Exemplo           |
| --------------------- | ------- | ------- | ----------------------------------- | ----------------- |
| **Prefixo**           | 1-3     | 3       | Literal "DPS"                       | `DPS`             |
| **Código Município**  | 4-10    | 7       | Código IBGE do município            | `3550308`         |
| **Tipo Inscrição**    | 11      | 1       | 1=CPF, 2=CNPJ                       | `2`               |
| **Inscrição Federal** | 12-25   | 14      | CPF/CNPJ (CPF com zeros à esquerda) | `12345678000199`  |
| **Série**             | 26-30   | 5       | Série da DPS (zeros à esquerda)     | `00001`           |
| **Número**            | 31-45   | 15      | Número da DPS (zeros à esquerda)    | `000000000000123` |

### Exemplo Visual

```
DPS 3550308 2 12345678000199 00001 000000000000123
│   │       │ │              │     │
│   │       │ │              │     └─ Número (15 dígitos)
│   │       │ │              └─────── Série (5 dígitos)
│   │       │ └────────────────────── Inscrição Federal (14 dígitos)
│   │       └──────────────────────── Tipo (1=CPF, 2=CNPJ)
│   └──────────────────────────────── Código Município (7 dígitos)
└──────────────────────────────────── Prefixo fixo
```

---

## Exemplos Práticos

### Exemplo 1: CNPJ Básico

```php
use Nfse\Support\IdGenerator;

$id = IdGenerator::generateDpsId(
    '12345678000199',  // CNPJ
    '3550308',         // São Paulo - SP
    '1',               // Série 1
    '100'              // Número 100
);

echo $id;
// DPS355030821234567800019900001000000000000100
//            ^
//            └─ Tipo 2 (CNPJ)
```

### Exemplo 2: CPF

```php
$id = IdGenerator::generateDpsId(
    '123.456.789-01',  // CPF (aceita formatado)
    '2314003',         // Várzea Alegre - CE
    '1',               // Série 1
    '46'               // Número 46
);

echo $id;
// DPS231400310001234567890100001000000000000046
//            ^
//            └─ Tipo 1 (CPF)
//              └─ CPF preenchido: 00012345678901
```

### Exemplo 3: Série Alfanumérica

```php
$id = IdGenerator::generateDpsId(
    '11905971000105',
    '3304557',         // Rio de Janeiro - RJ
    'A',               // Série A
    '6'
);

echo $id;
// DPS33045572119059710001050000A000000000000006
//                                └─ Série "0000A"
```

### Exemplo 4: Número Grande

```php
$id = IdGenerator::generateDpsId(
    '12345678000199',
    '3550308',
    '999',             // Série 999
    '999999999999999'  // Número máximo (15 dígitos)
);

echo $id;
// DPS355030821234567800019900999999999999999999
```

---

## Integração com DTOs

### Uso Recomendado

```php
use Nfse\Support\IdGenerator;
use Nfse\Dto\Nfse\{DpsData, InfDpsData};

// 1. Gerar o ID ANTES de criar o DTO
$idDps = IdGenerator::generateDpsId(
    $prestador->cnpj,
    $codigoMunicipio,
    $serie,
    $numeroDps
);

// 2. Usar o ID gerado no DTO
$dps = new DpsData([
    '@attributes' => ['versao' => '1.00'],
    'infDPS' => [
        '@attributes' => ['Id' => $idDps],  // ✅ ID gerado corretamente
        'serie' => $serie,
        'nDPS' => $numeroDps,
        // ... outros campos
    ]
]);
```

### Exemplo Completo

```php
use Nfse\Support\IdGenerator;

// Dados do emitente
$cnpjEmitente = '11905971000105';
$codigoMunicipio = '3304557'; // Rio de Janeiro
$serie = '333';
$numero = 6;

// Gerar ID
$idDps = IdGenerator::generateDpsId(
    $cnpjEmitente,
    $codigoMunicipio,
    $serie,
    $numero
);

// Criar DPS
$dps = new DpsData([
    '@attributes' => ['versao' => '1.01'],
    'infDPS' => [
        '@attributes' => ['Id' => $idDps], // DPS330455721190597100010500333000000000000006
        'tpAmb' => 2,
        'dhEmi' => now()->format('Y-m-d\TH:i:sP'),
        'serie' => $serie,
        'nDPS' => (string)$numero,
        'cLocEmi' => $codigoMunicipio,
        'prest' => [
            'CNPJ' => $cnpjEmitente,
            // ...
        ],
        // ...
    ]
]);
```

---

## Validação Automática

O `IdGenerator` realiza automaticamente:

### 1. Remoção de Formatação

```php
// Todos estes formatos funcionam:
$id1 = IdGenerator::generateDpsId('12345678000199', ...);
$id2 = IdGenerator::generateDpsId('12.345.678/0001-99', ...);
$id3 = IdGenerator::generateDpsId('123.456.789-01', ...);

// Internamente, remove tudo que não é número
```

### 2. Detecção Automática de Tipo

```php
// CPF (11 dígitos) → Tipo 1
$id = IdGenerator::generateDpsId('12345678901', ...);
//                                ^11 dígitos = CPF

// CNPJ (14 dígitos) → Tipo 2
$id = IdGenerator::generateDpsId('12345678000199', ...);
//                                ^14 dígitos = CNPJ
```

### 3. Preenchimento com Zeros

```php
// CPF é preenchido à esquerda até 14 dígitos
'12345678901' → '00012345678901'

// Série é preenchida até 5 dígitos
'1' → '00001'
'A' → '0000A'
'999' → '00999'

// Número é preenchido até 15 dígitos
'123' → '000000000000123'
```

---

## Casos de Uso

### 1. Sistema de Numeração Sequencial

```php
class DpsService
{
    public function gerarNovaDps(array $dados): DpsData
    {
        // Buscar próximo número
        $ultimaDps = Dps::where('serie', $dados['serie'])
            ->orderBy('numero', 'desc')
            ->first();

        $proximoNumero = $ultimaDps ? $ultimaDps->numero + 1 : 1;

        // Gerar ID
        $idDps = IdGenerator::generateDpsId(
            $dados['cnpj_prestador'],
            $dados['codigo_municipio'],
            $dados['serie'],
            $proximoNumero
        );

        // Criar DPS
        return new DpsData([
            '@attributes' => ['versao' => '1.00'],
            'infDPS' => [
                '@attributes' => ['Id' => $idDps],
                'serie' => $dados['serie'],
                'nDPS' => (string)$proximoNumero,
                // ...
            ]
        ]);
    }
}
```

### 2. Múltiplas Séries

```php
// Série por tipo de serviço
$serieConsultoria = 'A';
$serieSuporte = 'B';
$serieDesenvolvimento = 'C';

$idConsultoria = IdGenerator::generateDpsId(
    $cnpj, $codMun, $serieConsultoria, $numero
);

$idSuporte = IdGenerator::generateDpsId(
    $cnpj, $codMun, $serieSuporte, $numero
);
```

### 3. Validação de ID Existente

```php
use Nfse\Support\IdGenerator;

function validarIdDps(string $id, DpsData $dps): bool
{
    $idEsperado = IdGenerator::generateDpsId(
        $dps->infDps->prestador->cnpj ?? $dps->infDps->prestador->cpf,
        $dps->infDps->codigoLocalEmissao,
        $dps->infDps->serie,
        $dps->infDps->numeroDps
    );

    return $id === $idEsperado;
}
```

---

## 💡 Boas Práticas

### ✅ Recomendado

```php
// 1. Gere o ID antes de criar o DTO
$id = IdGenerator::generateDpsId(...);
$dps = new DpsData(['@attributes' => ['versao' => '1.00'], 'infDPS' => ['@attributes' => ['Id' => $id], ...]]);

// 2. Use os mesmos dados do prestador
$id = IdGenerator::generateDpsId(
    $prestador->cnpj ?? $prestador->cpf, // ✅
    $codigoMunicipio,
    $serie,
    $numero
);

// 3. Armazene o ID no banco para referência
$dps->id = $id;
$dps->save();
```

### ❌ Evite

```php
// Não crie IDs manualmente
$id = "DPS" . $codMun . "2" . $cnpj . ...; // ❌

// Não use dados inconsistentes
$id = IdGenerator::generateDpsId(
    '12345678000199',  // CNPJ do prestador
    '3550308',
    '1',
    '100'
);
$dps->prestador->cnpj = '99999999000199'; // ❌ CNPJ diferente!

// Não ignore o ID gerado
IdGenerator::generateDpsId(...); // ❌ Não usa o retorno
$dps->id = 'DPS123'; // ❌ ID inválido
```

---

## Troubleshooting

### Problema: ID com tamanho incorreto

```php
$id = IdGenerator::generateDpsId('123', '3550308', '1', '1');
// ❌ CPF/CNPJ inválido (muito curto)
```

**Solução:** Certifique-se de que o CPF tem 11 dígitos ou CNPJ tem 14 dígitos.

### Problema: Código município com tamanho errado

```php
$id = IdGenerator::generateDpsId('12345678000199', '355', '1', '1');
// ⚠️ Código será truncado ou preenchido
```

**Solução:** Use sempre 7 dígitos para o código IBGE.

---

## 🔗 Veja Também

-   [CpfCnpjFormatter](./cpf-cnpj-formatter) - Formatação de documentos
-   [TaxCalculator](./tax-calculator) - Cálculos tributários
-   [InfDpsData](../types/main-documents) - DTO da DPS
