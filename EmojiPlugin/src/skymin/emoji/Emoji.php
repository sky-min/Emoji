<?php
declare(strict_types = 1);

namespace skymin\emoji;

use pocketmine\Server;
use pocketmine\entity\Entity;
use pocketmine\network\mcpe\protocol\SpawnParticleEffectPacket;
use pocketmine\network\mcpe\protocol\types\DimensionIds;
use pocketmine\player\Player;

use skymin\emoji\exception\EmojiInvalidInputException;

final class Emoji{
	private array $emojiList;

	public function __construct(
		array $emojiList
	){
		foreach ($emojiList as $k => $v) {
			if (!isset($v["name"], $v["pos"])) {
				throw new EmojiInvalidInputException("$k must have valid inputs...");
			}
		}
		$this->emojiList = $emojiList;
	}

	public function getEmojiList() : array{
		return $this->emojiList;
	}

	public function sendEmoji(Entity $entity, string $emojiId) : void{
		if (!isset($this->emojiList[$emojiId])) {
			return;
		}
		[$x, $y] = $this->emojiList[$emojiId]["pos"];
		$particle_name = $this->emojiList["particle_name"] ?? "emoji:emoji";
		$viewers = $entity->getViewers();
		if($entity instanceof Player){
			$viewers[] = $entity;
		}
		Server::getInstance()->broadcastPackets($viewers, [SpawnParticleEffectPacket::create(
			DimensionIds::OVERWORLD,
			-1,
			$entity->getPosition()->add(0, $entity->getSize()->getHeight() + 1, 0),
			$particle_name,
			'[{"name":"variable.ix","value":{"type":"float","value":'. $x . '}},{"name":"variable.iy","value":{"type":"float","value":' . $y . '}}]'
		)]);
	}
}