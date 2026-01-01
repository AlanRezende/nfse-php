---
title: Eventos (Cancelamento)
sidebar_position: 3
---

Exemplo de criação e envio de evento (cancelamento).

```php
use Nfse\Dto\EventoData;

$evento = new EventoData(
    chaveAcesso: '12345678901234567890123456789012345678901234567890',
    tipoEvento: 'CANCELAMENTO',
    motivo: 'Erro na emissão dos valores',
    codigoCancelamento: '1'
);

$resultado = $service->registrarEvento($evento);
if ($resultado->sucesso) {
    echo "Evento registrado com sucesso!";
}
```
