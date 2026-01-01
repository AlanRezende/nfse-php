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
class PrestadorData extends Data
{
    public function __construct(
        /**
         * CNPJ do prestador.
         * Obrigatório se não for pessoa física.
         */
        #[MapInputName('CNPJ')]
        #[Nullable, StringType, Size(14)]
        public ?string $cnpj = null,

        /**
         * CPF do prestador.
         * Obrigatório se pessoa física.
         */
        #[MapInputName('CPF')]
        #[Nullable, StringType, Size(11)]
        public ?string $cpf = null,

        /**
         * Número de Identificação Fiscal (NIF) do prestador.
         * Não permitido se tpEmit=1.
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
         * Inscrição Municipal do prestador.
         */
        #[MapInputName('IM')]
        #[Nullable, StringType, Max(15)]
        public ?string $inscricaoMunicipal = null,

        /**
         * Razão Social ou Nome do prestador.
         */
        #[MapInputName('xNome')]
        #[Nullable, StringType, Max(255)]
        public ?string $nome = null,

        /**
         * Endereço do prestador.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco = null,

        /**
         * Telefone do prestador.
         */
        #[MapInputName('fone')]
        public ?string $telefone = null,

        /**
         * Email do prestador.
         */
        #[MapInputName('email')]
        #[Nullable, Email, Max(80)]
        public ?string $email = null,

        /**
         * Regime tributário do prestador.
         */
        #[MapInputName('regTrib')]
        public ?RegimeTributarioData $regimeTributario = null,
    ) {}
}
