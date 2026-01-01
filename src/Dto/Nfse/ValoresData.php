<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
/**
 * @typescript
 */
class ValoresData extends Data
{
    public function __construct(
        /**
         * Valor do serviço prestado.
         */
        #[MapInputName('vServPrest')]
        #[Required]
        public ?ValorServicoPrestadoData $valorServicoPrestado,

        /**
         * Descontos condicionados e incondicionados.
         */
        #[MapInputName('vDescCondIncond')]
        public ?DescontoData $desconto = null,

        /**
         * Deduções e reduções da base de cálculo.
         */
        #[MapInputName('vDedRed')]
        public ?DeducaoReducaoData $deducaoReducao = null,

        /**
         * Informações sobre a tributação do serviço.
         */
        #[MapInputName('trib')]
        public ?TributacaoData $tributacao = null,
    ) {}
}
