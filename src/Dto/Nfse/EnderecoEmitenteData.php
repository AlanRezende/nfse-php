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
class EnderecoEmitenteData extends Data
{
    public function __construct(
        /**
         * Logradouro.
         */
        #[MapInputName('xLgr')]
        public ?string $logradouro,

        /**
         * Número.
         */
        #[MapInputName('nro')]
        public ?string $numero,

        /**
         * Complemento.
         */
        #[MapInputName('xCpl')]
        public ?string $complemento,

        /**
         * Bairro.
         */
        #[MapInputName('xBairro')]
        public ?string $bairro,

        /**
         * Código do município (IBGE).
         */
        #[MapInputName('cMun')]
        public ?string $codigoMunicipio,

        /**
         * Sigla da UF.
         */
        #[MapInputName('UF')]
        public ?string $uf,

        /**
         * CEP.
         */
        #[MapInputName('CEP')]
        public ?string $cep,
    ) {}
}
