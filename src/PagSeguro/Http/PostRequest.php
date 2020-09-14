<?php


namespace PagSeguro\Http;


use Common\XmlEncodable;

abstract class PostRequest extends PagSeguroRequest implements XmlEncodable
{
    public abstract function getRootElement();

    public function getMethod()
    {
        return 'POST';
    }

    public function build(): array
    {
        $root = $this->getRootElement();
        $this->encode($root);

        return [
            'query' => [
                'email' => $this->email,
                'token' => $this->token,
            ],
            'body' => $root->asXML(),
        ];
    }
}