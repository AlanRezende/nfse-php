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
class EmitenteData extends Data
{
    public function __construct(
        /**
         * CNPJ do emitente.
         */
        #[MapInputName('CNPJ')]
        public ?string $cnpj = null,

        /**
         * CPF do emitente.
         */
        #[MapInputName('CPF')]
        public ?string $cpf = null,

        /**
         * Inscrição Municipal do emitente.
         */
        #[MapInputName('IM')]
        public ?string $inscricaoMunicipal = null,

        /**
         * Razão Social ou Nome do emitente.
         */
        #[MapInputName('xNome')]
        public ?string $nome = null,

        /**
         * Nome Fantasia do emitente.
         */
        #[MapInputName('xFant')]
        public ?string $nomeFantasia = null,

        /**
         * Endereço do emitente.
         */
        #[MapInputName('enderNac')]
        public ?EnderecoEmitenteData $endereco = null,

        /**
         * Telefone do emitente.
         */
        #[MapInputName('fone')]
        public ?string $telefone = null,

        /**
         * Email do emitente.
         */
        #[MapInputName('email')]
        public ?string $email = null,
    ) {}
}
