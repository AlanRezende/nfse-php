<?php

namespace Nfse\Tests\Unit\Xml;

use Nfse\Dto\Nfse\DpsData;
use Nfse\Support\IdGenerator;
use Nfse\Xml\DpsXmlBuilder;

it('can build xml from dps data', function () {
    $id = IdGenerator::generateDpsId('12345678000199', '3550308', '1', '1001');

    $dpsData = new DpsData([
        '@attributes' => ['versao' => '1.0'],
        'infDPS' => [
            '@attributes' => ['Id' => $id],
            'tpAmb' => 2,
            'dhEmi' => '2023-10-27T10:00:00',
            'verAplic' => '1.0',
            'serie' => '1',
            'nDPS' => '1001',
            'dCompet' => '2023-10-27',
            'tpEmit' => 1,
            'cLocEmi' => '3550308',
            'cMotivoEmisTI' => '4',
            'chNFSeRej' => '12345678901234567890123456789012345678901234',
            'subst' => null,
            'prest' => [
                'CNPJ' => '12345678000199',
                'CPF' => null,
                'NIF' => null,
                'cNaoNIF' => null,
                'CAEPF' => null,
                'IM' => '12345',
                'xNome' => 'Prestador Exemplo Ltda',
                'end' => null,
                'fone' => null,
                'email' => null,
                'regTrib' => null,
            ],
            'toma' => [
                'CPF' => '11122233344',
                'CNPJ' => null,
                'NIF' => null,
                'cNaoNIF' => null,
                'CAEPF' => null,
                'IM' => null,
                'xNome' => 'Tomador Exemplo',
                'end' => null,
                'fone' => null,
                'email' => null,
            ],
            'interm' => null,
            'serv' => [
                'locPrest' => [
                    'cLocPrestacao' => '3550308',
                    'cPaisPrestacao' => 'BR',
                ],
                'cServ' => [
                    'cTribNac' => '1.01',
                    'cTribMun' => null,
                    'xDescServ' => 'Analise de sistemas',
                    'cNBS' => null,
                    'cIntContrib' => null,
                ],
                'comExt' => null,
                'obra' => null,
                'atvEvento' => null,
                'infoComplem' => null,
                'idDocTec' => null,
                'docRef' => null,
                'xInfComp' => null,
            ],
            'valores' => [
                'vServPrest' => [
                    'vReceb' => 1000.00,
                    'vServ' => 1000.00,
                ],
                'vDescCondIncond' => null,
                'vDedRed' => null,
                'trib' => [
                    'tribMun.tribISSQN' => 1,
                    'tribMun.tpImunidade' => null,
                    'tribMun.tpRetISSQN' => 1,
                    'tribMun.exigSusp.tpSusp' => 1,
                    'tribMun.exigSusp.nProcesso' => '123456',
                    'tribMun.BM' => [
                        'pRedBCBM' => 10.0,
                        'vRedBCBM' => 100.0,
                    ],
                    'tribFed.piscofins.CST' => null,
                    'totTrib.pTotTribSN' => null,
                    'totTrib.indTotTrib' => null,
                ],
            ],
        ],
    ]);

    $builder = new DpsXmlBuilder;
    $xml = $builder->build($dpsData);

    expect($xml)->toContain('<DPS xmlns="http://www.sped.fazenda.gov.br/nfse" versao="1.0">')
        ->and($xml)->toContain('<infDPS Id="'.$id.'">')
        ->and($xml)->toContain('<nDPS>1001</nDPS>')
        ->and($xml)->toContain('<vServ>1000.00</vServ>')
        ->and($xml)->toContain('<cMotivoEmisTI>4</cMotivoEmisTI>')
        ->and($xml)->toContain('<chNFSeRej>12345678901234567890123456789012345678901234</chNFSeRej>')
        ->and($xml)->toContain('<tpSusp>1</tpSusp>')
        ->and($xml)->toContain('<nProcesso>123456</nProcesso>')
        ->and($xml)->toContain('<pRedBCBM>10.00</pRedBCBM>')
        ->and($xml)->toContain('<vRedBCBM>100.00</vRedBCBM>');
});
