<?php


namespace JivoChat\Events;


use Illuminate\Foundation\Events\Dispatchable;
use JivoChat\Http\Objects\Page;
use JivoChat\Http\Objects\Visitor;

abstract class JivoChatEvent
{
    use Dispatchable;

    protected string $event_name;
    protected string $widget_id;
    protected Visitor $visitor;
    protected Page $page;

    public function __construct(array $json)
    {
        $this->event_name = $json['event_name'];
        $this->widget_id = $json['widget_id'];
        $this->visitor = new Visitor($json['visitor']);
        $this->page = new Page($json['page']);
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->event_name;
    }

    /**
     * @return string
     */
    public function getWidgetId(): string
    {
        return $this->widget_id;
    }

    /**
     * @return Visitor
     */
    public function getVisitor(): Visitor
    {
        return $this->visitor;
    }

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }
}