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
}