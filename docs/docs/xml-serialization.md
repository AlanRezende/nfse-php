# Geração de XML

Após validar seus dados usando os DTOs, o próximo passo é gerar o XML compatível com o padrão nacional da NFS-e. A biblioteca fornece builders específicos para essa finalidade.

## Por que usar os Builders?

A estrutura do XML da NFS-e Nacional é complexa e rigorosa. Os builders (`DpsXmlBuilder` e `NfseXmlBuilder`) abstraem essa complexidade, garantindo que:

-   A hierarquia de elementos esteja correta.
-   Os namespaces sejam aplicados adequadamente (`http://www.sped.fazenda.gov.br/nfse`).
-   Valores numéricos e datas sejam formatados conforme a especificação.

## Gerando XML de uma DPS

Para gerar o XML de uma Declaração de Prestação de Serviço (DPS), utilize o `DpsXmlBuilder`.

```php
use Nfse\Dto\DpsData;
use Nfse\Xml\DpsXmlBuilder;

// 1. Instancie seu DTO (geralmente vindo de um formulário ou banco de dados)
$dpsData = DpsData::from($dados);

// 2. Utilize o builder para gerar o XML
$builder = new DpsXmlBuilder();
$xml = $builder->build($dpsData);

echo $xml;
```

## Gerando XML de uma NFS-e

Para documentos de NFS-e já processados ou para visualização, utilize o `NfseXmlBuilder`.

```php
use Nfse\Dto\NfseData;
use Nfse\Xml\NfseXmlBuilder;

$nfseData = NfseData::from($dadosNfse);

$builder = new NfseXmlBuilder();
$xml = $builder->build($nfseData);

echo $xml;
```

## Detalhes de Implementação

Os builders utilizam a extensão `DOMDocument` nativa do PHP para garantir a geração de um XML válido e bem formado.

> [!TIP]
> O XML gerado pelos builders é o que deve ser assinado digitalmente antes do envio para os webservices da Receita Federal.
