<?php

use Nfse\Dto\Nfse\DpsData;
use Nfse\Dto\Nfse\InfDpsData;
use Nfse\Dto\Nfse\ObraData;
use Nfse\Dto\Nfse\ServicoData;
use Nfse\Dto\Nfse\TributacaoData;
use Nfse\Dto\Nfse\ValoresData;
use Nfse\Dto\Nfse\ValorServicoPrestadoData;
use Nfse\Dto\Nfse\EnderecoData;
use Nfse\Dto\Nfse\CodigoServicoData;
use Nfse\Dto\Nfse\LocalPrestacaoData;

it('can instantiate DPS with Civil Construction (Obra)', function () {
    $servico = new ServicoData(
        localPrestacao: new LocalPrestacaoData(
            codigoLocalPrestacao: '3550308',
            codigoPaisPrestacao: null
        ),
        codigoServico: new CodigoServicoData(
            codigoTributacaoNacional: '07.02.01',
            codigoTributacaoMunicipal: '702',
            descricaoServico: 'Execução de obra...',
            codigoNbs: '123456789',
            codigoInternoContribuinte: null
        ),
        comercioExterior: null,
        obra: new ObraData(
            inscricaoImobiliariaFiscal: '123456',
            codigoObra: 'OBRA-2023-001',
            endereco: new EnderecoData(
                codigoMunicipio: '3550308',
                cep: '01001000',
                logradouro: 'Rua da Obra',
                numero: '100',
                bairro: 'Centro',
                complemento: null,
                enderecoExterior: null
            )
        ),
        atividadeEvento: null,
        informacoesComplementares: null,
        idDocumentoTecnico: null,
        documentoReferencia: null,
        descricaoInformacoesComplementares: null
    );

    expect($servico->obra)->toBeInstanceOf(ObraData::class);
    expect($servico->obra->codigoObra)->toBe('OBRA-2023-001');
});

it('can instantiate DPS with ISS Retained at Source', function () {
    $valores = new ValoresData(
        valorServicoPrestado: new ValorServicoPrestadoData(
            valorServico: 1000.00,
            valorRecebido: null
        ),
        desconto: null,
        deducaoReducao: null,
        tributacao: new TributacaoData(
            tributacaoIssqn: 1, // Tributável
            tipoImunidade: null,
            tipoRetencaoIssqn: 2, // Retido pelo Tomador
            tipoSuspensao: null,
            numeroProcessoSuspensao: null,
            beneficioMunicipal: null,
            cstPisCofins: null,
            percentualTotalTributosSN: null,
            indicadorTotalTributos: 0
        )
    );

    expect($valores->tributacao->tipoRetencaoIssqn)->toBe(2);
});
