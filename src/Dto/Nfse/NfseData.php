<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class NfseData extends Data
{

    public function __construct(
        /**
         * Versão do leiaute.
         */
        #[MapInputName('versao')]
        public ?string $versao,

        /**
         * Informações da NFS-e.
         */
        #[MapInputName('infNFSe')]
        public ?InfNfseData $infNfse,
    ) {}
}
