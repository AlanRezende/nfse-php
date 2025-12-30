<?php

namespace Nfse\Tests\Unit\Signer;

use Nfse\Signer\Certificate;
use Nfse\Signer\XmlSigner;

it('can sign a dps xml', function () {
    $pfxPath = __DIR__ . '/../../fixtures/certs/test.pfx';
    $password = '1234';
    
    $certificate = new Certificate($pfxPath, $password);
    $signer = new XmlSigner($certificate);
    
    $xmlPath = __DIR__ . '/../../fixtures/xml/ExemploPrestadorPessoaFisica.xml';
    $xml = file_get_contents($xmlPath);
    
    // Remove existing signature for testing
    $xml = preg_replace('/<Signature[\s\S]*?<\/Signature>/', '', $xml);
    
    // The example XML might have namespaces that complicate things if not handled, 
    // but XmlSigner loads it into DOMDocument which handles namespaces.
    
    $signedXml = $signer->sign($xml, 'infDPS');
    
    expect($signedXml)->toContain('Signature xmlns')
        ->and($signedXml)->toContain('http://www.w3.org/2000/09/xmldsig#')
        ->and($signedXml)->toContain('Reference URI="#DPS231400310000667299238300001000000000000046"')
        ->and($signedXml)->toContain('DigestValue>');
});
