# Deduções e Descontos

Estes DTOs gerenciam as reduções de base de cálculo e descontos aplicados ao valor do serviço.

## DeducaoReducaoData

Gerencia as deduções e reduções da base de cálculo do ISSQN.

### Propriedades

| Propriedade                | Tipo    | Mapeamento XML | Descrição                          |
| :------------------------- | :------ | :------------- | :--------------------------------- |
| `percentualDeducaoReducao` | `float` | `pDR`          | Percentual de redução.             |
| `valorDeducaoReducao`      | `float` | `vDR`          | Valor monetário da redução.        |
| `documentos`               | `array` | `documentos`   | Coleção de `DocumentoDeducaoData`. |

---

## DocumentoDeducaoData

Identifica o documento que comprova a dedução ou redução.

### Propriedades

| Propriedade               | Tipo     | Mapeamento XML        | Descrição                                |
| :------------------------ | :------- | :-------------------- | :--------------------------------------- |
| `chaveNfse`               | `string` | `chNFSe`              | Chave de uma NFS-e.                      |
| `chaveNfe`                | `string` | `chNFe`               | Chave de uma NF-e.                       |
| `tipoDeducaoReducao`      | `int`    | `tpDedRed`            | Tipo da dedução conforme tabela oficial. |
| `descricaoOutrasDeducoes` | `string` | `xDescOutDed`         | Descrição de outras deduções.            |
| `dataEmissaoDocumento`    | `string` | `dEmiDoc`             | Data de emissão do documento.            |
| `valorDedutivelRedutivel` | `float`  | `vDedutivelRedutivel` | Valor dedutível/redutível.               |
| `valorDeducaoReducao`     | `float`  | `vDeducaoReducao`     | Valor da dedução comprovada.             |
| `fornecedor`              | `object` | `fornec`              | Informações do fornecedor do documento.  |

---

## DescontoData

Gerencia os descontos concedidos no serviço.

### Propriedades

| Propriedade                   | Tipo    | Mapeamento XML | Descrição                              |
| :---------------------------- | :------ | :------------- | :------------------------------------- |
| `valorDescontoIncondicionado` | `float` | `vDescIncond`  | Desconto que não depende de condição.  |
| `valorDescontoCondicionado`   | `float` | `vDescCond`    | Desconto que depende de evento futuro. |
