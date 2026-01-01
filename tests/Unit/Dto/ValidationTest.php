<?php

namespace Nfse\Tests\Unit\Dto;

use Nfse\Dto\Nfse\InfDpsData;
use Illuminate\Validation\ValidationException;

it('fails validation when required fields are missing', function () {
    InfDpsData::validate([
        'tpAmb' => 1,
    ]);
})->throws(ValidationException::class);

it('passes validation when all required fields are present', function () {
    $data = [
        '@Id' => 'DPS123',
        'tpAmb' => 1,
        'dhEmi' => '2023-10-27T10:00:00-03:00',
        'verAplic' => '1.0',
        'serie' => '1',
        'nDPS' => '1001',
        'dCompet' => '2023-10-27',
        'tpEmit' => 1,
        'cLocEmi' => '3550308',
    ];

    $infDps = InfDpsData::validateAndCreate($data);

    expect($infDps)->toBeInstanceOf(InfDpsData::class)
        ->and($infDps->id)->toBe('DPS123');
});
