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
class RegimeTributarioData extends Data
{
    public function __construct(
        /**
         * Opção pelo Simples Nacional.
         * 1 - Não Optante
         * 2 - Optante - Microempreendedor Individual (MEI)
         * 3 - Optante - Microempresa ou Empresa de Pequeno Porte (ME/EPP)
         */
        #[MapInputName('opSimpNac')]
        public ?int $opcaoSimplesNacional,

        /**
         * Regime de apuração dos tributos (SN).
         * Obrigatório se opSimpNac = 3.
         * 1 - Regime de apuração dos tributos federais e municipal pelo SN
         * 2 - Regime de apuração dos tributos federais pelo SN e municipal pelo regime normal (ISSQN)
         */
        #[MapInputName('regApTribSN')]
        public ?int $regimeApuracaoTributosSn,

        /**
         * Regime Especial de Tributação.
         * 0 - Nenhum
         * 1 - Ato Cooperado (Cooperativa)
         * 2 - Estimativa
         * 3 - Microempresa Municipal
         * 4 - Notário ou Registrador
         * 5 - Profissional Autônomo
         * 6 - Sociedade de Profissionais
         */
        #[MapInputName('regEspTrib')]
        public ?int $regimeEspecialTributacao,
    ) {}
}
