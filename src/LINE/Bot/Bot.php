<?php

namespace LINE\Bot;

use LINE;
use LINE\Bot\Response;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
final class Bot
{

    /**
     * @var array
     */
    private $fullinput = [];

    /**
     * @var array
     */
    public $input = [];

    /**
     * @var string
     */
    public $chattype;

    /**
     * @var string
     */
    public $replytoken;

    /**
     * @var string
     */
    public $userid;

    /**
     * @var string
     */
    public $group_id;

    /**
     * @var int
     */
    public $timestamp;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $lowertext;

    /**
     * @var string
     */
    public $msgid;

    /**
     * @var string
     */
    public $msgtype;

    /**
     * @param string $data
     */
    public function __construct($data)
    {
        $this->fullinput = json_decode($data, true);
    }

    public function run()
    {
        foreach ($this->fullinput['events'] as $val) {
            $this->buildContext($val);
            $this->_run();
        }
    }
    private function buildContext($val)
    {
        if ($val['type'] === "message") {
            $this->input = $val;
            $this->chattype = isset($val['source']['groupId']) ? "group" : "private";
            $this->chat_id = isset($val['source']['groupId']) ? $val['source']['groupId'] : $val['source']['userId'];
            if (isset($val['message']['text'])) {
                $this->msgtype  = "text";
                $this->replytoken = $val['replyToken'];
                $this->userid    = $val['source']['userId'];
                $this->group_id    = isset($val['source']['groupId']) ? $val['source']['groupId'] : null;
                $this->timestamp = $val['timestamp'];
                $this->text = $val['message']['text'];
                $this->lowertext = strtolower($this->text);
                $this->msgid = $val['message']['id'];
            } elseif (isset($val['message']['type'])) {
                if ($val['message']['type'] === "image") {
                    $this->msgtype  = "photo";
                    $this->replytoken = $val['replyToken'];
                    $this->userid    = $val['source']['userId'];
                    $this->group_id    = isset($val['source']['groupId']) ? $val['source']['groupId'] : null;
                    $this->timestamp = $val['timestamp'];
                    $this->msgid = $val['message']['id'];
                }
            }
        }
    }

    private function _run()
    {
        if (in_array($this->msgtype, ["text", "photo"])) {
            $st = new Response($this);
            $st->run();
        }
    }
}
