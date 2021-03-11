<?php


namespace JivoChat\Events;


use JivoChat\Http\Objects\Agent;
use JivoChat\Http\Objects\Call;

class CallEvent extends JivoChatEvent
{
    private Agent $agent;
    private Call $call;

    public function __construct(array $json)
    {
        parent::__construct($json);
        $this->agent = new Agent($json['agent']);
        $this->call = new Call($json['call']);
    }

    /**
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }

    /**
     * @return Call
     */
    public function getCall(): Call
    {
        return $this->call;
    }
}