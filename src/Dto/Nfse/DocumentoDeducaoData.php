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
class DocumentoDeducaoData extends Data
{
    public function __construct(
        /**
         * Chave de NFS-e.
         */
        #[MapInputName('chNFSe')]
        public ?string $chaveNfse,

        /**
         * Chave de NF-e.
         */
        #[MapInputName('chNFe')]
        public ?string $chaveNfe,

        /**
         * Tipo de dedução/redução.
         */
        #[MapInputName('tpDedRed')]
        public ?int $tipoDeducaoReducao,

        /**
         * Descrição de outras deduções.
         */
        #[MapInputName('xDescOutDed')]
        public ?string $descricaoOutrasDeducoes,

        /**
         * Data de emissão do documento.
         */
        #[MapInputName('dEmiDoc')]
        public ?string $dataEmissaoDocumento,

        /**
         * Valor dedutível/redutível.
         */
        #[MapInputName('vDedutivelRedutivel')]
        public ?float $valorDedutivelRedutivel,

        /**
         * Valor de dedução/redução.
         */
        #[MapInputName('vDeducaoReducao')]
        public ?float $valorDeducaoReducao,
    ) {}
}
