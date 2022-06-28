<?php
declare(strict_types = 1);

namespace skymin\emoji;

use skymin\data\Data;
use skymin\emoji\command\EmojiCmd;
use skymin\emoji\exception\EmojiResourcePackException;

use pocketmine\plugin\PluginBase;

final class Loader extends PluginBase{
	private static Loader $instance;

	private const uuid = 'eef1262f-003b-41bd-94f0-b0b61e34b1f6';
	private const version = '1.0.0';

	private Emoji $emoji;

	public function onLoad() : void{
		self::$instance = $this;
	}

	public static function getInstance() : self{
		return self::$instance;
	}

	protected function onEnable() : void{
		foreach ($this->getResources() as $resource) {
			$this->saveResource($resource->getFilename());
		}
		$this->emoji = new Emoji((new Data($this->getDataFolder() . "emoji.json"))->getAll());

		$server = $this->getServer();
		$resourcepackManager = $server->getResourcePackManager();
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
		$server->getCommandMap()->register('emoji', new EmojiCmd($this));
	}

	public function getEmoji() : Emoji{
		return $this->emoji;
	}

}