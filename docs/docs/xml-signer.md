# XmlSigner - Assinador Digital XML

O `XmlSigner` é responsável por assinar digitalmente documentos XML usando certificados digitais A1 (formato PFX/PKCS#12).

## Instalação

O assinador já está incluído no pacote. Certifique-se de ter um certificado digital válido no formato `.pfx`.

## Uso Básico

```php
use Nfse\Signer\Certificate;
use Nfse\Signer\XmlSigner;

// Carregar o certificado
$certificate = new Certificate('/path/to/certificate.pfx', 'senha');

// Criar o assinador
$signer = new XmlSigner($certificate);

// Assinar o XML
$xmlContent = file_get_contents('/path/to/dps.xml');
$signedXml = $signer->sign($xmlContent, 'infDPS');
```

## Parâmetros do Método `sign()`

O método `sign()` aceita os seguintes parâmetros:

### Parâmetros Obrigatórios

| Parâmetro  | Tipo     | Descrição                                                                      |
| ---------- | -------- | ------------------------------------------------------------------------------ |
| `$content` | `string` | Conteúdo XML a ser assinado                                                    |
| `$tagname` | `string` | Nome da tag que contém o elemento a ser assinado (ex: `'infDPS'`, `'infNFSe'`) |

### Parâmetros Opcionais

| Parâmetro    | Tipo     | Padrão                      | Descrição                                                                        |
| ------------ | -------- | --------------------------- | -------------------------------------------------------------------------------- |
| `$mark`      | `string` | `'Id'`                      | Nome do atributo que contém o identificador único do elemento                    |
| `$algorithm` | `int`    | `OPENSSL_ALGO_SHA1`         | Algoritmo de hash para assinatura (`OPENSSL_ALGO_SHA1` ou `OPENSSL_ALGO_SHA256`) |
| `$canonical` | `array`  | `[true, false, null, null]` | Opções de canonicalização `[exclusive, withComments, xpath, nsPrefixes]`         |
| `$rootname`  | `string` | `''`                        | Nome do elemento raiz esperado (para validação)                                  |
| `$options`   | `array`  | `[]`                        | Opções adicionais (reservado para uso futuro)                                    |

## Exemplos de Uso

### 1. Assinatura Simples (Padrão)

```php
use Nfse\Signer\Certificate;
use Nfse\Signer\XmlSigner;

$certificate = new Certificate('/path/to/certificate.pfx', 'senha');
$signer = new XmlSigner($certificate);

$xml = file_get_contents('/path/to/dps.xml');
$signedXml = $signer->sign($xml, 'infDPS');
```

### 2. Assinatura com SHA-256

```php
$signedXml = $signer->sign(
    content: $xml,
    tagname: 'infDPS',
    algorithm: OPENSSL_ALGO_SHA256
);
```

### 3. Assinatura com Validação de Elemento Raiz

```php
$signedXml = $signer->sign(
    content: $xml,
    tagname: 'infDPS',
    rootname: 'DPS'  // Valida que o elemento raiz é <DPS>
);
```

### 4. Assinatura com Todos os Parâmetros Customizados

```php
$signedXml = $signer->sign(
    content: $xml,
    tagname: 'infDPS',
    mark: 'Id',
    algorithm: OPENSSL_ALGO_SHA1,
    canonical: [true, false, null, null],
    rootname: 'DPS'
);
```

### 5. Assinatura com Atributo ID Customizado

Se o seu XML usa um atributo diferente de `Id` para identificação:

```php
$signedXml = $signer->sign(
    content: $xml,
    tagname: 'infDPS',
    mark: 'ID'  // Usa o atributo 'ID' ao invés de 'Id'
);
```

## Algoritmos de Hash Suportados

### SHA-1 (Padrão)

```php
$signer->sign($xml, 'infDPS', algorithm: OPENSSL_ALGO_SHA1);
```

**Namespaces utilizados:**

-   Signature Method: `http://www.w3.org/2000/09/xmldsig#rsa-sha1`
-   Digest Method: `http://www.w3.org/2000/09/xmldsig#sha1`

### SHA-256

```php
$signer->sign($xml, 'infDPS', algorithm: OPENSSL_ALGO_SHA256);
```

**Namespaces utilizados:**

-   Signature Method: `http://www.w3.org/2001/04/xmldsig-more#rsa-sha256`
-   Digest Method: `http://www.w3.org/2001/04/xmlenc#sha256`

## Canonicalização

O parâmetro `$canonical` controla como o XML é normalizado antes da assinatura. É um array com 4 elementos:

```php
[
    exclusive,      // bool: Canonicalização exclusiva (true) ou inclusiva (false)
    withComments,   // bool: Incluir comentários (true) ou não (false)
    xpath,          // array|null: XPath para filtrar nós
    nsPrefixes      // array|null: Prefixos de namespace
]
```

### Padrão (Recomendado para NFSe)

```php
$canonical = [true, false, null, null];
```

### Canonicalização Inclusiva com Comentários

```php
$canonical = [false, true, null, null];
```

## Estrutura da Assinatura Gerada

O assinador gera uma estrutura XML-DSig padrão:

```xml
<Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
    <SignedInfo>
        <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
        <SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"/>
        <Reference URI="#DPS330455721190597100010500333000000000000006">
            <Transforms>
                <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
                <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
            </Transforms>
            <DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"/>
            <DigestValue>...</DigestValue>
        </Reference>
    </SignedInfo>
    <SignatureValue>...</SignatureValue>
    <KeyInfo>
        <X509Data>
            <X509Certificate>...</X509Certificate>
        </X509Data>
    </KeyInfo>
</Signature>
```

## Validações

O assinador realiza as seguintes validações:

1. **XML não vazio**: Lança exceção se o conteúdo XML estiver vazio
2. **Tag encontrada**: Verifica se a tag especificada existe no XML
3. **Atributo ID presente**: Verifica se o elemento possui o atributo identificador
4. **Elemento raiz** (opcional): Valida o nome do elemento raiz se `$rootname` for especificado

## Tratamento de Erros

```php
use Exception;

try {
    $signedXml = $signer->sign($xml, 'infDPS', rootname: 'DPS');
} catch (Exception $e) {
    // Possíveis erros:
    // - "Conteúdo XML vazio."
    // - "Tag infDPS não encontrada para assinatura."
    // - "Tag a ser assinada deve possuir um atributo 'Id'."
    // - "Elemento raiz esperado: DPS, encontrado: NFSe"
    echo "Erro ao assinar: " . $e->getMessage();
}
```

## Casos de Uso Específicos

### Assinando DPS para NFSe Nacional

```php
use Nfse\Signer\Certificate;
use Nfse\Signer\XmlSigner;

// Carregar certificado
$certificate = new Certificate('/path/to/certificate.pfx', 'senha');
$signer = new XmlSigner($certificate);

// Carregar DPS gerado
$dpsXml = file_get_contents('/path/to/dps.xml');

// Assinar com validação
$signedDps = $signer->sign(
    content: $dpsXml,
    tagname: 'infDPS',
    mark: 'Id',
    algorithm: OPENSSL_ALGO_SHA1,
    canonical: [true, false, null, null],
    rootname: 'DPS'
);

// Salvar DPS assinado
file_put_contents('/path/to/dps-signed.xml', $signedDps);
```

### Assinando Múltiplos Documentos

```php
$documents = [
    '/path/to/dps1.xml',
    '/path/to/dps2.xml',
    '/path/to/dps3.xml',
];

foreach ($documents as $docPath) {
    $xml = file_get_contents($docPath);
    $signed = $signer->sign($xml, 'infDPS');
    file_put_contents(
        str_replace('.xml', '-signed.xml', $docPath),
        $signed
    );
}
```

## 💡 Boas Práticas

1. ✅ **Sempre valide o certificado** antes de assinar em produção
2. 🔒 **Use SHA-256** quando possível para maior segurança
3. 🎯 **Especifique o `rootname`** para validação adicional
4. 🛡️ **Mantenha as chaves privadas seguras** e nunca as versione no Git
5. 🧪 **Use certificados de teste** em ambiente de desenvolvimento
6. 📅 **Verifique a validade do certificado** antes de assinar

## 🔗 Referências

-   [XML Signature Syntax and Processing](https://www.w3.org/TR/xmldsig-core/)
-   [Canonical XML Version 1.0](https://www.w3.org/TR/xml-c14n)
-   [Manual NFSe Nacional - SEFIN](https://www.gov.br/nfse/)
