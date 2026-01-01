<?php

namespace Nfse\Dto\Http;

use Spatie\LaravelData\Data;

class DistribuicaoNsuDto extends Data
{
    public function __construct(
        public ?int $nsu = null,
        public ?string $chaveAcesso = null,
        public ?string $dfeXmlGZipB64 = null,
    ) {}
}
