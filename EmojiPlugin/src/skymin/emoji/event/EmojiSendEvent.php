<?php
declare(strict_types = 1);

namespace skymin\emoji\event;

use pocketmine\entity\Entity;
use pocketmine\event\Event;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\player\Player;

final class EmojiSendEvent extends Event implements Cancellable{
	use CancellableTrait;

	/** @param Player[] $viewer */
	public function __construct(
		private Entity $sender,
		private array $viewers,
		private string $emojiId
	){}

	public function getSender() : Entity{
		return $this->sender;
	}

	public function getViewers() : string{
		return $this->viewers;
	}

	public function getEmojiId() : string{
		return $this->emojiId;
	}

	public function setEmojiId(string $id) : void{
		$this->emojiId = $id;
	}

}