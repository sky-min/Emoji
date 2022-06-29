<?php
declare(strict_types = 1);

namespace skymin\emoji\form;

use pocketmine\form\Form;
use pocketmine\player\Player;

use skymin\emoji\Loader;

final class EmojiSelectForm implements Form{

	public function jsonSerialize() : array{
		$buttons = [];
		$emojiList = Loader::getInstance()->getEmoji()->getEmojiList();
		foreach($emojiList as $name){
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
		if($data === null) {
			return;
		}
		$emoji = Loader::getInstance()->getEmoji();
		$emoji->sendEmoji($player, array_keys($emoji->getEmojiList())[$data]);
	}

}
