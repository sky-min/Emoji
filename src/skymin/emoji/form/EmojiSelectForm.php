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
			'button' => $buttons
		];
	}

}