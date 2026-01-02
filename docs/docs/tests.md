# 🧪 Testes e Cobertura

O projeto utiliza o [Pest](https://pestphp.com/) como framework de testes, garantindo uma sintaxe expressiva e ferramentas poderosas para manter a qualidade do código.

## 🚀 Executando Testes

Para rodar a suíte de testes completa:

```bash
composer test
```

Ou diretamente via Pest:

```bash
./vendor/bin/pest
```

---

## 📊 Cobertura de Código (Coverage)

A cobertura de código mede a porcentagem de código executada durante os testes. Isso ajuda a identificar partes do sistema que podem precisar de mais atenção.

### Requisitos

Para gerar relatórios de cobertura, você precisará do PHP com **Xdebug 3.0+** ou **PCOV** instalado.

#### Recomendado: PCOV (Mais rápido)

```bash
pecl install pcov
# Ative a extensão no seu php.ini
```

#### Alternativa: Xdebug

```bash
# Certifique-se de que XDEBUG_MODE=coverage esteja configurado
```

### Gerando Relatório

Use a opção `--coverage` para ver o resumo no terminal:

```bash
./vendor/bin/pest --coverage
```

### Linhas Não Cobertas

Se houver linhas não cobertas, elas serão destacadas em **vermelho**. Por exemplo, `52..60` indica que as linhas de 52 a 60 não foram executadas pelos testes.

---

## 🛡️ Limites Mínimos (Thresholds)

Para garantir que a cobertura não diminua com o tempo, você pode impor limites mínimos. Se o valor não for atingido, os testes falharão.

### Definindo um Mínimo (Ex: 90%)

```bash
./vendor/bin/pest --coverage --min=90
```

### Definindo um Valor Exato

```bash
./vendor/bin/pest --coverage --exactly=100
```

---

## 🙈 Ignorando Código

Em casos excepcionais onde um bloco de código não deve ser contabilizado na cobertura, você pode usar anotações:

```php
/** @codeCoverageIgnore */
public function metodoNaoTestavel()
{
    // ...
}
```

Ou para blocos específicos:

```php
// @codeCoverageIgnoreStart
if ($condicaoRara) {
    return false;
}
// @codeCoverageIgnoreEnd
```

---

## 🔍 Análise Estática (PHPStan)

Além dos testes unitários, o projeto utiliza o **PHPStan** para análise estática de código, ajudando a encontrar bugs antes mesmo da execução.

### Executando a Análise

Para rodar o PHPStan:

```bash
composer phpstan
```

O projeto está configurado no **nível 5** de rigor. Você pode ajustar esse nível no arquivo `phpstan.neon`.
