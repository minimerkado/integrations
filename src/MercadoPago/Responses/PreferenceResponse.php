<?php


namespace MercadoPago\Responses;


use Carbon\Carbon;
use Common\Response;

class PreferenceResponse implements Response
{
    private string $id;
    private string $init_point;
    private string $sandbox_init_point;
    private Carbon $date_created;

    public function __construct(string $body)
    {
        $this->parse($body);
    }

    public function parse(string $body)
    {
        $json = json_decode($body);
        $this->id = $json->id;
        $this->init_point = $json->init_point;
        $this->sandbox_init_point = $json->sandbox_init_point;
        $this->date_created = Carbon::parse($json->date_created);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getInitPoint(): string
    {
        return $this->init_point;
    }

    /**
     * @return string
     */
    public function getSandboxInitPoint(): string
    {
        return $this->sandbox_init_point;
    }

    /**
     * @return Carbon
     */
    public function getDateCreated(): Carbon
    {
        return $this->date_created;
    }
}