<?php

namespace Nfse\Validator;

use Nfse\Dto\Nfse\DpsData;
use Nfse\Dto\Nfse\InfDpsData;

class DpsValidator
{
    public function validate(DpsData $dps): ValidationResult
    {
        $errors = [];
        $infDps = $dps->infDps;

        if ($infDps === null) {
            return ValidationResult::failure(['InfDpsData is required.']);
        }

        $this->validatePrestador($infDps, $errors);
        $this->validateTomador($infDps, $errors);

        if (count($errors) > 0) {
            return ValidationResult::failure($errors);
        }

        return ValidationResult::success();
    }

    private function validatePrestador(InfDpsData $infDps, array &$errors): void
    {
        $prestador = $infDps->prestador;
        $tpEmit = $infDps->tipoEmitente;

        if ($prestador === null) {
            $errors[] = 'Prestador data is required.';
            return;
        }

        // Rule: If Prestador is NOT the emitter, address is required.
        // Schema Rule E0129
        if ($tpEmit !== 1) {
            if ($prestador->endereco === null) {
                $errors[] = 'Endereço do prestador é obrigatório quando o prestador não for o emitente.';
            }
        }

        // Rule: If Prestador is the emitter, address should NOT be informed (Schema Rule E0128)
        // However, usually we just ignore it or warn. For strict validation, we might error.
        // Let's stick to "Required" checks for now as per user request.
    }

    private function validateTomador(InfDpsData $infDps, array &$errors): void
    {
        $tomador = $infDps->tomador;
        
        if ($tomador === null) {
            return;
        }

        // User Rule: "se o tomador for identificado o endereço dele é obg"
        $isIdentified = $tomador->cpf || $tomador->cnpj || $tomador->nif;

        if ($isIdentified) {
            if ($tomador->endereco === null) {
                $errors[] = 'Endereço do tomador é obrigatório quando o tomador é identificado.';
                return;
            }

            // User Rule: "se ele for estrangeiro o endereco extrag é obg"
            // We assume "estrangeiro" means NIF is present or specific flag.
            // Schema Rule E0242: "O grupo de informações de endereço no exterior deve ser informado obrigatoriamente quando o tomador for identificado pelo NIF e o emitente por CNPJ."
            // Also if address is foreign, we expect `enderecoExterior` to be filled.
            
            // Let's use NIF as the indicator for foreign entity as per schema hint.
            if ($tomador->nif !== null) {
                 if ($tomador->endereco->enderecoExterior === null) {
                     $errors[] = 'Endereço no exterior do tomador é obrigatório quando identificado por NIF.';
                 }
                 // And national address fields should probably be empty or ignored?
                 // Schema doesn't explicitly forbid national fields if foreign is present, but usually it's one or the other.
            } else {
                // If not NIF (so CPF or CNPJ), we expect national address fields.
                // We can check if `codigoMunicipio` is present in `endereco`.
                if ($tomador->endereco->codigoMunicipio === null) {
                    $errors[] = 'Código do município do tomador é obrigatório para endereço nacional.';
                }
            }
        }
    }
}
