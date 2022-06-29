<?php
declare(strict_types = 1);

namespace skymin\emoji;

use pocketmine\plugin\PluginBase;
use pocketmine\resourcepacks\ResourcePack;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\utils\AssumptionFailedError;
use pocketmine\utils\SingletonTrait;

use skymin\data\Data;
use skymin\emoji\command\EmojiCmd;
use skymin\emoji\exception\EmojiResourcePackException;

final class Loader extends PluginBase{
	use SingletonTrait;

	private const uuid = 'eef1262f-003b-41bd-94f0-b0b61e34b1f6';
	private const version = '1.0.0';
	private const pack_name = "EmojiParticle.mcpack";

	private Emoji $emoji;

	public function onLoad() : void{
		self::setInstance($this);
		$this->saveResource("emoji.yml");

		$rp_path = $this->getServer()->getDataPath() . "resource_packs/";

		// Copy the pack to the resource packs folder
		if (!file_exists($rp_path . self::pack_name)) {
			$resource = $this->getResource(self::pack_name);
			if ($resource !== null) {
				$fp = fopen($rp_path . self::pack_name, "wb");
				if($fp === false) {
					throw new AssumptionFailedError("fopen() should not fail with wb flags");
				}
				stream_copy_to_stream($resource, $fp);
				fclose($fp);
				fclose($resource);
			}
		}

		$resourcepackManager = $this->getServer()->getResourcePackManager();
		$data = new Data($rp_path . "resource_packs.yml");
		$pack = $resourcepackManager->getPackById(self::uuid);

		if ($pack === null) {
			$pack = new ZippedResourcePack($rp_path . self::pack_name);
			(function(ResourcePack $pack) {
				$this->resourcePacks[] = $pack;
				$this->uuidList[strtolower($pack->getPackId())] = $pack;
			})->call($resourcepackManager, $pack);

			$rpstack = $data->__get("resource_stack");
			$rpstack[] = basename(self::pack_name);
			$data->__set("resource_stack", $rpstack);
		}

		if (!$resourcepackManager->resourcePacksRequired()) {
			(function() {
				$this->serverForceResources = true;
			})->call($resourcepackManager);
			$data->__set("force_resources", true);
		}
		$data->save();

		if ($pack->getPackVersion() !== self::version) {
			throw new EmojiResourcePackException("'Emoji Particle Resource Pack' version did not match");
		}
	}

	protected function onEnable() : void{
		$this->saveResource("emoji.yml");
		$this->emoji = new Emoji((new Data($this->getDataFolder() . "emoji.yml"))->getAll());
		$this->getServer()->getCommandMap()->register('emoji', new EmojiCmd($this));
	}

	public function getEmoji() : Emoji{
		return $this->emoji;
	}
}