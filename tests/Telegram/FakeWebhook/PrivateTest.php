<?php

namespace tests\Telegram\FakeWebhook;

include_once BASEPATH."/config/telegram.php";

use Telegram\Bot\Bot;
use PHPUnit\Framework\TestCase;

class PrivateTest extends TestCase
{

    /**
     * Test webhook 1
     */
    public function testFakeWebhook()
    {
        $json = json_encode(
            [
                "update_id" => rand(10000000, 99999999),
                "message" => [
                    "message_id" => rand(1, 100),
                    "from" => [
                        "id"            => 243692601,
                        "is_bot"        => false,
                        "first_name"    => "Ammar",
                        "last_name"     => "Faizi",
                        "username"      => "ammarfaizi2",
                        "language_code"     => "en-US"
                    ],
                    "chat" => [
                        "id"        => -1001134449138,
                        "first_name"=> "Ammar",
                        "last_name"     => "F.",
                        "username"  => "ammarfaizi2",
                        "type"      => "private"
                    ],
                    "date" => time(),
                    "text" => "ping"
                ]
            ]
        );

        try {
            $app = new Bot($json);
            $app->run();
            $action = true;
        } catch (\Error $e) {
            var_dump($e->getMessage());
            $action = false;
        } catch (\PDOException $e) {
            $action = true;
        }
        $this->assertTrue($action);
    }
}

/*
 JSON Sample
{
    "update_id": 344377241,
    "message": {
        "message_id": 25359,
        "from": {
            "id": 243692601,
            "is_bot": false,
            "first_name": "Ammar",
            "last_name": "F.",
            "username": "ammarfaizi2",
            "language_code": "en-US"
        },
        "chat": {
            "id": 243692601,
            "first_name": "Ammar",
            "last_name": "F.",
            "username": "ammarfaizi2",
            "type": "private"
        },
        "date": 1509704405,
        "text": "zxc"
    }
}
*/
