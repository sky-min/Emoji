<?php
declare(strict_types = 1);

namespace skymin\emoji;

use pocketmine\plugin\PluginBase;
use skymin\emoji\exception\EmojiResourcePackException;

final class Loader extends PluginBase{

	private const uuid = 'eef1262f-003b-41bd-94f0-b0b61e34b1f6';
	private const version = '1.0.0';

	protected function onEnable() : void{
		$resourcepackManager = $this->getServer()->getResourcePackManager();
		if (!$resourcepackManager->resourcePacksRequired()) {
			throw new EmojiResourcePackException("'force_resources' must be set to 'true'");
		}
		$pack = $resourcepackManager->getPackById(self::uuid);
		if ($pack === null) {
			throw new EmojiResourcePackException("Resource pack 'Emoji Particle Resource Pack' not found");
		}
		if ($pack->getPackVersion() !== self::version) {
			throw new EmojiResourcePackException("'Emoji Particle Resource Pack' version did not match");
		}
	}

}