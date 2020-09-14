<?php


namespace PagSeguro\Http;


use Common\Request;

abstract class PagSeguroRequest implements Request
{
    protected $email;
    protected $token;

    /**
     * PagSeguroRequest constructor.
     * @param $email
     * @param $token
     */
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }

    public function build(): array
    {
        $this->encode($this->getRootElement());

        return [
            'query' => [
                'email' => $this->email,
                'token' => $this->token,
            ],
            'body' => $root->asXML(),
        ];
    }
}