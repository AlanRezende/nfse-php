# Atores (Participantes)

Estes DTOs identificam as partes envolvidas na prestação do serviço e na emissão do documento fiscal.

## PrestadorData

Identifica o estabelecimento ou pessoa física que presta o serviço.

### Propriedades

| Propriedade          | Tipo                   | Mapeamento XML | Descrição                                  |
| :------------------- | :--------------------- | :------------- | :----------------------------------------- |
| `cnpj`               | `string`               | `CNPJ`         | CNPJ do prestador (14 dígitos).            |
| `cpf`                | `string`               | `CPF`          | CPF do prestador (11 dígitos).             |
| `nif`                | `string`               | `NIF`          | Número de Identificação Fiscal (Exterior). |
| `codigoNaoNif`       | `string`               | `cNaoNIF`      | Motivo de não informar NIF.                |
| `caepf`              | `string`               | `CAEPF`        | Cadastro de Atividade Econômica (PF).      |
| `inscricaoMunicipal` | `string`               | `IM`           | Inscrição Municipal do prestador.          |
| `nome`               | `string`               | `xNome`        | Razão Social ou Nome do prestador.         |
| `endereco`           | `EnderecoData`         | `end`          | Endereço completo do prestador.            |
| `telefone`           | `string`               | `fone`         | Telefone de contato.                       |
| `email`              | `string`               | `email`        | E-mail de contato.                         |
| `regimeTributario`   | `RegimeTributarioData` | `regTrib`      | Detalhes do regime de tributação.          |

---

## TomadorData

Identifica o contratante do serviço.

### Propriedades

| Propriedade          | Tipo           | Mapeamento XML | Descrição                                   |
| :------------------- | :------------- | :------------- | :------------------------------------------ |
| `cnpj`               | `string`       | `CNPJ`         | CNPJ do tomador.                            |
| `cpf`                | `string`       | `CPF`          | CPF do tomador.                             |
| `nif`                | `string`       | `NIF`          | Número de Identificação Fiscal (Exterior).  |
| `codigoNaoNif`       | `string`       | `cNaoNIF`      | Motivo de não informar NIF.                 |
| `caepf`              | `string`       | `CAEPF`        | Cadastro de Atividade Econômica (PF).       |
| `inscricaoMunicipal` | `string`       | `IM`           | Inscrição Municipal do tomador.             |
| `nome`               | `string`       | `xNome`        | Razão Social ou Nome do tomador.            |
| `endereco`           | `EnderecoData` | `end`          | Endereço do tomador (Nacional ou Exterior). |
| `telefone`           | `string`       | `fone`         | Telefone de contato.                        |
| `email`              | `string`       | `email`        | E-mail de contato.                          |

---

## IntermediarioData

Identifica o intermediário do serviço, se houver.

### Propriedades

| Propriedade          | Tipo           | Mapeamento XML | Descrição                                  |
| :------------------- | :------------- | :------------- | :----------------------------------------- |
| `cnpj`               | `string`       | `CNPJ`         | CNPJ do intermediário.                     |
| `cpf`                | `string`       | `CPF`          | CPF do intermediário.                      |
| `nif`                | `string`       | `NIF`          | Número de Identificação Fiscal (Exterior). |
| `codigoNaoNif`       | `string`       | `cNaoNIF`      | Motivo de não informar NIF.                |
| `caepf`              | `string`       | `CAEPF`        | Cadastro de Atividade Econômica (PF).      |
| `inscricaoMunicipal` | `string`       | `IM`           | Inscrição Municipal do intermediário.      |
| `nome`               | `string`       | `xNome`        | Nome do intermediário.                     |
| `endereco`           | `EnderecoData` | `end`          | Endereço do intermediário.                 |
| `telefone`           | `string`       | `fone`         | Telefone de contato.                       |
| `email`              | `string`       | `email`        | E-mail de contato.                         |

---

## EmitenteData

Utilizado na NFS-e para identificar a entidade que emitiu o documento (geralmente o município ou o sistema nacional).

### Propriedades

| Propriedade          | Tipo                   | Mapeamento XML | Descrição                      |
| :------------------- | :--------------------- | :------------- | :----------------------------- |
| `cnpj`               | `string`               | `CNPJ`         | CNPJ da entidade emissora.     |
| `cpf`                | `string`               | `CPF`          | CPF da entidade emissora.      |
| `inscricaoMunicipal` | `string`               | `IM`           | Inscrição Municipal.           |
| `nome`               | `string`               | `xNome`        | Nome da entidade emissora.     |
| `nomeFantasia`       | `string`               | `xFant`        | Nome fantasia da entidade.     |
| `endereco`           | `EnderecoEmitenteData` | `enderNac`     | Endereço nacional da entidade. |
| `telefone`           | `string`               | `fone`         | Telefone de contato.           |
| `email`              | `string`               | `email`        | E-mail de contato.             |

---

## EnderecoEmitenteData

Estrutura simplificada de endereço para o emitente.

### Propriedades

| Propriedade       | Tipo     | Mapeamento XML | Descrição                 |
| :---------------- | :------- | :------------- | :------------------------ |
| `logradouro`      | `string` | `xLgr`         | Logradouro.               |
| `numero`          | `string` | `nro`          | Número.                   |
| `complemento`     | `string` | `xCpl`         | Complemento.              |
| `bairro`          | `string` | `xBairro`      | Bairro.                   |
| `codigoMunicipio` | `string` | `cMun`         | Código IBGE do município. |
| `uf`              | `string` | `UF`           | Sigla da UF.              |
| `cep`             | `string` | `CEP`          | CEP.                      |

---

## FornecedorData

Identifica o fornecedor de um documento comprobatório de dedução ou redução.

### Propriedades

| Propriedade          | Tipo           | Mapeamento XML | Descrição                                  |
| :------------------- | :------------- | :------------- | :----------------------------------------- |
| `cnpj`               | `string`       | `CNPJ`         | CNPJ do fornecedor.                        |
| `cpf`                | `string`       | `CPF`          | CPF do fornecedor.                         |
| `nif`                | `string`       | `NIF`          | Número de Identificação Fiscal (Exterior). |
| `codigoNaoNif`       | `string`       | `cNaoNIF`      | Motivo de não informar NIF.                |
| `caepf`              | `string`       | `CAEPF`        | Cadastro de Atividade Econômica (PF).      |
| `inscricaoMunicipal` | `string`       | `IM`           | Inscrição Municipal do fornecedor.         |
| `nome`               | `string`       | `xNome`        | Nome do fornecedor.                        |
| `endereco`           | `EnderecoData` | `endFornec`    | Endereço do fornecedor.                    |
| `telefone`           | `string`       | `fone`         | Telefone de contato.                       |
| `email`              | `string`       | `email`        | E-mail de contato.                         |
