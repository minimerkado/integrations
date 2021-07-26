<?php


namespace Tests\Correios\Requests;


use Correios\PackageType;
use Correios\Requests\EstimatePayload;
use Correios\ServiceType;
use Orchestra\Testbench\TestCase;

class EstimatePayloadTest extends TestCase
{
    public function testHeightCaixa()
    {
        $payload = EstimatePayload::make()
            ->setHeight(10)
            ->setPackage(PackageType::CAIXA);

        self::assertEquals(10, $payload->height());

        $payload_low = EstimatePayload::make()
            ->setHeight(1)
            ->setPackage(PackageType::CAIXA);

        self::assertEquals(2, $payload_low->height());
    }

    public function testHeight()
    {
        $payload = EstimatePayload::make()
            ->setHeight(10)
            ->setPackage(PackageType::ENVELOPE);

        self::assertEquals(0, $payload->height());

        $payload_rolo = EstimatePayload::make()
            ->setHeight(10)
            ->setPackage(PackageType::ROLO);

        self::assertEquals(0, $payload_rolo->height());
    }

    public function testWidthCaixa()
    {
        $payload = EstimatePayload::make()
            ->setWidth(20)
            ->setPackage(PackageType::CAIXA);

        self::assertEquals(20, $payload->width());

        $payload_low = EstimatePayload::make()
            ->setWidth(9)
            ->setPackage(PackageType::CAIXA);

        self::assertEquals(11, $payload_low->width());
    }

    public function testWidthEnvelope()
    {
        $payload = EstimatePayload::make()
            ->setWidth(20)
            ->setPackage(PackageType::ENVELOPE);

        self::assertEquals(20, $payload->width());

        $payload_low = EstimatePayload::make()
            ->setWidth(9)
            ->setPackage(PackageType::ENVELOPE);

        self::assertEquals(11, $payload_low->width());
    }

    public function testWidthRolo()
    {
        $payload = EstimatePayload::make()
            ->setWidth(20)
            ->setPackage(PackageType::ROLO);

        self::assertEquals(0, $payload->width());
    }

    public function testLengthCaixa()
    {
        $payload = EstimatePayload::make()
            ->setLength(20)
            ->setPackage(PackageType::CAIXA);

        self::assertEquals(20, $payload->length());

        $payload_low = EstimatePayload::make()
            ->setLength(9)
            ->setPackage(PackageType::CAIXA);

        self::assertEquals(16, $payload_low->length());
    }

    public function testLengthEnvelope()
    {
        $payload = EstimatePayload::make()
            ->setLength(20)
            ->setPackage(PackageType::ENVELOPE);

        self::assertEquals(20, $payload->length());

        $payload_low = EstimatePayload::make()
            ->setLength(9)
            ->setPackage(PackageType::ENVELOPE);

        self::assertEquals(16, $payload_low->length());
    }

    public function testLengthRolo()
    {
        $payload = EstimatePayload::make()
            ->setLength(20)
            ->setPackage(PackageType::ROLO);

        self::assertEquals(20, $payload->length());

        $payload_low = EstimatePayload::make()
            ->setLength(9)
            ->setPackage(PackageType::ROLO);

        self::assertEquals(18, $payload_low->length());
    }

    public function testDiameter()
    {
        $payload = EstimatePayload::make()
            ->setDiameter(20)
            ->setPackage(PackageType::ENVELOPE);

        self::assertEquals(0, $payload->diameter());

        $payload_caixa = EstimatePayload::make()
            ->setDiameter(20)
            ->setPackage(PackageType::CAIXA);

        self::assertEquals(0, $payload_caixa->diameter());
    }

    public function testDiameterRolo()
    {
        $payload = EstimatePayload::make()
            ->setDiameter(20)
            ->setPackage(PackageType::ROLO);

        self::assertEquals(20, $payload->diameter());

        $payload_low = EstimatePayload::make()
            ->setDiameter(2)
            ->setPackage(PackageType::ROLO);

        self::assertEquals(5, $payload_low->diameter());
    }

    public function testBuild()
    {
        $payload = EstimatePayload::make()
            ->setPackage(PackageType::CAIXA)
            ->setOrigin('57030170')
            ->setDestination('70800200')
            ->setWidth(20.2)
            ->setHeight(20.2)
            ->setLength(20.2)
            ->setWeight(2.1)
            ->setDeclaredValue(150.50)
            ->setCompany('Company Test')
            ->setPassword('password');

        self::assertEquals([
            'query' => [
                'nCdServico' => '4014',
                'nCdEmpresa' => 'Company Test',
                'sDsSenha' => 'password',
                'sCepOrigem' => '57030170',
                'sCepDestino' => '70800200',
                'nVlPeso' => 2.1,
                'nCdFormato' => 1,
                'nVlComprimento' => 20,
                'nVlAltura' => 20,
                'nVlLargura' => 20,
                'nVlDiametro' => 0,
                'nVlValorDeclarado' => 150.5,
                'sCdMaoPropria' => 'N',
                'sCdAvisoRecebimento' => 'N',
            ]
        ], $payload->build(ServiceType::SEDEX));
    }
}