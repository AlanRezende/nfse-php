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
class DescontoData extends Data
{
    public function __construct(
        /**
         * Valor do desconto incondicionado.
         */
        #[MapInputName('vDescIncond')]
        public ?float $valorDescontoIncondicionado,

        /**
         * Valor do desconto condicionado.
         */
        #[MapInputName('vDescCond')]
        public ?float $valorDescontoCondicionado,
    ) {}
}
