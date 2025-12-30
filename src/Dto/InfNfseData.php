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
class InfNfseData extends Data
{
    public function __construct(
        /**
         * Identificador da NFS-e.
         */
        #[MapInputName('id')]
        public ?string $id,

        /**
         * Número da NFS-e.
         */
        #[MapInputName('nNFSe')]
        public ?string $numeroNfse,

        /**
         * Número do DFe.
         */
        #[MapInputName('nDFe')]
        public ?string $numeroDfse,

        /**
         * Código de verificação.
         */
        #[MapInputName('cVerif')]
        public ?string $codigoVerificacao,

        /**
         * Data e hora de processamento.
         */
        #[MapInputName('dhProc')]
        public ?string $dataProcessamento,

        /**
         * Ambiente gerador.
         */
        #[MapInputName('ambGer')]
        public ?int $ambienteGerador,

        /**
         * Versão do aplicativo.
         */
        #[MapInputName('verAplic')]
        public ?string $versaoAplicativo,

        /**
         * Processo de emissão.
         */
        #[MapInputName('procEmi')]
        public ?int $processoEmissao,

        /**
         * Local de emissão (Nome).
         */
        #[MapInputName('xLocEmi')]
        public ?string $localEmissao,

        /**
         * Local de prestação (Nome).
         */
        #[MapInputName('xLocPrestacao')]
        public ?string $localPrestacao,

        /**
         * Código do local de incidência.
         */
        #[MapInputName('cLocIncid')]
        public ?string $codigoLocalIncidencia,

        /**
         * Local de incidência (Nome).
         */
        #[MapInputName('xLocIncid')]
        public ?string $nomeLocalIncidencia,

        /**
         * Descrição da tributação nacional.
         */
        #[MapInputName('xTribNac')]
        public ?string $descricaoTributacaoNacional,

        /**
         * Descrição da tributação municipal.
         */
        #[MapInputName('xTribMun')]
        public ?string $descricaoTributacaoMunicipal,

        /**
         * Descrição da NBS.
         */
        #[MapInputName('xNBS')]
        public ?string $descricaoNbs,

        /**
         * Tipo de Emissão.
         */
        #[MapInputName('tpEmis')]
        public ?int $tipoEmissao,

        /**
         * Código de status.
         */
        #[MapInputName('cStat')]
        public ?int $codigoStatus,

        /**
         * Outras Informações.
         */
        #[MapInputName('xOutInf')]
        public ?string $outrasInformacoes,

        /**
         * Dados da DPS.
         */
        #[MapInputName('DPS')]
        public ?DpsData $dps,

        /**
         * Dados do emitente.
         */
        #[MapInputName('emit')]
        public ?EmitenteData $emitente,

        /**
         * Valores da NFS-e.
         */
        #[MapInputName('valores')]
        public ?ValoresNfseData $valores,
    ) {}
}
