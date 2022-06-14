<?php
declare(strict_types = 1);

namespace skymin\emoji;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\network\mcpe\protocol\SpawnParticleEffectPacket;
use pocketmine\network\mcpe\protocol\types\DimensionIds;

final class Emoji{

	public const EMOJI_LIST = [
		'smiley', 'wink', 'kissing_heart', 'sunglasses', 'disappointed',
		'grimacing', 'blush', 'kissing', 'smirk', 'worried',
		'grin', 'slight_smile', 'kissing_smile', 'no_mouth', 'angry',
		'joy', 'upside_down', 'kissing_closed', 'neutral_facd', 'rage'
	];

	public const EMOJI_POS = [
		'smiley' => [0, 0],
		'wink' => [0, 1],
		'kissing_heart' => [0, 2],
		'sunglasses' => [0, 3],
		'disappointed' => [0, 4],
		'grimacing' => [1, 0],
		'blush' => [1, 2],
		'kissing' => [1, 3],
		'smirk' => [1, 3],
		'worried' => [1, 4],
		'grin' => [2, 0],
		'slight_smile' => [2, 1],
		'kissing_smile' => [2, 2],
		'no_mouth' => [2, 3],
		'angry' => [2, 4],
		'joy' => [3, 0],
		'upside_down' => [3, 1],
		'kissing_closed' => [3, 2],
		'neutral_facd' => [3, 3],
		'rage' => [3, 4],
	];

	public static function sendEmoji(Player $player, string $emojiId) : void{
		$emojiPos = self::EMOJI_POS[$emojiId];
		Server::getInstance()->broadcastPacket($player->getViewers(), SpawnParticleEffectPacket::create(
			DimensionIds::OVERWORLD,
			-1,
			$player->getPosition()->add(0, $player->getSize()->getHeight() + 0.8, 0),
			'emoji:emoji',
			'[{"name":"variable.ix","value":' . $emojiPos[0] . '},{"name":"variable.iy","value":' . $emojiPos[1] . '}]'
		))
	}

}