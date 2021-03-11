<?php


namespace JivoChat\Events;


use Illuminate\Http\Request;

abstract class JivoChatEventDispatcher
{
    const CALL_EVENT = 'call_event';
    const CHAT_ACCEPTED = 'chat_accepted';
    const CHAT_ASSIGNED = 'chat_assigned';
    const CHAT_FINISHED = 'chat_finished';
    const CHAT_UPDATED  = 'chat_updated';
    const OFFLINE_MESSAGE = 'offline_message';

    public static function dispatch(Request $request)
    {
        if (!($json = $request->json())) {
            return;
        }

        $event_name = $json['event_name'];

        switch ($event_name) {
            case self::CALL_EVENT:
                CallEvent::dispatch($json);
                break;
            case self::CHAT_ACCEPTED:
                ChatAccepted::dispatch($json);
                break;
            case self::CHAT_ASSIGNED:
                ChatAssigned::dispatch($json);
                break;
            case self::CHAT_FINISHED:
                ChatFinished::dispatch($json);
                break;
            case self::CHAT_UPDATED:
                ChatUpdated::dispatch($json);
                break;
            case self::OFFLINE_MESSAGE:
                OfflineMessage::dispatch($json);
                break;
            default:
                break;
        }
    }
}