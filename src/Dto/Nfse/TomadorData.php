<?php

namespace Nfse\Dto\Nfse;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Nullable;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Attributes\Validation\Size;
use Spatie\LaravelData\Attributes\Validation\StringType;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
/**
 * @typescript
 */
class TomadorData extends Data
{
    public function __construct(
        /**
         * CPF do tomador.
         * Obrigatório se pessoa física.
         */
        #[MapInputName('CPF')]
        #[Nullable, StringType, Size(11)]
        public ?string $cpf = null,

        /**
         * CNPJ do tomador.
         * Obrigatório se pessoa jurídica.
         */
        #[MapInputName('CNPJ')]
        #[Nullable, StringType, Size(14)]
        public ?string $cnpj = null,

        /**
         * Número de Identificação Fiscal (NIF) do tomador.
         * Não permitido se tpEmit=2.
         */
        #[MapInputName('NIF')]
        #[Nullable, StringType, Max(15)]
        public ?string $nif = null,

        /**
         * Código do motivo de não informar o NIF.
         */
        #[MapInputName('cNaoNIF')]
        public ?string $codigoNaoNif = null,

        /**
         * Cadastro de Atividade Econômica da Pessoa Física.
         */
        #[MapInputName('CAEPF')]
        public ?string $caepf = null,

        /**
         * Inscrição Municipal do tomador.
         */
        #[MapInputName('IM')]
        #[Nullable, StringType, Max(15)]
        public ?string $inscricaoMunicipal = null,

        /**
         * Razão Social ou Nome do tomador.
         */
        #[MapInputName('xNome')]
        #[Nullable, StringType, Max(255)]
        public ?string $nome = null,

        /**
         * Endereço do tomador.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco = null,

        /**
         * Telefone do tomador.
         */
        #[MapInputName('fone')]
        public ?string $telefone = null,

        /**
         * Email do tomador.
         */
        #[MapInputName('email')]
        #[Nullable, Email, Max(80)]
        public ?string $email = null,
    ) {}
}
