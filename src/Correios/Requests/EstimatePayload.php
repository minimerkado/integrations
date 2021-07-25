<?php


namespace Correios\Requests;


use Common\Utilities;
use Correios\PackageType;

class EstimatePayload
{
    use Utilities;

    private string $origin;
    private string $destination;
    private int $height = 0;
    private int $length = 0;
    private int $width = 0;
    private float $weight = 0;
    private int $diameter = 0;
    private int $package = PackageType::CAIXA;
    private float $declared_value = 0;
    private string $company = '';
    private string $password = '';
    private bool $own_hand = false;
    private bool $receiving_notice = false;

    /**
     * @param string $origin
     * @return EstimatePayload
     */
    public function setOrigin(string $origin): EstimatePayload
    {
        $this->origin = $origin;
        return $this;
    }

    /**
     * @param string $destination
     * @return EstimatePayload
     */
    public function setDestination(string $destination): EstimatePayload
    {
        $this->destination = $destination;
        return $this;
    }

    /**
     * @param int $height
     * @return EstimatePayload
     */
    public function setHeight(int $height): EstimatePayload
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @param int $length
     * @return EstimatePayload
     */
    public function setLength(int $length): EstimatePayload
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @param int $width
     * @return EstimatePayload
     */
    public function setWidth(int $width): EstimatePayload
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @param float|int $weight
     * @return EstimatePayload
     */
    public function setWeight(float|int $weight): EstimatePayload
    {
        $this->weight = $weight;
        return $this;
    }

    /**
     * @param int $diameter
     * @return EstimatePayload
     */
    public function setDiameter(int $diameter): EstimatePayload
    {
        $this->diameter = $diameter;
        return $this;
    }

    /**
     * @param int $package
     * @return EstimatePayload
     */
    public function setPackage(int $package): EstimatePayload
    {
        $this->package = $package;
        return $this;
    }

    /**
     * @param float|int $declared_value
     * @return EstimatePayload
     */
    public function setDeclaredValue(float|int $declared_value): EstimatePayload
    {
        $this->declared_value = $declared_value;
        return $this;
    }

    /**
     * @param string $company
     * @return EstimatePayload
     */
    public function setCompany(string $company): EstimatePayload
    {
        $this->company = $company;
        return $this;
    }

    /**
     * @param string $password
     * @return EstimatePayload
     */
    public function setPassword(string $password): EstimatePayload
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param bool $own_hand
     * @return EstimatePayload
     */
    public function setOwnHand(bool $own_hand): EstimatePayload
    {
        $this->own_hand = $own_hand;
        return $this;
    }

    /**
     * @param bool $receiving_notice
     * @return EstimatePayload
     */
    public function setReceivingNotice(bool $receiving_notice): EstimatePayload
    {
        $this->receiving_notice = $receiving_notice;
        return $this;
    }

    private function height(): int
    {
        return match ($this->package) {
            PackageType::CAIXA => max($this->height, 2),
            PackageType::ROLO,
            PackageType::ENVELOPE => 0,
        };
    }

    private function length(): int
    {
        return match ($this->package) {
            PackageType::CAIXA,
            PackageType::ENVELOPE => max($this->length, 16),
            PackageType::ROLO => max($this->length, 18),
        };
    }

    private function width(): int
    {
        return match ($this->package) {
            PackageType::CAIXA,
            PackageType::ENVELOPE => max($this->width, 11),
            PackageType::ROLO => 0,
        };
    }

    private function diameter(): int
    {
        return match ($this->package) {
            PackageType::CAIXA,
            PackageType::ENVELOPE => 0,
            PackageType::ROLO => max($this->diameter, 5),
        };
    }

    public function getPath()
    {
        return '/calculador/CalcPrecoPrazo.asmx/CalcPrecoPrazoData';
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function build(string $service): array
    {
        return [
            'query' => [
                'nCdEmpresa' => $this->company,
                'sDsSenha' => $this->password,
                'sCepOrigem' => self::digits($this->origin),
                'sCepDestino' => self::digits($this->destination),
                'nCdServico' => $service,
                'nVlPeso' => $this->weight,
                'nCdFormato' => $this->package,
                'nVlComprimento' => $this->length(),
                'nVlAltura' => $this->height(),
                'nVlLargura' => $this->width(),
                'nVlDiametro' => $this->diameter(),
                'nVlValorDeclarado' => $this->declared_value,
                'sCdMaoPropria' => $this->own_hand ? 'S' : 'N',
                'sCdAvisoRecebimento' => $this->receiving_notice ? 'S' : 'N',
            ],
        ];
    }
}