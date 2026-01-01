<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class DpsData extends Data
{

    public function __construct(
        #[MapInputName('@versao')]
        public ?string $versao,

        #[MapInputName('infDPS')]
        public ?InfDpsData $infDps,
    ) {}
}
