<?php


namespace JivoChat\Events;


use JivoChat\Http\Objects\Agent;

class ChatAccepted extends JivoChatEvent
{
    private int $chat_id;
    private Agent $agent;

    /**
     * ChatAccepted constructor.
     *
     * @param array $json
     */
    public function __construct(array $json)
    {
        parent::__construct($json);
        $this->chat_id = $json['chat_id'];
        $this->agent = new Agent($json['agent']);
    }

    /**
     * @return int
     */
    public function getChatId(): int
    {
        return $this->chat_id;
    }

    /**
     * @return Agent
     */
    public function getAgent(): Agent
    {
        return $this->agent;
    }
}