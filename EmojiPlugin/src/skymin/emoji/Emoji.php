<?php
declare(strict_types = 1);

namespace skymin\emoji;

use pocketmine\Server;
use pocketmine\entity\Entity;
use pocketmine\network\mcpe\protocol\SpawnParticleEffectPacket;
use pocketmine\network\mcpe\protocol\types\DimensionIds;
use pocketmine\player\Player;

final class Emoji{
	private array $emojiList;

	private const EMOJI_POS = [
		'smiley' => [0, 0],
		'grimacing' => [0.01, 0],
		'grin' => [0.02, 0],
		'joy' => [0.03, 0],
		'smile' => [0.04, 0],
		'sweat_smile' => [0.05, 0],
		'laughing' => [0.06, 0],
		'innocent' => [0.07, 0],
		'wink' => [0, 0.01],
		'blush' => [0.01, 0.01],
		'slight_smile' => [0.02, 0.01],
		'upside_down' => [0.03, 0.01],
		'relaxed' => [0.04, 0.01],
		'yum' => [0.05, 0.01],
		'relieved' => [0.06, 0.01],
		'heart_eyes' => [0.07, 0.01],
		'kissing_heart' => [0, 0.02],
		'kissing' => [0.01, 0.02],
		'kissing_smiling_eyes' => [0.02, 0.02],
		'kissing_closed_eyes' => [0.03, 0.02],
		'stuck_out_tongue_winking_eye' => [0.04, 0.02],
		'stuck_out_tongue_closed_eyes' => [0.05, 0.02],
		'stuck_out_tongue' => [0.06, 0.02],
		'money_mouth' => [0.07, 0.02],
		'sunglasses' => [0, 0.03],
		'smirk' => [0.01, 0.03],
		'no_mouth' => [0.02, 0.03],
		'neutral_face' => [0.03, 0.03],
		'expressionless' => [0.04, 0.03],
		'unamused' => [0.05, 0.03],
		'rolling_eyes' => [0.06, 0.03],
		'flushed' => [0.07, 0.03],
		'disappointed' => [0, 0.04],
		'worried' => [0.01, 0.04],
		'angry' => [0.02, 0.04],
		'rage' => [0.03, 0.04],
		'pensive' => [0.04, 0.04],
		'confused' => [0.05, 0.04],
		'slight_frown' => [0.06, 0.04],
		'frowning2' => [0.07, 0.04]
	];

	public function __construct(
		array $emojiList
	){
		foreach (array_keys(self::EMOJI_POS) as $id) {
			$this->emojiList[$id] = $emojiList[$id] ?? $id; // Get the name of the emoji, otherwise get the key as the name
		}
	}

	public function getEmojiList() : array{
		return $this->emojiList;
	}

	public function sendEmoji(Entity $entity, string $emojiId) : void{
		if (!isset(self::EMOJI_POS[$emojiId])) {
			return;
		}
		[$x, $y] = self::EMOJI_POS[$emojiId];
		$viewers = $entity->getViewers();
		if($entity instanceof Player){
			$viewers[] = $entity;
		}
		Server::getInstance()->broadcastPackets($viewers, [SpawnParticleEffectPacket::create(
			DimensionIds::OVERWORLD,
			-1,
			$entity->getPosition()->add(0, $entity->getSize()->getHeight() + 1, 0),
			"emoji:emoji",
			'[{"name":"variable.ix","value":{"type":"float","value":'. $x . '}},{"name":"variable.iy","value":{"type":"float","value":' . $y . '}}]'
		)]);
	}
}