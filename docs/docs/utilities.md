# Utilitários

O pacote inclui classes utilitárias para facilitar tarefas comuns, como formatação de documentos e cálculos simples de impostos.

## Formatação de Documentos

A classe `DocumentFormatter` oferece métodos estáticos para formatar e limpar CPF, CNPJ e CEP.

```php
use Nfse\Support\DocumentFormatter;

// Formatar CPF
echo DocumentFormatter::formatCpf('12345678901'); // 123.456.789-01

// Formatar CNPJ
echo DocumentFormatter::formatCnpj('12345678000199'); // 12.345.678/0001-99

// Formatar CEP
echo DocumentFormatter::formatCep('12345678'); // 12345-678

// Remover formatação (manter apenas números)
echo DocumentFormatter::unformat('123.456.789-01'); // 12345678901
```

## Cálculo de Impostos

A classe `TaxCalculator` fornece um método simples para calcular o valor de um imposto com base na base de cálculo e alíquota.

```php
use Nfse\Support\TaxCalculator;

$baseCalculo = 1000.00;
$aliquota = 5.0; // 5%

$valorImposto = TaxCalculator::calculate($baseCalculo, $aliquota);

echo $valorImposto; // 50.00
```

> **Nota**: O cálculo arredonda o resultado para 2 casas decimais.

## Geração de Documentos (Testes)

Para fins de testes e desenvolvimento, a classe `DocumentGenerator` (no namespace `Nfse\Support`) pode gerar CPFs e CNPJs válidos aleatórios.

```php
use Nfse\Support\DocumentGenerator;

// Gerar CPF válido (sem formatação)
$cpf = DocumentGenerator::generateCpf();

// Gerar CNPJ válido (formatado)
$cnpj = DocumentGenerator::generateCnpj(true);
```

## Geração de IDs

A classe `IdGenerator` facilita a criação dos identificadores únicos exigidos pelo padrão nacional, como o ID da DPS.

```php
use Nfse\Support\IdGenerator;

$cpfCnpj = '12.345.678/0001-99';
$codIbge = '3550308'; // Código do município
$serie = '1';
$numero = 123;

$idDps = IdGenerator::generateDpsId($cpfCnpj, $codIbge, $serie, $numero);

echo $idDps; // DPS355030821234567800019900001000000000000123
```
