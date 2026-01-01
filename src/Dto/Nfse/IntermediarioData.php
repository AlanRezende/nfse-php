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
class IntermediarioData extends Data
{
    public function __construct(
        /**
         * CNPJ do intermediário.
         * Obrigatório se pessoa jurídica.
         */
        #[MapInputName('CNPJ')]
        public ?string $cnpj = null,

        /**
         * CPF do intermediário.
         * Obrigatório se pessoa física.
         */
        #[MapInputName('CPF')]
        public ?string $cpf = null,

        /**
         * Número de Identificação Fiscal (NIF) do intermediário.
         * Não permitido se tpEmit=3.
         */
        #[MapInputName('NIF')]
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
         * Inscrição Municipal do intermediário.
         */
        #[MapInputName('IM')]
        public ?string $inscricaoMunicipal = null,

        /**
         * Razão Social ou Nome do intermediário.
         */
        #[MapInputName('xNome')]
        public ?string $nome = null,

        /**
         * Endereço do intermediário.
         */
        #[MapInputName('end')]
        public ?EnderecoData $endereco = null,

        /**
         * Telefone do intermediário.
         */
        #[MapInputName('fone')]
        public ?string $telefone = null,

        /**
         * Email do intermediário.
         */
        #[MapInputName('email')]
        public ?string $email = null,
    ) {}
}
