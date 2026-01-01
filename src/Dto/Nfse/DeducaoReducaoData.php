<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
/**
 * @typescript
 */
class DeducaoReducaoData extends Data
{
    public function __construct(
        /**
         * Percentual de dedução/redução da base de cálculo.
         */
        #[MapInputName('pDR')]
        public ?float $percentualDeducaoReducao,

        /**
         * Valor monetário de dedução/redução da base de cálculo.
         */
        #[MapInputName('vDR')]
        public ?float $valorDeducaoReducao,

        /**
         * Documentos comprobatórios da dedução/redução.
         * @var DocumentoDeducaoData[]|null
         */
        #[MapInputName('documentos'), DataCollectionOf(DocumentoDeducaoData::class)]
        public ?array $documentos = null,
    ) {}
}
