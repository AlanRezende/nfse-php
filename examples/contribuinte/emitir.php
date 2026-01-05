<?php

use Nfse\Dto\Nfse\CodigoServicoData;
use Nfse\Dto\Nfse\DpsData;
use Nfse\Dto\Nfse\InfDpsData;
use Nfse\Dto\Nfse\LocalPrestacaoData;
use Nfse\Dto\Nfse\PrestadorData;
use Nfse\Dto\Nfse\ServicoData;
use Nfse\Dto\Nfse\TomadorData;
use Nfse\Dto\Nfse\TributacaoData;
use Nfse\Dto\Nfse\ValoresData;
use Nfse\Dto\Nfse\ValorServicoPrestadoData;
use Nfse\Dto\Nfse\RegimeTributarioData;
use Nfse\Dto\Nfse\EnderecoData;
use Nfse\Http\NfseContext;
use Nfse\Nfse;
use Nfse\Support\IdGenerator;

/** @var \Nfse\Nfse $nfse */
$nfse = require_once __DIR__.'/../bootstrap.php';

try {
    // $certificatePath = __DIR__.'/certs/cert.pfx';
    // $certificatePassword = 'senha';

    $context = new NfseContext(
        ambiente: \Nfse\Enums\TipoAmbiente::Homologacao,
        certificatePath: $certificatePath,
        certificatePassword: $certificatePassword
    );

    $nfse = new Nfse($context);

    date_default_timezone_set('America/Sao_Paulo');
    $cnpjPrestador = '03279735000194';
    $codigoMunicipio = '2304400';
    $serie = '1';
    $numero = '100';

    $idDps = IdGenerator::generateDpsId(
        cpfCnpj: $cnpjPrestador,
        codIbge: $codigoMunicipio,
        serieDps: $serie,
        numDps: $numero
    );

    $dps = new DpsData(
        versao: '1.01',
        infDps: new InfDpsData(
            id: $idDps,
            tipoAmbiente: 2, // Homologação
            dataEmissao: date('c'),
            versaoAplicativo: 'SDK-PHP-1.0',
            serie: $serie,
            numeroDps: $numero,
            dataCompetencia: date('Y-m-d'),
            tipoEmitente: 1, // Prestador
            codigoLocalEmissao: $codigoMunicipio,


            prestador: new PrestadorData(
                cnpj: $cnpjPrestador,
                // inscricaoMunicipal: '123456',
                nome: 'Empresa de Teste',
                endereco: new EnderecoData(
                    logradouro: 'Rua Teste',
                    numero: '123',
                    complemento: 'Sala 1',
                    bairro: 'Centro',
                    codigoMunicipio: $codigoMunicipio,
                    cep: '60000000'
                ),
                telefone: '85999999999',
                email: 'teste@empresa.com.br',
                regimeTributario: new RegimeTributarioData(
                    opcaoSimplesNacional: 1, // Não Optante
                    regimeApuracaoTributosSn: null,
                    regimeEspecialTributacao: 0 // Nenhum
                )
            ),
            tomador: new TomadorData(
                cnpj: '44827692000111',
                nome: 'Cliente de Teste'
            ),
            servico: new ServicoData(
                localPrestacao: new LocalPrestacaoData(
                    codigoLocalPrestacao: $codigoMunicipio,
                    codigoPaisPrestacao: 'BR'
                ),
                codigoServico: new CodigoServicoData(
                    codigoTributacaoNacional: '010101',
                    descricaoServico: 'Desenvolvimento de Software'
                )
            ),
            valores: new ValoresData(
                valorServicoPrestado: new ValorServicoPrestadoData(
                    valorServico: 100.00
                ),
                tributacao: new TributacaoData(
                    tributacaoIssqn: 1,
                    tipoImunidade: null,
                    tipoRetencaoIssqn: 1,
                    tipoSuspensao: null,
                    numeroProcessoSuspensao: null,
                    indicadorTotalTributos: 0,
                    beneficioMunicipal: null,
                    cstPisCofins: '08'
                )
            )
        )
    );

    echo "Emitindo NFS-e para a DPS: $idDps...\n";

    $nfseData = $nfse->contribuinte()->emitir($dps);

    echo "NFS-e emitida com sucesso!\n";
    echo 'Chave de Acesso: '.$nfseData->infNfse->id."\n";

} catch (\Exception $e) {
    echo 'Erro: '.$e->getMessage()."\n";
}
