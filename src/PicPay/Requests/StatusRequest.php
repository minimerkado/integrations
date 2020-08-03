<?php


namespace PicPay\Requests;


use Common\Request;
use Common\Utilities;

class StatusRequest implements Request
{
    use Utilities;
    private string $token;
    private string $referenceId;

    /**
     * Construtor da requisição de status do pedido.
     *
     * @param string $token token do usuário
     * @param string $referenceId id do pedido
     */
    public function __construct(string $token, string $referenceId)
    {
        $this->token = $token;
        $this->referenceId = $referenceId;
    }

    public function getMethod()
    {
        return 'GET';
    }

    public function getPath()
    {
        return "/payments/$this->referenceId/status";
    }

    public function build(): array
    {
        return [
            'headers' => [
                'x-picpay-token' => $this->token,
            ],
        ];
    }
}