<?php

namespace Nfse\Tests\Unit\Service;

use Nfse\Enums\TipoAmbiente;
use Nfse\Http\Client\AdnClient;
use Nfse\Http\Client\CncClient;
use Nfse\Http\NfseContext;
use Nfse\Service\MunicipioService;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class MunicipioServiceTest extends TestCase
{
    private $context;

    private $service;

    private $adnClientMock;

    private $cncClientMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->context = new NfseContext(
            TipoAmbiente::Homologacao,
            '/tmp/cert.pfx',
            'password'
        );

        $this->adnClientMock = $this->createMock(AdnClient::class);
        $this->cncClientMock = $this->createMock(CncClient::class);

        $this->service = new MunicipioService($this->context);

        $reflection = new ReflectionClass($this->service);

        $adnProperty = $reflection->getProperty('adnClient');
        $adnProperty->setAccessible(true);
        $adnProperty->setValue($this->service, $this->adnClientMock);

        $cncProperty = $reflection->getProperty('cncClient');
        $cncProperty->setAccessible(true);
        $cncProperty->setValue($this->service, $this->cncClientMock);
    }

    public function test_baixar_dfe_municipio()
    {
        $this->adnClientMock->expects($this->once())
            ->method('baixarDfeMunicipio')
            ->with(100)
            ->willReturn(new \Nfse\Dto\Http\DistribuicaoDfeResponse(ultimoNsu: 100, listaNsu: []));

        $result = $this->service->baixarDfe(100);

        $this->assertInstanceOf(\Nfse\Dto\Http\DistribuicaoDfeResponse::class, $result);
    }

    public function test_enviar_lote()
    {
        $xmlZipB64 = 'base64data';
        $this->adnClientMock->expects($this->once())
            ->method('enviarLote')
            ->with($xmlZipB64)
            ->willReturn(['protocolo' => '123']);

        $result = $this->service->enviarLote($xmlZipB64);

        $this->assertEquals(['protocolo' => '123'], $result);
    }

    public function test_consultar_contribuinte()
    {
        $this->cncClientMock->expects($this->once())
            ->method('consultarContribuinte')
            ->with('12345678000199')
            ->willReturn(['nome' => 'Empresa Teste']);

        $result = $this->service->consultarContribuinte('12345678000199');

        $this->assertEquals(['nome' => 'Empresa Teste'], $result);
    }

    public function test_baixar_alteracoes_cadastro()
    {
        $this->cncClientMock->expects($this->once())
            ->method('baixarAlteracoesCadastro')
            ->with(100)
            ->willReturn(['alteracoes' => []]);

        $result = $this->service->baixarAlteracoesCadastro(100);

        $this->assertEquals(['alteracoes' => []], $result);
    }

    public function test_atualizar_contribuinte()
    {
        $dados = ['cnpj' => '12345678000199'];
        $this->cncClientMock->expects($this->once())
            ->method('atualizarContribuinte')
            ->with($dados)
            ->willReturn(['status' => 'sucesso']);

        $result = $this->service->atualizarContribuinte($dados);

        $this->assertEquals(['status' => 'sucesso'], $result);
    }

    public function test_consultar_parametros_convenio()
    {
        $this->adnClientMock->expects($this->once())
            ->method('consultarParametrosConvenio')
            ->with('3550308')
            ->willReturn(['param' => 'value']);

        $result = $this->service->consultarParametrosConvenio('3550308');

        $this->assertEquals(['param' => 'value'], $result);
    }

    public function test_consultar_aliquota()
    {
        $this->adnClientMock->expects($this->once())
            ->method('consultarAliquota')
            ->with('3550308', '01.01', '2023-10-01')
            ->willReturn(['aliquota' => 5.0]);

        $result = $this->service->consultarAliquota('3550308', '01.01', '2023-10-01');

        $this->assertEquals(['aliquota' => 5.0], $result);
    }
}
