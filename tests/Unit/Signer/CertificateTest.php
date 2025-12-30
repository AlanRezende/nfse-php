<?php

namespace Nfse\Tests\Unit\Signer;

use Nfse\Signer\Certificate;
use Exception;

it('throws exception for invalid password', function () {
    $pfxPath = __DIR__ . '/../../fixtures/certs/test.pfx';
    $password = 'wrong_password';
    
    expect(fn () => new Certificate($pfxPath, $password))
        ->toThrow(Exception::class, 'Senha do certificado incorreta ou arquivo inválido/corrompido');
});

it('throws exception for expired certificate', function () {
    // Skipping this test as generating an expired PFX on the fly is complex and flaky across environments.
    // Ideally we should have a static expired.pfx fixture.
})->skip('Requires a pre-generated expired PFX file');
