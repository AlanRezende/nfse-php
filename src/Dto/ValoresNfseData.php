<?php

namespace Nfse\Dto;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
/**
 * @typescript
 */
class ValoresNfseData extends Data
{
    public function __construct(
        /**
         * Valor calculado de Dedução/Redução.
         */
        #[MapInputName('vCalcDR')]
        public ?float $valorCalculadoDeducaoReducao,

        /**
         * Tipo de Benefício Municipal.
         */
        #[MapInputName('tpBM')]
        public ?int $tipoBeneficioMunicipal,

        /**
         * Valor calculado de Benefício Municipal.
         */
        #[MapInputName('vCalcBM')]
        public ?float $valorCalculadoBeneficioMunicipal,

        /**
         * Valor da Base de Cálculo.
         */
        #[MapInputName('vBC')]
        public ?float $baseCalculo,

        /**
         * Alíquota Aplicada.
         */
        #[MapInputName('pAliqAplic')]
        public ?float $aliquotaAplicada,

        /**
         * Valor do ISSQN.
         */
        #[MapInputName('vISSQN')]
        public ?float $valorIssqn,

        /**
         * Valor Total Retido.
         */
        #[MapInputName('vTotalRet')]
        public ?float $valorTotalRetido,

        /**
         * Valor Líquido da NFS-e.
         */
        #[MapInputName('vLiq')]
        public ?float $valorLiquido,
    ) {}
}
