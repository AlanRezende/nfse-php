# Valores e Tributação

Estes DTOs gerenciam os aspectos financeiros da prestação, incluindo valores brutos, retenções e regimes especiais.

## ValoresData

Consolida todos os valores financeiros da operação (usado na DPS).

### Propriedades

| Propriedade            | Tipo                       | Mapeamento XML    | Descrição                                    |
| :--------------------- | :------------------------- | :---------------- | :------------------------------------------- |
| `valorServicoPrestado` | `ValorServicoPrestadoData` | `vServPrest`      | Valor bruto do serviço.                      |
| `desconto`             | `DescontoData`             | `vDescCondIncond` | Descontos aplicados.                         |
| `deducaoReducao`       | `DeducaoReducaoData`       | `vDedRed`         | Deduções da base de cálculo.                 |
| `tributacao`           | `TributacaoData`           | `trib`            | Detalhes da tributação (ISSQN, PIS, COFINS). |

---

## ValoresNfseData

Consolida os valores financeiros calculados e finais da NFS-e.

### Propriedades

| Propriedade                        | Tipo    | Mapeamento XML | Descrição                               |
| :--------------------------------- | :------ | :------------- | :-------------------------------------- |
| `baseCalculo`                      | `float` | `vBC`          | Valor da Base de Cálculo.               |
| `aliquotaAplicada`                 | `float` | `pAliqAplic`   | Alíquota Aplicada.                      |
| `valorIssqn`                       | `float` | `vISSQN`       | Valor do ISSQN.                         |
| `valorLiquido`                     | `float` | `vLiq`         | Valor Líquido da NFS-e.                 |
| `valorCalculadoDeducaoReducao`     | `float` | `vCalcDR`      | Valor calculado de Dedução/Redução.     |
| `tipoBeneficioMunicipal`           | `int`   | `tpBM`         | Tipo de Benefício Municipal.            |
| `valorCalculadoBeneficioMunicipal` | `float` | `vCalcBM`      | Valor calculado de Benefício Municipal. |
| `valorTotalRetido`                 | `float` | `vTotalRet`    | Valor Total Retido.                     |

---

## TributacaoData

Define como o serviço será tributado.

### Propriedades

| Propriedade                 | Tipo                     | Mapeamento XML               | Descrição                                                  |
| :-------------------------- | :----------------------- | :--------------------------- | :--------------------------------------------------------- |
| `tributacaoIssqn`           | `int`                    | `tribMun.tribISSQN`          | 1-Tributável, 2-Imunidade, 3-Exportação, 4-Não Incidência. |
| `tipoImunidade`             | `int`                    | `tribMun.tpImunidade`        | Tipo de imunidade (se tribISSQN = 2).                      |
| `tipoRetencaoIssqn`         | `int`                    | `tribMun.tpRetISSQN`         | 1-Não Retido, 2-Retido Tomador, 3-Retido Intermediário.    |
| `tipoSuspensao`             | `int`                    | `tribMun.exigSusp.tpSusp`    | 1-Judicial, 2-Administrativa.                              |
| `numeroProcessoSuspensao`   | `string`                 | `tribMun.exigSusp.nProcesso` | Número do processo de suspensão.                           |
| `beneficioMunicipal`        | `BeneficioMunicipalData` | `tribMun.BM`                 | Informações de benefício municipal.                        |
| `cstPisCofins`              | `string`                 | `tribFed.piscofins.CST`      | Código da Situação Tributária do PIS/COFINS.               |
| `percentualTotalTributosSN` | `float`                  | `totTrib.pTotTribSN`         | Percentual total aproximado dos tributos.                  |
| `indicadorTotalTributos`    | `int`                    | `totTrib.indTotTrib`         | Indicador de informação de valor total de tributos.        |

---

## RegimeTributarioData

Identifica o enquadramento fiscal do prestador.

### Propriedades

| Propriedade                  | Tipo  | Mapeamento XML | Descrição                                       |
| :--------------------------- | :---- | :------------- | :---------------------------------------------- |
| `opcaoSimplesNacional`       | `int` | `opSimpNac`    | 1-Não, 2-MEI, 3-ME/EPP.                         |
| `regimeApuracaoTributariaSN` | `int` | `regApTribSN`  | 1-Pelo SN, 2-Pelo Município.                    |
| `regimeEspecialTributacao`   | `int` | `regEspTrib`   | 1-Estimativa, 3-Soc. Profissionais, 5-MEI, etc. |

---

## BeneficioMunicipalData

Detalha benefícios fiscais concedidos pelo município.

### Propriedades

| Propriedade         | Tipo     | Mapeamento XML | Descrição                                 |
| :------------------ | :------- | :------------- | :---------------------------------------- |
| `tipoBeneficio`     | `int`    | `tpBM`         | Tipo do benefício.                        |
| `numeroProcesso`    | `string` | `nProcesso`    | Número do processo.                       |
| `valorReducao`      | `float`  | `vRedBCBM`     | Valor da redução da base de cálculo.      |
| `percentualReducao` | `float`  | `pRedBCBM`     | Percentual de redução da base de cálculo. |

---

## ValorServicoPrestadoData

Detalha o valor bruto recebido.

### Propriedades

| Propriedade     | Tipo    | Mapeamento XML | Descrição                                        |
| :-------------- | :------ | :------------- | :----------------------------------------------- |
| `valorServico`  | `float` | `vServ`        | Valor total do serviço.                          |
| `valorRecebido` | `float` | `vReceb`       | Valor recebido (obrigatório para intermediário). |
