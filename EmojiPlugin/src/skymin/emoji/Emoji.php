<?php
declare(strict_types = 1);

namespace skymin\emoji;

use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\network\mcpe\protocol\SpawnParticleEffectPacket;
use pocketmine\network\mcpe\protocol\types\DimensionIds;

final class Emoji{

	public const EMOJI_LIST = [
		'smiley', 'grimacing', 'grin', 'joy', 'smile', 'sweat_smile', 'laughing', 'innocent',
		'wink', 'blush', 'slight_smile', 'upside_down', 'relaxed', 'yum', 'relieved', 'heart_eyes',
		'kissing_heart', 'kissing', 'kissing_smiling_eyes', 'kissing_closed_eyes', 'stuck_out_tongue_winking_eye', 'stuck_out_tongue_closed_eyes', 'stuck_out_tongue', 'money_mouth',
		'sunglasses', 'smirk', 'no_mouth', 'neutral_face', 'expressionless', 'unamused', 'rolling_eyes', 'flushed',
		'disappointed', 'worried', 'angry', 'rage', 'pensive', 'confused', 'slight_frown', 'frowning2'
	];

	public const EMOJI_POS = [
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

	public static function sendEmoji(Player $player, string $emojiId) : void{
		[$x, $y] = self::EMOJI_POS[$emojiId];
		$viwers = $player->getViewers();
		$viwers[] = $player;
		Server::getInstance()->broadcastPackets($viwers, [SpawnParticleEffectPacket::create(
			DimensionIds::OVERWORLD,
			-1,
			$player->getPosition()->add(0, $player->getSize()->getHeight() + 1, 0),
			'emoji:emoji',
			'[{"name":"variable.ix","value":{"type":"float","value":'. $x . '}},{"name":"variable.iy","value":{"type":"float","value":' . $y . '}}]'
		)]);
	}

}