<?php


namespace JivoChat\Events;


use JivoChat\Http\Objects\Agent;

class ChatAssigned extends JivoChatEvent
{
    private int $chat_id;
    private Agent $agent;
    private string $assign_to;

    /**
     * ChatAssigned constructor.
     *
     * @param array $json
     */
    public function __construct(array $json)
    {
        parent::__construct($json);
        $this->chat_id = $json['chat_id'];
        $this->agent = new Agent($json['agent']);
        $this->assign_to = $json['assign_to'];
    }

    /**
     * @return int|mixed
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

    /**
     * @return string
     */
    public function getAssignTo(): string
    {
        return $this->assign_to;
    }
}