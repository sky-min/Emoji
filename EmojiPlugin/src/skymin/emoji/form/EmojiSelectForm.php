<?php
declare(strict_types = 1);

namespace skymin\emoji\form;

use skymin\emoji\Emoji;

use pocketmine\form\Form;
use pocketmine\player\Player;

final class EmojiSelectForm implements Form{

	public function jsonSerialize() : array{
		$buttons = [];
		foreach(Emoji::EMOJI_LIST as $name){
			$buttons[] = ['text' => $name];
		}
		return [
			'type' => 'form',
			'title' => 'EMOJI',
			'content' => 'Choose the emoji you want',
			'buttons' => $buttons
		];
	}

	public function handleResponse(Player $player, $data) : void{
		if($data === null) return;
		Emoji::sendEmoji($player, Emoji::EMOJI_LIST[$data]);
	}

}