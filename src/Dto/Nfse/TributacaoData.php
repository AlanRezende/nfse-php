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
class TributacaoData extends Data
{
    public function __construct(
        /**
         * Tributação do ISSQN.
         * 1 - Operação tributável
         * 2 - Imunidade
         * 3 - Exportação de serviço
         * 4 - Não Incidência
         */
        #[MapInputName('tribMun.tribISSQN')]
        public ?int $tributacaoIssqn,

        /**
         * Tipo de imunidade.
         * Obrigatório se tribISSQN = 2.
         * 0 - Imunidade (tipo não informado na nota de origem)
         * 1 - Patrimônio, renda ou serviços, uns dos outros (CF88, Art 150, VI, a)
         * 2 - Templos de qualquer culto (CF88, Art 150, VI, b)
         * 3 - Patrimônio, renda ou serviços dos partidos políticos, inclusive suas fundações, das entidades sindicais dos trabalhadores, das instituições de educação e de assistência social, sem fins lucrativos, atendidos os requisitos da lei (CF88, Art 150, VI, c)
         * 4 - Livros, jornais, periódicos e o papel destinado a sua impressão (CF88, Art 150, VI, d)
         */
        #[MapInputName('tribMun.tpImunidade')]
        public ?int $tipoImunidade,

        /**
         * Tipo de retencao do ISSQN.
         * 1 - Não Retido
         * 2 - Retido pelo Tomador
         * 3 - Retido pelo Intermediario
         */
        #[MapInputName('tribMun.tpRetISSQN')]
        public ?int $tipoRetencaoIssqn,

        /**
         * Suspensão da exigibilidade do ISSQN.
         * 1 - Suspenso por decisão judicial
         * 2 - Suspenso por decisão administrativa
         */
        #[MapInputName('tribMun.exigSusp.tpSusp')]
        public ?int $tipoSuspensao,

        /**
         * Número do processo judicial ou administrativo de suspensão da exigibilidade.
         */
        #[MapInputName('tribMun.exigSusp.nProcesso')]
        public ?string $numeroProcessoSuspensao,

        /**
         * Benefício Municipal.
         */
        #[MapInputName('tribMun.BM')]
        public ?BeneficioMunicipalData $beneficioMunicipal,

        /**
         * Código da Situação Tributária do PIS/COFINS.
         */
        #[MapInputName('tribFed.piscofins.CST')]
        public ?string $cstPisCofins,

        /**
         * Base de cálculo PIS/COFINS.
         */
        #[MapInputName('tribFed.piscofins.vBCPisCofins')]
        public ?float $baseCalculoPisCofins = null,

        /**
         * Alíquota PIS.
         */
        #[MapInputName('tribFed.piscofins.pAliqPis')]
        public ?float $aliquotaPis = null,

        /**
         * Alíquota COFINS.
         */
        #[MapInputName('tribFed.piscofins.pAliqCofins')]
        public ?float $aliquotaCofins = null,

        /**
         * Valor PIS.
         */
        #[MapInputName('tribFed.piscofins.vPis')]
        public ?float $valorPis = null,

        /**
         * Valor COFINS.
         */
        #[MapInputName('tribFed.piscofins.vCofins')]
        public ?float $valorCofins = null,

        /**
         * Tipo de Retenção PIS/COFINS.
         * 1 - Não Retido
         * 2 - Retido
         */
        #[MapInputName('tribFed.piscofins.tpRetPisCofins')]
        public ?int $tipoRetencaoPisCofins = null,

        /**
         * Valor retido de IRRF.
         */
        #[MapInputName('tribFed.vRetIRRF')]
        public ?float $valorRetidoIrrf = null,

        /**
         * Valor retido de CSLL.
         */
        #[MapInputName('tribFed.vRetCSLL')]
        public ?float $valorRetidoCsll = null,

        /**
         * Valor total dos tributos federais.
         */
        #[MapInputName('totTrib.vTotTrib.vTotTribFed')]
        public ?float $valorTotalTributosFederais = null,

        /**
         * Valor total dos tributos estaduais.
         */
        #[MapInputName('totTrib.vTotTrib.vTotTribEst')]
        public ?float $valorTotalTributosEstaduais = null,

        /**
         * Valor total dos tributos municipais.
         */
        #[MapInputName('totTrib.vTotTrib.vTotTribMun')]
        public ?float $valorTotalTributosMunicipais = null,

        /**
         * Valor percentual total aproximado dos tributos federais, estaduais e municipais.
         */
        #[MapInputName('totTrib.pTotTribSN')]
        public ?float $percentualTotalTributosSN = null,

        /**
         * Indicador de informação de valor total de tributos.
         * 0 - Nenhum
         */
        #[MapInputName('totTrib.indTotTrib')]
        public ?int $indicadorTotalTributos = null,
    ) {}
}
