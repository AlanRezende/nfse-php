# Validações de DFE

A biblioteca utiliza uma abordagem de validação programática através da classe `DpsValidator`. Isso permite validar regras complexas do manual da NFS-e Nacional que não seriam possíveis apenas com tipos simples.

## Como funciona

A classe `DpsValidator` analisa um objeto `DpsData` e verifica se ele está em conformidade com as regras de negócio e do schema.

### Exemplo de Uso

```php
use Nfse\Dto\Nfse\DpsData;
use Nfse\Validator\DpsValidator;

$dps = new DpsData([...]);
$validator = new DpsValidator();

$result = $validator->validate($dps);

if ($result->fails()) {
    // Tratar erros
    $errors = $result->getErrors();
    foreach ($errors as $error) {
        echo "Erro: $error\n";
    }
}
```

## Regras Implementadas

Atualmente, o validador verifica regras essenciais como:

1.  **Prestador**: Obrigatório em todos os documentos.
2.  **Endereço do Prestador**: Obrigatório quando o prestador não for o próprio emitente da nota (Regra E0129).
3.  **Tomador Identificado**: Se o tomador for identificado (CPF/CNPJ/NIF), o endereço torna-se obrigatório.
4.  **Estrangeiros**: Se o tomador for identificado por NIF, o endereço no exterior (`enderecoExterior`) é obrigatório.
5.  **Endereço Nacional**: Para tomadores nacionais, o código do município IBGE é obrigatório.

## Ambiente de Testes

As validações são testadas exaustivamente em `tests/Unit/Validator/DpsValidatorTest.php` para garantir que os documentos gerados sejam aceitos pela API da SEFIN Nacional.
