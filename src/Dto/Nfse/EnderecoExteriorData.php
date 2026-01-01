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
class EnderecoExteriorData extends Data
{
    public function __construct(
        /**
         * Código do país (ISO2).
         */
        #[MapInputName('cPais')]
        public ?string $codigoPais,

        /**
         * Código de endereçamento postal.
         */
        #[MapInputName('cEndPost')]
        public ?string $codigoEnderecamentoPostal,

        /**
         * Nome da cidade.
         */
        #[MapInputName('xCidade')]
        public ?string $cidade,

        /**
         * Estado, província ou região.
         */
        #[MapInputName('xEstProvReg')]
        public ?string $estadoProvinciaRegiao,
    ) {}
}
