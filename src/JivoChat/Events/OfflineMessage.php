<?php


namespace JivoChat\Events;


class OfflineMessage extends JivoChatEvent
{
    private string $offline_message_id;
    private string $message;

    /**
     * ChatAccepted constructor.
     *
     * @param array $json
     */
    public function __construct(array $json)
    {
        parent::__construct($json);
        $this->offline_message_id = $json['offline_message_id'];
        $this->message = $json['message'];
    }

    /**
     * @return mixed|string
     */
    public function getOfflineMessageId(): string
    {
        return $this->offline_message_id;
    }

    /**
     * @return mixed|string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}