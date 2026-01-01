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
class ObraData extends Data
{
    public function __construct(
        /**
         * Inscrição imobiliária fiscal da obra.
         */
        #[MapInputName('inscImobFisc')]
        public ?string $inscricaoImobiliariaFiscal,

        /**
         * Código da obra.
         */
        #[MapInputName('cObra')]
        public ?string $codigoObra,

        /**
         * Endereço da obra.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco,
    ) {}
}
