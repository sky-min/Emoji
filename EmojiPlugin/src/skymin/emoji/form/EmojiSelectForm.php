<?php
declare(strict_types = 1);

namespace skymin\emoji\form;

use pocketmine\form\Form;
use pocketmine\player\Player;

use skymin\emoji\Emoji;

final class EmojiSelectForm implements Form{

	private static ?array $buttons = null;

	private static ?array $dataToId = null;

	public function __construct(){
		if(self::$buttons === null || self::$dataToId === null){
			$buttons = [];
			$dataToId = [];
			$emojiList = Emoji::getInstance()->getEmojiList();
			foreach($emojiList as $key => $name){
				$buttons[] = ['text' => $name];
				$dataToId[] = $key;
			}
			self::$buttons = $buttons;
			self::$dataToId = $dataToId;
		}
	}

	public function jsonSerialize() : array{
		return [
			'type' => 'form',
			'title' => 'EMOJI',
			'content' => 'Choose the emoji you want',
			'buttons' => self::$buttons
		];
	}

	public function handleResponse(Player $player, $data) : void{
		if($data === null){
			return;
		}
		$emoji = Emoji::getInstance();
		$emoji->sendEmoji($player, self::$dataToId[$data]);
	}

}
