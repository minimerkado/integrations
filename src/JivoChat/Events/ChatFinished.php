<?php


namespace JivoChat\Events;


use Illuminate\Support\Arr;
use JivoChat\Http\Objects\Agent;
use JivoChat\Http\Objects\Chat;

class ChatFinished extends JivoChatEvent
{
    private int $chat_id;
    /** @var Agent[] */
    private array $agents = [];
    private Chat $chat;

    /**
     * ChatFinished constructor.
     *
     * @param array $json
     */
    public function __construct(array $json)
    {
        parent::__construct($json);

        $this->chat_id = $json['chat_id'];
        $this->chat = new Chat($json['chat']);
        foreach (Arr::get($json, 'agents', []) as $agent) {
            $this->agents[] = new Agent($agent);
        }
    }

    /**
     * @return int
     */
    public function getChatId(): int
    {
        return $this->chat_id;
    }

    /**
     * @return Agent[]
     */
    public function getAgents(): array
    {
        return $this->agents;
    }
}