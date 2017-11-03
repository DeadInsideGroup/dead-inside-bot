<?php

namespace LINE\Bot\Bot;

use LINE;

trait CommandRoutes
{
	private function writeRoutes()
	{
		$st = explode(" ", $this->b->text, 2);
		
		$this->route(function() use ($st){
			return $st[0] === "/google";
		}, function() {
			$st = new \Plugins\GoogleSearch\GoogleSearch($a[1]);
			$st = $st->exec();
			LINE::push(
				[
					"to" => $this->b->chat_id,
					"messages" => [
						[
							"type" => "text",
							"text" => $st
						]
					]
				]
			);
		});
	}
}