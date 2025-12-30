# Informações do Documento

Estes DTOs contêm o corpo principal e os metadados dos documentos fiscais.

## InfDpsData

Contém os dados detalhados da Declaração de Prestação de Serviço.

### Propriedades Principais

| Propriedade                         | Tipo               | Mapeamento XML  | Descrição                                      |
| :---------------------------------- | :----------------- | :-------------- | :--------------------------------------------- |
| `id`                                | `string`           | `@Id`           | Identificador único da DPS.                    |
| `tipoAmbiente`                      | `int`              | `tpAmb`         | 1 - Produção, 2 - Homologação.                 |
| `dataEmissao`                       | `string`           | `dhEmi`         | Data e hora de emissão.                        |
| `versaoAplicativo`                  | `string`           | `verAplic`      | Versão do aplicativo emissor.                  |
| `serie`                             | `string`           | `serie`         | Série da DPS.                                  |
| `numeroDps`                         | `string`           | `nDPS`          | Número da DPS.                                 |
| `dataCompetencia`                   | `string`           | `dCompet`       | Data de competência do serviço.                |
| `tipoEmitente`                      | `int`              | `tpEmit`        | 1 - Prestador, 2 - Tomador, 3 - Intermediário. |
| `codigoLocalEmissao`                | `string`           | `cLocEmi`       | Código IBGE do município emissor.              |
| `motivoEmissaoTomadorIntermediario` | `string`           | `cMotivoEmisTI` | Motivo da emissão (se Tomador/Intermediário).  |
| `chaveNfseRejeitada`                | `string`           | `chNFSeRej`     | Chave da NFS-e rejeitada (se aplicável).       |
| `substituicao`                      | `SubstituicaoData` | `subst`         | Dados de substituição (se aplicável).          |

### Relacionamentos

-   `prestador`: Dados do prestador (`PrestadorData`).
-   `tomador`: Dados do tomador (`TomadorData`).
-   `intermediario`: Dados do intermediário (`IntermediarioData`).
-   `servico`: Detalhes do serviço (`ServicoData`).
-   `valores`: Valores e impostos (`ValoresData`).

---

## InfNfseData

Contém os dados detalhados da Nota Fiscal de Serviço Eletrônica gerada.

### Propriedades Principais

| Propriedade                    | Tipo     | Mapeamento XML  | Descrição                                    |
| :----------------------------- | :------- | :-------------- | :------------------------------------------- |
| `id`                           | `string` | `id`            | Identificador único da NFS-e.                |
| `numeroNfse`                   | `string` | `nNFSe`         | Número sequencial da NFS-e.                  |
| `numeroDfse`                   | `string` | `nDFe`          | Número do DFe nacional.                      |
| `codigoVerificacao`            | `string` | `cVerif`        | Código para verificação de autenticidade.    |
| `dataProcessamento`            | `string` | `dhProc`        | Data e hora de geração da nota.              |
| `ambienteGerador`              | `int`    | `ambGer`        | Ambiente que gerou a nota.                   |
| `versaoAplicativo`             | `string` | `verAplic`      | Versão do aplicativo gerador.                |
| `processoEmissao`              | `int`    | `procEmi`       | Processo de emissão.                         |
| `localEmissao`                 | `string` | `xLocEmi`       | Nome do local de emissão.                    |
| `localPrestacao`               | `string` | `xLocPrestacao` | Nome do local de prestação.                  |
| `codigoLocalIncidencia`        | `string` | `cLocIncid`     | Código do local de incidência.               |
| `nomeLocalIncidencia`          | `string` | `xLocIncid`     | Nome do local de incidência.                 |
| `descricaoTributacaoNacional`  | `string` | `xTribNac`      | Descrição da tributação nacional.            |
| `descricaoTributacaoMunicipal` | `string` | `xTribMun`      | Descrição da tributação municipal.           |
| `descricaoNbs`                 | `string` | `xNBS`          | Descrição da NBS.                            |
| `tipoEmissao`                  | `int`    | `tpEmis`        | Tipo de Emissão.                             |
| `codigoStatus`                 | `int`    | `cStat`         | Status atual da nota (ex: 100 - Autorizado). |
| `outrasInformacoes`            | `string` | `xOutInf`       | Outras Informações.                          |

### Relacionamentos

-   `dps`: Cópia da DPS que originou a nota (`DpsData`).
-   `emitente`: Dados da entidade emissora (`EmitenteData`).
-   `valores`: Valores consolidados da nota (`ValoresNfseData`).
