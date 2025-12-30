# Assinatura Digital

O pacote oferece suporte completo para assinatura digital de documentos XML (DPS e NFS-e) utilizando certificados A1 (PKCS#12), conforme exigido pelo padrão nacional.

## Requisitos

-   Certificado Digital A1 (arquivo `.pfx` ou `.p12`).
-   Senha do certificado.
-   Extensão `openssl` habilitada no PHP.

## Carregando o Certificado

Utilize a classe `Certificate` para carregar seu certificado digital.

```php
use Nfse\Signer\Certificate;

try {
    $certificado = new Certificate('/caminho/para/certificado.pfx', 'senha123');

    // Você pode acessar a chave privada e o certificado limpo se necessário
    $privateKey = $certificado->getPrivateKey();
    $publicCert = $certificado->getCleanCertificate();
} catch (\Exception $e) {
    echo "Erro ao carregar certificado: " . $e->getMessage();
}
```

## Assinando um XML

Utilize a classe `XmlSigner` para assinar digitalmente o XML. A assinatura segue o padrão XMLDSig (RSA-SHA1) com canonização C14N.

```php
use Nfse\Signer\XmlSigner;

// 1. Instancie o assinador com o certificado carregado
$signer = new XmlSigner($certificado);

// 2. Carregue o XML que deseja assinar (string)
$xmlContent = file_get_contents('dps-gerada.xml');

// 3. Assine o documento
// O segundo parâmetro é a tag que será assinada (ex: 'infDPS' para DPS, 'infNFSe' para NFS-e)
try {
    $xmlAssinado = $signer->sign($xmlContent, 'infDPS');

    // Salve ou utilize o XML assinado
    file_put_contents('dps-assinada.xml', $xmlAssinado);
} catch (\Exception $e) {
    echo "Erro ao assinar XML: " . $e->getMessage();
}
```

## Detalhes Técnicos

-   **Algoritmo de Assinatura**: RSA-SHA1 (`http://www.w3.org/2000/09/xmldsig#rsa-sha1`).
-   **Algoritmo de Digest**: SHA1 (`http://www.w3.org/2000/09/xmldsig#sha1`).
-   **Canonização**: C14N (`http://www.w3.org/TR/2001/REC-xml-c14n-20010315`).
-   **Transformações**: Enveloped Signature e C14N.
-   **Estrutura**: A assinatura é anexada como filha do elemento pai da tag assinada (ex: dentro de `<DPS>` para `<infDPS>`).

## Validação

A classe `Certificate` realiza validações básicas ao carregar o arquivo PFX, verificando se a senha está correta e se o arquivo é válido. Validações adicionais de expiração podem ser implementadas conforme a necessidade do negócio.
