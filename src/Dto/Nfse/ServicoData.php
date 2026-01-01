<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
/**
 * @typescript
 */
class ServicoData extends Data
{
    public function __construct(
        /**
         * Local da prestação do serviço.
         */
        #[MapInputName('locPrest')]
        public ?LocalPrestacaoData $localPrestacao = null,

        /**
         * Código do serviço prestado.
         */
        #[MapInputName('cServ')]
        public ?CodigoServicoData $codigoServico = null,

        /**
         * Informações de comércio exterior.
         */
        #[MapInputName('comExt')]
        public ?ComercioExteriorData $comercioExterior = null,

        /**
         * Informações da obra.
         */
        #[MapInputName('obra')]
        public ?ObraData $obra = null,

        /**
         * Informações de atividade/evento.
         */
        #[MapInputName('atvEvento')]
        public ?AtividadeEventoData $atividadeEvento = null,

        /**
         * Informações complementares do serviço.
         */
        #[MapInputName('infoComplem')]
        #[Nullable, StringType, Max(2000)]
        public ?string $informacoesComplementares = null,

        /**
         * Identificador do documento técnico.
         */
        #[MapInputName('idDocTec')]
        public ?string $idDocumentoTecnico = null,

        /**
         * Documento de referência.
         * Obrigatório se tpEmit = 2 ou 3.
         */
        #[MapInputName('docRef')]
        public ?string $documentoReferencia = null,

        /**
         * Outras informações complementares.
         */
        #[MapInputName('xInfComp')]
        public ?string $descricaoInformacoesComplementares = null,
    ) {}
}
