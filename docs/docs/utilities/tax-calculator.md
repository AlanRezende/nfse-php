# TaxCalculator

A classe `TaxCalculator` fornece métodos para cálculos tributários simples, facilitando o cálculo de impostos com base em alíquotas percentuais.

## Instalação

Esta classe faz parte do pacote principal e está disponível no namespace `Nfse\Support`.

```php
use Nfse\Support\TaxCalculator;
```

## Método Principal

### calculate()

Calcula o valor de um imposto com base na base de cálculo e alíquota percentual.

```php
$valorImposto = TaxCalculator::calculate(1000.00, 5.0);
echo $valorImposto; // 50.00
```

**Assinatura:**

```php
public static function calculate(float $baseCalculo, float $aliquota): float
```

**Parâmetros:**

-   `$baseCalculo` (float) - Valor base para o cálculo do imposto
-   `$aliquota` (float) - Alíquota em percentual (ex: 5.0 para 5%, 0.65 para 0,65%)

**Retorno:**

-   (float) Valor do imposto arredondado para 2 casas decimais

**Fórmula:**

```
Valor do Imposto = (Base de Cálculo × Alíquota) ÷ 100
```

---

## Exemplos Práticos

### Cálculo de ISSQN

```php
use Nfse\Support\TaxCalculator;

$valorServico = 10000.00;
$aliquotaIss = 5.0; // 5%

$valorIss = TaxCalculator::calculate($valorServico, $aliquotaIss);

echo "Valor do Serviço: R$ " . number_format($valorServico, 2, ',', '.') . "\n";
echo "ISS (5%): R$ " . number_format($valorIss, 2, ',', '.') . "\n";
echo "Valor Líquido: R$ " . number_format($valorServico - $valorIss, 2, ',', '.') . "\n";

// Saída:
// Valor do Serviço: R$ 10.000,00
// ISS (5%): R$ 500,00
// Valor Líquido: R$ 9.500,00
```

### Cálculo de PIS

```php
$baseCalculo = 5000.00;
$aliquotaPis = 0.65; // 0,65%

$valorPis = TaxCalculator::calculate($baseCalculo, $aliquotaPis);

echo $valorPis; // 32.50
```

### Cálculo de COFINS

```php
$baseCalculo = 5000.00;
$aliquotaCofins = 3.0; // 3%

$valorCofins = TaxCalculator::calculate($baseCalculo, $aliquotaCofins);

echo $valorCofins; // 150.00
```

### Cálculo de IRRF

```php
$baseCalculo = 10000.00;
$aliquotaIrrf = 1.5; // 1,5%

$valorIrrf = TaxCalculator::calculate($baseCalculo, $aliquotaIrrf);

echo $valorIrrf; // 150.00
```

### Cálculo de CSLL

```php
$baseCalculo = 10000.00;
$aliquotaCsll = 1.0; // 1%

$valorCsll = TaxCalculator::calculate($baseCalculo, $aliquotaCsll);

echo $valorCsll; // 100.00
```

---

## Casos de Uso Completos

### 1. Cálculo Completo de Tributos Federais

```php
use Nfse\Support\TaxCalculator;

$valorServico = 10000.00;

// Calcular cada tributo
$pis = TaxCalculator::calculate($valorServico, 0.65);
$cofins = TaxCalculator::calculate($valorServico, 3.0);
$irrf = TaxCalculator::calculate($valorServico, 1.5);
$csll = TaxCalculator::calculate($valorServico, 1.0);

// Total de tributos federais
$totalTributosFederais = $pis + $cofins + $irrf + $csll;

echo "PIS (0,65%): R$ " . number_format($pis, 2, ',', '.') . "\n";
echo "COFINS (3%): R$ " . number_format($cofins, 2, ',', '.') . "\n";
echo "IRRF (1,5%): R$ " . number_format($irrf, 2, ',', '.') . "\n";
echo "CSLL (1%): R$ " . number_format($csll, 2, ',', '.') . "\n";
echo "Total Federal: R$ " . number_format($totalTributosFederais, 2, ',', '.') . "\n";

// Saída:
// PIS (0,65%): R$ 65,00
// COFINS (3%): R$ 300,00
// IRRF (1,5%): R$ 150,00
// CSLL (1%): R$ 100,00
// Total Federal: R$ 615,00
```

### 2. Integração com DTOs

```php
use Nfse\Support\TaxCalculator;
use Nfse\Dto\TributacaoData;

$valorServico = 10000.00;
$baseCalculoPisCofins = $valorServico;

// Calcular valores
$valorPis = TaxCalculator::calculate($baseCalculoPisCofins, 0.65);
$valorCofins = TaxCalculator::calculate($baseCalculoPisCofins, 3.0);
$valorIrrf = TaxCalculator::calculate($valorServico, 1.5);
$valorCsll = TaxCalculator::calculate($valorServico, 1.0);

// Criar DTO com valores calculados
$tributacao = new TributacaoData(
    tributacaoIssqn: 1,
    tipoRetencaoIssqn: 1,
    cstPisCofins: '01',
    baseCalculoPisCofins: $baseCalculoPisCofins,
    aliquotaPis: 0.65,
    aliquotaCofins: 3.0,
    valorPis: $valorPis,
    valorCofins: $valorCofins,
    tipoRetencaoPisCofins: 2,
    valorRetidoIrrf: $valorIrrf,
    valorRetidoCsll: $valorCsll,
    // ...
);
```

### 3. Cálculo com Base Reduzida

```php
use Nfse\Support\TaxCalculator;

$valorServico = 10000.00;
$percentualReducao = 30.0; // 30% de redução

// Calcular base reduzida
$valorReducao = TaxCalculator::calculate($valorServico, $percentualReducao);
$baseCalculoReduzida = $valorServico - $valorReducao;

// Calcular ISS sobre base reduzida
$aliquotaIss = 5.0;
$valorIss = TaxCalculator::calculate($baseCalculoReduzida, $aliquotaIss);

echo "Valor do Serviço: R$ " . number_format($valorServico, 2, ',', '.') . "\n";
echo "Redução (30%): R$ " . number_format($valorReducao, 2, ',', '.') . "\n";
echo "Base Reduzida: R$ " . number_format($baseCalculoReduzida, 2, ',', '.') . "\n";
echo "ISS (5% sobre base reduzida): R$ " . number_format($valorIss, 2, ',', '.') . "\n";

// Saída:
// Valor do Serviço: R$ 10.000,00
// Redução (30%): R$ 3.000,00
// Base Reduzida: R$ 7.000,00
// ISS (5% sobre base reduzida): R$ 350,00
```

### 4. Cálculo de Valor Líquido

```php
use Nfse\Support\TaxCalculator;

$valorBruto = 10000.00;

// Calcular retenções
$iss = TaxCalculator::calculate($valorBruto, 5.0);
$irrf = TaxCalculator::calculate($valorBruto, 1.5);
$csll = TaxCalculator::calculate($valorBruto, 1.0);
$pis = TaxCalculator::calculate($valorBruto, 0.65);
$cofins = TaxCalculator::calculate($valorBruto, 3.0);

// Total retido
$totalRetencoes = $iss + $irrf + $csll + $pis + $cofins;

// Valor líquido
$valorLiquido = $valorBruto - $totalRetencoes;

echo "Valor Bruto: R$ " . number_format($valorBruto, 2, ',', '.') . "\n";
echo "(-) Retenções: R$ " . number_format($totalRetencoes, 2, ',', '.') . "\n";
echo "Valor Líquido: R$ " . number_format($valorLiquido, 2, ',', '.') . "\n";

// Saída:
// Valor Bruto: R$ 10.000,00
// (-) Retenções: R$ 1.115,00
// Valor Líquido: R$ 8.885,00
```

---

## Tabela de Alíquotas Comuns

| Tributo    | Alíquota Típica | Exemplo de Uso                           |
| ---------- | --------------- | ---------------------------------------- |
| **ISSQN**  | 2% a 5%         | `TaxCalculator::calculate($valor, 5.0)`  |
| **PIS**    | 0,65% ou 1,65%  | `TaxCalculator::calculate($valor, 0.65)` |
| **COFINS** | 3% ou 7,6%      | `TaxCalculator::calculate($valor, 3.0)`  |
| **IRRF**   | 1,5%            | `TaxCalculator::calculate($valor, 1.5)`  |
| **CSLL**   | 1%              | `TaxCalculator::calculate($valor, 1.0)`  |
| **INSS**   | 11%             | `TaxCalculator::calculate($valor, 11.0)` |

> **Nota:** As alíquotas variam conforme a legislação vigente, regime tributário e tipo de serviço. Sempre consulte um contador.

---

## Arredondamento

O método `calculate()` sempre retorna valores arredondados para **2 casas decimais**, seguindo o padrão brasileiro de valores monetários.

```php
$valor = TaxCalculator::calculate(100.00, 3.333);
echo $valor; // 3.33 (arredondado)

$valor = TaxCalculator::calculate(100.00, 3.336);
echo $valor; // 3.34 (arredondado)
```

---

## 💡 Boas Práticas

### ✅ Recomendado

```php
// Use constantes para alíquotas
const ALIQUOTA_ISS = 5.0;
const ALIQUOTA_PIS = 0.65;
const ALIQUOTA_COFINS = 3.0;

$iss = TaxCalculator::calculate($valor, ALIQUOTA_ISS);
$pis = TaxCalculator::calculate($valor, ALIQUOTA_PIS);
```

### ✅ Centralize Configurações

```php
// config/taxes.php
return [
    'iss' => [
        'default' => 5.0,
        'reduced' => 2.0,
    ],
    'federal' => [
        'pis' => 0.65,
        'cofins' => 3.0,
        'irrf' => 1.5,
        'csll' => 1.0,
    ],
];

// Uso
$iss = TaxCalculator::calculate($valor, config('taxes.iss.default'));
```

### ❌ Evite

```php
// Não use valores "mágicos" direto no código
$iss = TaxCalculator::calculate($valor, 5.0); // ❌ De onde vem 5.0?

// Não confunda percentual com decimal
$iss = TaxCalculator::calculate($valor, 0.05); // ❌ Isso é 0,05%, não 5%
```

---

## Limitações

-   **Não valida** se a alíquota é válida para o tipo de tributo
-   **Não considera** faixas progressivas de tributação
-   **Não aplica** deduções ou isenções automáticas
-   Para cálculos complexos, considere criar classes específicas

---

## 🔗 Veja Também

-   [DocumentFormatter](/utilities/document-formatter) - Formatação de documentos
-   [IdGenerator](/utilities/id-generator) - Geração de IDs únicos
-   [TributacaoData](/types/values-taxation) - DTO de tributação
