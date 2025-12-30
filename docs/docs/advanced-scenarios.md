# Cenários Avançados e Exemplos

Esta seção detalha cenários complexos de emissão de NFS-e, cobrindo variações de tomadores, regimes especiais, construção civil e retenções.

## Identificação do Tomador

A correta identificação do tomador é crucial para a validação da nota. Abaixo estão os cenários suportados.

### 1. Tomador Pessoa Física (PF)

Para tomadores pessoa física, o CPF é obrigatório.

```php
use Nfse\Dto\TomadorData;
use Nfse\Dto\EnderecoData;

$tomador = new TomadorData(
    cpf: '12345678901',
    cnpj: null,
    nome: 'João da Silva',
    endereco: new EnderecoData(
        codigoMunicipio: '3550308', // São Paulo
        cep: '01001000',
        logradouro: 'Praça da Sé',
        numero: '1',
        bairro: 'Sé',
        complemento: null,
        enderecoExterior: null
    ),
    telefone: '11999999999',
    email: 'joao@email.com'
);
```

### 2. Tomador Pessoa Jurídica (PJ)

Para empresas, o CNPJ é obrigatório. A Inscrição Municipal (IM) é opcional, mas recomendada se houver.

```php
$tomador = new TomadorData(
    cpf: null,
    cnpj: '12345678000199',
    inscricaoMunicipal: '123456',
    nome: 'Empresa Legal Ltda',
    endereco: new EnderecoData(
        codigoMunicipio: '3550308',
        cep: '01001000',
        logradouro: 'Av Paulista',
        numero: '1000',
        bairro: 'Bela Vista',
        complemento: 'Conj 101',
        enderecoExterior: null
    ),
    telefone: '1133334444',
    email: 'contato@empresa.com'
);
```

### 3. Tomador Estrangeiro

Para tomadores no exterior, não se usa CPF/CNPJ. Utiliza-se o NIF (Número de Identificação Fiscal) e o endereço exterior.

```php
use Nfse\Dto\EnderecoExteriorData;

$tomador = new TomadorData(
    cpf: null,
    cnpj: null,
    nif: '123456789', // ID Fiscal no país de origem
    nome: 'John Doe',
    endereco: new EnderecoData(
        codigoMunicipio: null, // Não preencher para exterior
        cep: null,            // Não preencher para exterior
        logradouro: '5th Avenue',
        numero: '100',
        bairro: 'Manhattan',
        complemento: null,
        enderecoExterior: new EnderecoExteriorData(
            codigoPais: 'US', // Código ISO2
            codigoEnderecamentoPostal: '10001',
            cidade: 'New York',
            estadoProvinciaRegiao: 'NY'
        )
    ),
    telefone: '15551234567',
    email: 'john.doe@email.com'
);
```

### 4. Tomador Não Identificado

Em alguns casos específicos (ex: serviços tomados por consumidores finais não identificados, se permitido pela legislação municipal), o tomador pode ser omitido ou enviado com dados mínimos.

> **Nota:** Verifique a legislação do município emissor. Geralmente, notas acima de um certo valor exigem identificação.

```php
// Na estrutura InfDpsData, o campo tomador pode ser nulo
$infDps = new InfDpsData(
    // ... outros campos
    tomador: null
);
```

---

## Construção Civil

Serviços de construção civil exigem o preenchimento do grupo `obra` dentro de `ServicoData`.

```php
use Nfse\Dto\ObraData;
use Nfse\Dto\ServicoData;
use Nfse\Dto\CodigoServicoData;
use Nfse\Dto\LocalPrestacaoData;

$servico = new ServicoData(
    localPrestacao: new LocalPrestacaoData(
        codigoLocalPrestacao: '3550308', // Município onde a obra ocorre
        codigoPaisPrestacao: null
    ),
    codigoServico: new CodigoServicoData(
        codigoTributacaoNacional: '07.02.01', // Execução de obras...
        codigoTributacaoMunicipal: '702',
        descricaoServico: 'Construção de Edifício Residencial',
        codigoNbs: '123456789',
        codigoInternoContribuinte: null
    ),
    obra: new ObraData(
        inscricaoImobiliariaFiscal: '123456', // Inscrição da obra na prefeitura
        codigoObra: 'OBRA-2023-001',          // Código interno ou alvará
        endereco: new EnderecoData(
            codigoMunicipio: '3550308',
            cep: '01001000',
            logradouro: 'Rua da Obra',
            numero: '100',
            bairro: 'Centro',
            complemento: null,
            enderecoExterior: null
        )
    ),
    // ... outros campos
);
```

---

## Retenção de ISS (ISS Retido na Fonte)

Quando o ISS é retido pelo tomador ou intermediário, deve-se configurar o `TributacaoData` corretamente.

### Retido pelo Tomador

```php
use Nfse\Dto\TributacaoData;
use Nfse\Dto\ValoresData;

$valores = new ValoresData(
    valorServicoPrestado: new ValorServicoPrestadoData(
        valorServico: 1000.00,
        valorRecebido: null
    ),
    tributacao: new TributacaoData(
        tributacaoIssqn: 1, // Operação Tributável
        tipoRetencaoIssqn: 2, // 2 - Retido pelo Tomador
        tipoImunidade: null,
        tipoSuspensao: null,
        numeroProcessoSuspensao: null,
        beneficioMunicipal: null,
        cstPisCofins: null,
        percentualTotalTributosSN: null,
        indicadorTotalTributos: 0
    ),
    // ...
);
```

### Retido pelo Intermediário

```php
$valores = new ValoresData(
    // ...
    tributacao: new TributacaoData(
        tributacaoIssqn: 1,
        tipoRetencaoIssqn: 3, // 3 - Retido pelo Intermediário
        // ...
    ),
);
```

---

## Exportação de Serviços

Para exportação, além de identificar o tomador como estrangeiro (item 3), deve-se configurar a tributação e o grupo de comércio exterior.

```php
use Nfse\Dto\ComercioExteriorData;

// 1. Configurar Tributação
$tributacao = new TributacaoData(
    tributacaoIssqn: 3, // 3 - Exportação de Serviço
    tipoRetencaoIssqn: 1, // Não retido (geralmente)
    // ...
);

// 2. Configurar Comércio Exterior no Serviço
$servico = new ServicoData(
    // ...
    comercioExterior: new ComercioExteriorData(
        modoPrestacao: 1, // 1 - Transfronteiriço
        vinculoPrestacao: 1, // 1 - Sem vínculo
        tipoMoeda: 'USD', // Dólar Americano
        valorServicoMoeda: 200.00,
        mecanismoApoioComexPrestador: 'Nenhum',
        mecanismoApoioComexTomador: 'Nenhum',
        movimentacaoTemporariaBens: 'Não',
        numeroDeclaracaoImportacao: null,
        numeroRegistroExportacao: null,
        mdic: 'Não'
    ),
    localPrestacao: new LocalPrestacaoData(
        codigoLocalPrestacao: null,
        codigoPaisPrestacao: 'US' // País onde o serviço é consumido
    )
);
```
