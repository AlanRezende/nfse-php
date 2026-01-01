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
class BeneficioMunicipalData extends Data
{
    public function __construct(
        /**
         * Percentual de redução da base de cálculo referente ao benefício municipal.
         */
        #[MapInputName('pRedBCBM')]
        public ?float $percentualReducaoBcBm,

        /**
         * Valor monetário de redução da base de cálculo referente ao benefício municipal.
         */
        #[MapInputName('vRedBCBM')]
        public ?float $valorReducaoBcBm,
    ) {}
}
