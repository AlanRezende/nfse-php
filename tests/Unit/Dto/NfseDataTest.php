<?php

use Nfse\Dto\Nfse\DpsData;
use Nfse\Dto\Nfse\EmitenteData;
use Nfse\Dto\Nfse\EnderecoEmitenteData;
use Nfse\Dto\Nfse\InfDpsData;
use Nfse\Dto\Nfse\InfNfseData;
use Nfse\Dto\Nfse\NfseData;

use Nfse\Dto\Nfse\ValoresNfseData;
use Nfse\Support\IdGenerator;

it('can instantiate nfse data with full structure', function () {
    $dpsId = IdGenerator::generateDpsId('12345678000199', '1234567', '1', '100');

    $nfse = new NfseData(
        versao: '1.00',
        infNfse: new InfNfseData(
            id: 'NFS123456',
            numeroNfse: '100',
            numeroDfse: '987654321',
            codigoVerificacao: 'ABCDEF',
            dataProcessamento: '2023-01-01T12:00:00',
            ambienteGerador: 2,
            versaoAplicativo: '1.0',
            processoEmissao: 1,
            localEmissao: 'VARZEA ALEGRE',
            localPrestacao: 'VARZEA ALEGRE',
            codigoLocalIncidencia: '2314003',
            nomeLocalIncidencia: 'VARZEA ALEGRE',
            descricaoTributacaoNacional: 'Enfermagem...',
            descricaoTributacaoMunicipal: '04.06 - Enfermagem...',
                                                                                descricaoNbs: '123456789',
            tipoEmissao: 1,
            codigoStatus: 100,
            outrasInformacoes: 'Informações adicionais',
            dps: new DpsData(
                versao: '1.00',
                infDps: new InfDpsData(
                    id: $dpsId,
                    tipoAmbiente: 2,
                    dataEmissao: '2023-01-01',
                    versaoAplicativo: '1.0',
                    serie: '1',
                    numeroDps: '100',
                    dataCompetencia: '2023-01-01',
                    tipoEmitente: 1,
                    codigoLocalEmissao: '1234567',
                    motivoEmissaoTomadorIntermediario: null,
                    chaveNfseRejeitada: null,
                    substituicao: null,
                    prestador: null,
                    tomador: null,
                    intermediario: null,
                    servico: null,
                    valores: null
                )
            ),
            emitente: new EmitenteData(
                cnpj: '12345678000199',
                cpf: null,
                inscricaoMunicipal: '12345',
                nome: 'Prefeitura Municipal',
                nomeFantasia: 'Secretaria de Finanças',
                endereco: new EnderecoEmitenteData(
                    logradouro: 'Praça da Sé',
                    numero: '1',
                    complemento: null,
                    bairro: 'Centro',
                    codigoMunicipio: '3550308',
                    uf: 'SP',
                    cep: '01001000'
                ),
                telefone: '1112345678',
                email: 'contato@prefeitura.sp.gov.br'
            ),
            valores: new ValoresNfseData(
                valorCalculadoDeducaoReducao: 0.0,
                tipoBeneficioMunicipal: 0,
                valorCalculadoBeneficioMunicipal: 0.0,
                baseCalculo: 1850.00,
                aliquotaAplicada: 5.00,
                valorIssqn: 92.50,
                valorTotalRetido: 0.0,
                valorLiquido: 1757.50
            )
        )
    );

    expect($nfse)->toBeInstanceOf(NfseData::class);
    expect($nfse->infNfse->numeroDfse)->toBe('987654321');
    expect($nfse->infNfse->localEmissao)->toBe('VARZEA ALEGRE');
    expect($nfse->infNfse->valores)->toBeInstanceOf(ValoresNfseData::class);
    expect($nfse->infNfse->valores->valorLiquido)->toBe(1757.50);
    
    expect($nfse->infNfse)->toBeInstanceOf(InfNfseData::class);
    expect($nfse->infNfse->emitente)->toBeInstanceOf(EmitenteData::class);
    expect($nfse->infNfse->emitente->endereco)->toBeInstanceOf(EnderecoEmitenteData::class);
    expect($nfse->infNfse->dps)->toBeInstanceOf(DpsData::class);
});

it('verifies DpsData is a DFe', function () {
    $dpsId = IdGenerator::generateDpsId('12345678000199', '1234567', '1', '100');

    $dps = new DpsData(
        versao: '1.00',
        infDps: new InfDpsData(
            id: $dpsId,
            tipoAmbiente: 2,
            dataEmissao: '2023-01-01',
            versaoAplicativo: '1.0',
            serie: '1',
            numeroDps: '100',
            dataCompetencia: '2023-01-01',
            tipoEmitente: 1,
            codigoLocalEmissao: '1234567',
            motivoEmissaoTomadorIntermediario: null,
            chaveNfseRejeitada: null,
            substituicao: null,
            prestador: null,
            tomador: null,
            intermediario: null,
            servico: null,
            valores: null
        )
    );

    expect($dps)->toBeInstanceOf(DpsData::class);
});
