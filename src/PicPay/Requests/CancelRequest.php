<?php


namespace PicPay\Requests;


use Common\Request;
use Common\Utilities;

class CancelRequest implements Request
{
    use Utilities;
    private string $token;
    private string $referenceId;
    private ?string $authorizationId = null;

    /**
     * StatusRequest constructor.
     * @param string $token token gerado e fornecido pelo PicPay
     * @param string $referenceId id do pedido
     */
    public function __construct(string $token, string $referenceId)
    {
        $this->token = $token;
        $this->referenceId = $referenceId;
    }

    /**
     * Id da autorização que seu e-commerce recebeu na notificação de pedido pago. Caso o pedido não esteja pago,
     * não é necessário enviar este parâmetro.
     *
     * @param string|null $authorizationId Id da autorização
     * @return CancelRequest
     */
    public function setAuthorizationId(?string $authorizationId): CancelRequest
    {
        $this->authorizationId = $authorizationId;
        return $this;
    }

    public function getMethod()
    {
        return 'POST';
    }

    public function getPath()
    {
        return "/payments/$this->referenceId/cancellations";
    }

    public function build(): array
    {
        return array_merge(
            [
                'headers' => [
                    'x-picpay-token' => $this->token,
                ],
            ],
            self::when($this->authorizationId, fn ($value) => [
                'json' => [
                    'authorizationId' => $value
                ],
            ], [])
        );
    }
}