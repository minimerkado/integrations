<?php


namespace PagSeguro\Http\Objects;


use Common\XmlDecodable;

class PaymentMethod implements XmlDecodable
{
    const CARTAO_CREDITO = 1;
    const BOLETO         = 2;
    const DEBITO_ONLINE  = 3;
    const PAG_SEGURO     = 4;
    const OI_PAGGO       = 5;
    const DEPOSITO_CONTA = 7;

    private int $type;
    private int $code;

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return PaymentMethod
     */
    public function setType(int $type): PaymentMethod
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     * @return PaymentMethod
     */
    public function setCode(int $code): PaymentMethod
    {
        $this->code = $code;
        return $this;
    }

    public function decode(\SimpleXMLElement $root): PaymentMethod
    {
        $this->type = (int) $root->type;
        $this->code = (int) $root->code;

        return $this;
    }
}