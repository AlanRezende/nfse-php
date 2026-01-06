# Data Transfer Objects (DTOs)

A biblioteca `nfse-php` utiliza DTOs (Data Transfer Objects) para representar a estrutura complexa da NFS-e Nacional. Esses objetos facilitam a manipulação de dados, garantem a integridade através de validações e permitem a geração automática de tipos para o frontend.

## 🎯 Duas Maneiras de Construir DTOs

O pacote oferece **duas formas** de construir seus dados:

1. **Array (Padrão Nacional)** - Usando os nomes exatos das tags XML (recomendado)
2. **Objeto (Explícito)** - Usando classes e argumentos nomeados (PHP 8+)

:::danger IMPORTANTE
Você **DEVE** usar os nomes das tags XML exatamente como aparecem no schema (`infDPS`, `tpAmb`, `prest`, etc.).
Propriedades semânticas (`infDps`, `tipoAmbiente`, `prestador`) **NÃO funcionarão**.
:::

---

## 1️⃣ Array (Padrão Nacional)

Use esta abordagem quando você já tem os dados no formato do padrão nacional ou quando está migrando de outra biblioteca.

### Características

-   ✅ Usa os **nomes exatos** das tags XML (`tpAmb`, `dhEmi`, `nDPS`, etc.)
-   ✅ **Compatível** com XMLs existentes
-   ✅ Ideal para **migração** de sistemas legados
-   ✅ Menos verboso para quem já conhece o padrão

### Exemplo Completo

```php
use Nfse\Dto\Nfse\DpsData;
use Nfse\Xml\DpsXmlBuilder;

// Dados vindos da sua aplicação (ex: $request->all())
$dadosDoFormulario = [
    '@attributes' => ['versao' => '1.00'],
    'infDPS' => [
        '@attributes' => ['Id' => 'DPS330455721190597100010500333000000000000006'],
        'tpAmb' => \Nfse\Enums\TipoAmbiente::Homologacao,
        'dhEmi' => '2023-10-27T10:00:00-03:00',
        'verAplic' => '1.0.0',
        'serie' => '00001',
        'nDPS' => '000000000000006',
        'dCompet' => '2023-10-27',
        'tpEmit' => \Nfse\Enums\EmitenteDPS::Prestador,
        'cLocEmi' => '3304557', // Código IBGE do município

        // Prestador
        'prest' => [
            'CNPJ' => '21190597000105',
            'IM' => '00333',
            'xNome' => 'EMPRESA EXEMPLO LTDA',
            'xFant' => 'Empresa Exemplo',
            'enderNac' => [
                'end' => 'RUA EXEMPLO',
                'nro' => '123',
                'xCpl' => 'SALA 456',
                'xBairro' => 'CENTRO',
                'cMun' => '3304557',
                'UF' => 'RJ',
                'CEP' => '20000000',
            ],
            'fone' => '2112345678',
            'email' => 'contato@exemplo.com.br',
        ],

        // Tomador
        'toma' => [
            'CPF' => '12345678901',
            'xNome' => 'CLIENTE EXEMPLO',
            'enderNac' => [
                'end' => 'AVENIDA CLIENTE',
                'nro' => '456',
                'xBairro' => 'BAIRRO CLIENTE',
                'cMun' => '3304557',
                'UF' => 'RJ',
                'CEP' => '21000000',
            ],
            'fone' => '2198765432',
            'email' => 'cliente@exemplo.com',
        ],

        // Serviço
        'serv' => [
            'cServ' => [
                'cTribNac' => '01.07', // Código de tributação nacional
                'xDescServ' => 'Desenvolvimento de software sob encomenda',
            ],
        ],

        // Valores
        'valores' => [
            'vServPrest' => [
                'vServ' => 5000.00,
                'vDescIncond' => 0.00,
                'vDescCond' => 0.00,
            ],
            'trib' => [
                'tribMun' => [
                    'tribISSQN' => \Nfse\Enums\TributacaoIssqn::OperacaoTributavel,
                    'tpRetISSQN' => \Nfse\Enums\TipoRetencaoIssqn::NaoRetido,
                    'exigSusp' => null,
                ],
            ],
        ],
    ],
];

try {
    // Criar o DTO
    $dps = new DpsData($dadosDoFormulario);

    // Validar
    $validator = new \Nfse\Validator\DpsValidator();
    $result = $validator->validate($dps);

    if ($result->fails()) {
        foreach ($result->getErrors() as $message) {
            echo "Erro: $message\n";
        }
        exit;
    }

    // Gerar o XML
    $builder = new DpsXmlBuilder();
    $xml = $builder->build($dps);

    // Usar o XML
    echo $xml;

} catch (\Exception $e) {
    echo "Erro inesperado: " . $e->getMessage();
}
```

---

## 2️⃣ Objeto (Explícito)

Use esta abordagem para **máxima type safety** e **autocomplete** da IDE.

### Características

-   ✅ Usa **classes tipadas** com argumentos nomeados (PHP 8+)
-   ✅ **Autocomplete completo** na IDE
-   ✅ **Type hints** garantem tipos corretos
-   ✅ **Mais seguro** em tempo de desenvolvimento
-   ✅ **Refatoração facilitada**
-   ✅ Ideal para **projetos grandes** e **equipes**

### Exemplo Completo

```php
use Nfse\Dto\Nfse\DpsData;
use Nfse\Dto\Nfse\InfDpsData;
use Nfse\Dto\Nfse\PrestadorData;
use Nfse\Dto\Nfse\TomadorData;
use Nfse\Dto\Nfse\EnderecoData;
use Nfse\Dto\Nfse\ServicoData;
use Nfse\Dto\Nfse\CodigoServicoData;
use Nfse\Dto\Nfse\ValoresData;
use Nfse\Dto\Nfse\ValorServicoPrestadoData;
use Nfse\Dto\Nfse\TributacaoData;
use Nfse\Xml\DpsXmlBuilder;

// Construção Semântica com Argumentos Nomeados (PHP 8+)
// Você sabe exatamente o que cada campo significa
// A IDE oferece autocomplete e validação de tipos
$dps = new DpsData(
    versao: '1.00',
    infDps: new InfDpsData(
        id: 'DPS330455721190597100010500333000000000000006',
        tipoAmbiente: \Nfse\Enums\TipoAmbiente::Homologacao,
        dataEmissao: '2023-10-27T10:00:00-03:00',
        versaoAplicativo: '1.0.0',
        serie: '00001',
        numeroDps: '000000000000006',
        dataCompetencia: '2023-10-27',
        tipoEmitente: \Nfse\Enums\EmitenteDPS::Prestador,
        codigoLocalEmissao: '3304557',

        // Prestador - Objeto tipado
        prestador: new PrestadorData(
            cnpj: '21190597000105',
            inscricaoMunicipal: '00333',
            nome: 'EMPRESA EXEMPLO LTDA',
            nome: 'Empresa Exemplo',
            endereco: new EnderecoData(
                logradouro: 'RUA EXEMPLO',
                numero: '123',
                complemento: 'SALA 456',
                bairro: 'CENTRO',
                codigoMunicipio: '3304557',
                cep: '20000000',
            ),
            telefone: '2112345678',
            email: 'contato@exemplo.com.br',
        ),

        // Tomador - Objeto tipado
        tomador: new TomadorData(
            cpf: '12345678901',
            nome: 'CLIENTE EXEMPLO',
            endereco: new EnderecoData(
                logradouro: 'AVENIDA CLIENTE',
                numero: '456',
                bairro: 'BAIRRO CLIENTE',
                codigoMunicipio: '3304557',
                cep: '21000000',
            ),
            telefone: '2198765432',
            email: 'cliente@exemplo.com',
        ),

        // Serviço - Objeto tipado
        servico: new ServicoData(
            codigoServico: new CodigoServicoData(
                codigoTributacaoNacional: '01.07',
                descricaoServico: 'Desenvolvimento de software sob encomenda',
            ),
        ),

        // Valores - Objeto tipado
        valores: new ValoresData(
            valorServicoPrestado: new ValorServicoPrestadoData(
                valorServico: 5000.00,
            ),
            tributacao: new TributacaoData(
                tributacaoIssqn: \Nfse\Enums\TributacaoIssqn::OperacaoTributavel,
                tipoRetencaoIssqn: \Nfse\Enums\TipoRetencaoIssqn::NaoRetido,
            ),
        ),

        // Campos opcionais podem ser omitidos ou passados como null
        motivoEmissaoTomadorIntermediario: null,
        chaveNfseRejeitada: null,
        substituicao: null,
        intermediario: null,
    )
);

// Gerar o XML
$builder = new DpsXmlBuilder();
$xml = $builder->build($dps);

echo $xml;
```

---

## 📊 Comparação das Abordagens

| Característica           | Array (Padrão Nacional) | Objeto (Explícito)    |
| ------------------------ | ----------------------- | --------------------- |
| **Legibilidade**         | ⭐⭐⭐                  | ⭐⭐⭐⭐⭐            |
| **Type Safety**          | ❌                      | ✅                    |
| **Autocomplete**         | ⚠️ Limitado             | ✅ Completo           |
| **Migração**             | ✅ Fácil                | ⚠️ Requer refatoração |
| **Manutenção**           | ⭐⭐⭐                  | ⭐⭐⭐⭐⭐            |
| **Curva de Aprendizado** | ⭐⭐⭐                  | ⭐⭐                  |
| **Ideal Para**           | Migração/XML direto     | Projetos novos        |

---

## 🎯 Qual Abordagem Usar?

### Use **Array (Padrão Nacional)** quando:

-   ✅ Está migrando de outra biblioteca
-   ✅ Já tem XMLs ou dados no formato nacional
-   ✅ A equipe já conhece bem o padrão NFSe
-   ✅ Quer compatibilidade direta com o XML

### Use **Objeto (Explícito)** quando:

-   ✅ Quer máxima segurança de tipos
-   ✅ Trabalha em equipe
-   ✅ Projeto de médio/grande porte
-   ✅ Usa IDE moderna (PHPStorm, VS Code)
-   ✅ Quer refatoração facilitada

---

## 💡 Dicas Importantes

### Validação

Para validar os dados de uma DPS, utilize a classe `DpsValidator`:

```php
use Nfse\Validator\DpsValidator;

$validator = new DpsValidator();
$result = $validator->validate($dps);

if ($result->fails()) {
    print_r($result->getErrors());
}
```

### Mapeamento Automático

O pacote mapeia automaticamente entre os formatos:

```php
// Estes são equivalentes:
['tpAmb' => 2]
['tipoAmbiente' => 2]

// Estes também:
['dhEmi' => '2023-10-27T10:00:00']
['dataEmissao' => '2023-10-27T10:00:00']
```

### Campos Opcionais

Campos opcionais podem ser omitidos:

```php
// Objeto
new TomadorData(
    cpf: '12345678901',
    nome: 'Cliente',
    // endereco: null, // Opcional, pode omitir
);

// Array
[
    'cpf' => '12345678901',
    'nome' => 'Cliente',
    // 'endereco' não precisa estar presente
]
```

---

## 📚 Próximos Passos

-   **[Validações](./validations)** - Entenda as regras de validação
-   **[Serialização XML](./xml-serialization)** - Como gerar XMLs
-   **[Assinatura Digital](./digital-signature)** - Como assinar os XMLs
-   **[Utilitários](./utilities/id-generator)** - Helpers úteis

---

## 🔗 Referências

-   [Spatie Data Transfer Object](https://github.com/spatie/data-transfer-object) - Biblioteca base dos DTOs
-   [Manual NFSe Nacional](https://www.gov.br/nfse/) - Documentação oficial
-   [Schemas XSD](https://github.com/nfse-nacional/nfse-php/tree/main/references/schemas) - Schemas oficiais
