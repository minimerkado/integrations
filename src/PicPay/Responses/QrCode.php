<?php


namespace PicPay\Responses;

class QrCode
{
    private string $content;
    private string $base64;

    /**
     * QrCode constructor.
     * @param string $content
     * @param string $base64
     */
    public function __construct(string $content, string $base64)
    {
        $this->content = $content;
        $this->base64 = $base64;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getBase64(): string
    {
        return $this->base64;
    }
}