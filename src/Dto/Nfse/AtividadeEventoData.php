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
class AtividadeEventoData extends Data
{
    public function __construct(
        /**
         * Nome do evento ou atividade.
         */
        #[MapInputName('xNome')]
        public ?string $nome,

        /**
         * Data de início do evento.
         * Formato: AAAA-MM-DD
         */
        #[MapInputName('dtIni')]
        public ?string $dataInicio,

        /**
         * Data de fim do evento.
         * Formato: AAAA-MM-DD
         */
        #[MapInputName('dtFim')]
        public ?string $dataFim,

        /**
         * Identificador da atividade ou evento.
         */
        #[MapInputName('idAtvEvt')]
        public ?string $idAtividadeEvento,

        /**
         * Endereço do evento.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco,
    ) {}
}
