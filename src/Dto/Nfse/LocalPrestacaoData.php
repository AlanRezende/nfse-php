<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
/**
 * @typescript
 */
class LocalPrestacaoData extends Data
{
    public function __construct(
        /**
         * Código do município onde o serviço foi prestado (IBGE).
         * Utilizar 0000000 para "Águas Marítimas".
         */
        #[MapInputName('cLocPrestacao')]
        public ?string $codigoLocalPrestacao,

        /**
         * Código do país onde o serviço foi prestado (ISO2).
         * Obrigatório se o serviço for prestado no exterior.
         */
        #[MapInputName('cPaisPrestacao')]
        public ?string $codigoPaisPrestacao,
    ) {}
}
