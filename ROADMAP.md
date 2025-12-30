# Roadmap: nfse-php

Este pacote é a fundação do ecossistema. O foco é garantir contratos sólidos e modelos de dados ricos.

## 📅 Fases

### Fase 1: Estrutura de Dados (DTOs)

-   [x] Implementar DTOs usando `spatie/laravel-data`.
-   [x] Mapear campos do Excel (`ANEXO_I...`) usando atributos `#[MapInputName]`.
-   [x] Implementar `Dps`, `Prestador`, `Tomador`, `Servico`, `Valores`.
-   [x] Adicionar validações (Constraints) nos DTOs.
-   [x] Testes unitários de validação.

### Fase 2: Serialização

-   [x] Implementar Serializer para XML (padrão ABRASF/Nacional).
-   [x] Garantir que a serialização respeite os XSDs oficiais.

### Fase 3: Assinatura Digital

-   [x] Criar `SignerInterface`.
-   [x] Implementar adaptador para assinatura XML (DSig).
-   [x] Suporte a certificado A1 (PKCS#12).

### Fase 4: Utilitários

-   [x] Helpers para cálculo de impostos (simples).
-   [x] Formatadores de documentos (CPF/CNPJ).
