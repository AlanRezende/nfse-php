<?php

namespace Nfse\Tests\Unit\Enums;

use Nfse\Enums\EmitenteDPS;
use Nfse\Enums\ProcessoEmissao;
use Nfse\Enums\TipoAmbiente;

describe('TipoAmbiente', function () {
    it('has correct values', function () {
        expect(TipoAmbiente::Producao->value)->toBe('1')
            ->and(TipoAmbiente::Homologacao->value)->toBe('2');
    });

    it('can create from value', function () {
        expect(TipoAmbiente::from('1'))->toBe(TipoAmbiente::Producao)
            ->and(TipoAmbiente::from('2'))->toBe(TipoAmbiente::Homologacao);

        expect(TipoAmbiente::tryFrom('1'))->toBe(TipoAmbiente::Producao)
            ->and(TipoAmbiente::tryFrom('99'))->toBeNull();
    });

    it('returns all cases', function () {
        $cases = TipoAmbiente::cases();

        expect($cases)->toHaveCount(2)
            ->and($cases[0])->toBe(TipoAmbiente::Producao)
            ->and($cases[1])->toBe(TipoAmbiente::Homologacao);
    });

    it('returns correct descriptions', function () {
        expect(TipoAmbiente::Producao->getDescription())->toBe('Produção')
            ->and(TipoAmbiente::Homologacao->getDescription())->toBe('Homologação')
            ->and(TipoAmbiente::Producao->label())->toBe('Produção');
    });
});

describe('EmitenteDPS', function () {
    it('has correct values', function () {
        expect(EmitenteDPS::Prestador->value)->toBe('1')
            ->and(EmitenteDPS::Tomador->value)->toBe('2')
            ->and(EmitenteDPS::Intermediario->value)->toBe('3');
    });

    it('can create from value', function () {
        expect(EmitenteDPS::from('1'))->toBe(EmitenteDPS::Prestador)
            ->and(EmitenteDPS::from('2'))->toBe(EmitenteDPS::Tomador)
            ->and(EmitenteDPS::from('3'))->toBe(EmitenteDPS::Intermediario);

        expect(EmitenteDPS::tryFrom('1'))->toBe(EmitenteDPS::Prestador)
            ->and(EmitenteDPS::tryFrom('99'))->toBeNull();
    });

    it('returns all cases', function () {
        $cases = EmitenteDPS::cases();

        expect($cases)->toHaveCount(3)
            ->and($cases[0])->toBe(EmitenteDPS::Prestador)
            ->and($cases[1])->toBe(EmitenteDPS::Tomador)
            ->and($cases[2])->toBe(EmitenteDPS::Intermediario);
    });

    it('returns correct descriptions', function () {
        expect(EmitenteDPS::Prestador->getDescription())->toBe('Prestador')
            ->and(EmitenteDPS::Tomador->getDescription())->toBe('Tomador')
            ->and(EmitenteDPS::Intermediario->getDescription())->toBe('Intermediário')
            ->and(EmitenteDPS::Prestador->label())->toBe('Prestador');
    });
});

describe('ProcessoEmissao', function () {
    it('has correct values', function () {
        expect(ProcessoEmissao::WebService->value)->toBe('1')
            ->and(ProcessoEmissao::WebFisco->value)->toBe('2')
            ->and(ProcessoEmissao::AppFisco->value)->toBe('3');
    });

    it('can create from value', function () {
        expect(ProcessoEmissao::from('1'))->toBe(ProcessoEmissao::WebService)
            ->and(ProcessoEmissao::from('2'))->toBe(ProcessoEmissao::WebFisco)
            ->and(ProcessoEmissao::from('3'))->toBe(ProcessoEmissao::AppFisco);

        expect(ProcessoEmissao::tryFrom('1'))->toBe(ProcessoEmissao::WebService)
            ->and(ProcessoEmissao::tryFrom('99'))->toBeNull();
    });

    it('returns all cases', function () {
        $cases = ProcessoEmissao::cases();

        expect($cases)->toHaveCount(3)
            ->and($cases[0])->toBe(ProcessoEmissao::WebService)
            ->and($cases[1])->toBe(ProcessoEmissao::WebFisco)
            ->and($cases[2])->toBe(ProcessoEmissao::AppFisco);
    });

    it('returns correct descriptions', function () {
        expect(ProcessoEmissao::WebService->getDescription())
            ->toBe('Emissão com aplicativo do contribuinte (via Web Service)');
        expect(ProcessoEmissao::WebFisco->getDescription())
            ->toBe('Emissão com aplicativo disponibilizado pelo fisco (Web)');
        expect(ProcessoEmissao::AppFisco->getDescription())
            ->toBe('Emissão com aplicativo disponibilizado pelo fisco (App)');
        expect(ProcessoEmissao::WebService->label())
            ->toBe('Emissão com aplicativo do contribuinte (via Web Service)');
    });
});

describe('TipoNsu', function () {
    it('has correct values', function () {
        expect(\Nfse\Enums\TipoNsu::Recepcao->value)->toBe('RECEPCAO')
            ->and(\Nfse\Enums\TipoNsu::Distribuicao->value)->toBe('DISTRIBUICAO')
            ->and(\Nfse\Enums\TipoNsu::Geral->value)->toBe('GERAL')
            ->and(\Nfse\Enums\TipoNsu::Mei->value)->toBe('MEI');
    });

    it('returns correct descriptions', function () {
        expect(\Nfse\Enums\TipoNsu::Recepcao->getDescription())->toBe('Recepção')
            ->and(\Nfse\Enums\TipoNsu::Geral->label())->toBe('Geral');
    });
});

describe('TributacaoIssqn', function () {
    it('has correct values', function () {
        expect(\Nfse\Enums\TributacaoIssqn::OperacaoTributavel->value)->toBe(1)
            ->and(\Nfse\Enums\TributacaoIssqn::Imunidade->value)->toBe(2);
    });
});

describe('TipoRetencaoIssqn', function () {
    it('has correct values', function () {
        expect(\Nfse\Enums\TipoRetencaoIssqn::NaoRetido->value)->toBe(1)
            ->and(\Nfse\Enums\TipoRetencaoIssqn::RetidoTomador->value)->toBe(2);
    });
});

describe('TipoImunidade', function () {
    it('has correct values', function () {
        expect(\Nfse\Enums\TipoImunidade::NaoInformado->value)->toBe(0)
            ->and(\Nfse\Enums\TipoImunidade::PatrimonioRendaServicos->value)->toBe(1);
    });
});

describe('TipoSuspensao', function () {
    it('has correct values', function () {
        expect(\Nfse\Enums\TipoSuspensao::DecisaoJudicial->value)->toBe(1)
            ->and(\Nfse\Enums\TipoSuspensao::DecisaoAdministrativa->value)->toBe(2);
    });
});

describe('TipoRetencaoPisCofins', function () {
    it('has correct values', function () {
        expect(\Nfse\Enums\TipoRetencaoPisCofins::NaoRetido->value)->toBe(1)
            ->and(\Nfse\Enums\TipoRetencaoPisCofins::Retido->value)->toBe(2);
    });
});

describe('IndicadorTotalTributos', function () {
    it('has correct values', function () {
        expect(\Nfse\Enums\IndicadorTotalTributos::Nenhum->value)->toBe(0)
            ->and(\Nfse\Enums\IndicadorTotalTributos::Lei12741->value)->toBe(1);
    });
});
