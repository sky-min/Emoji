<?php
declare(strict_types = 1);

namespace skymin\emoji\command;

use skymin\emoji\Loader;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;

final class EmojiCmd extends Command implements PluginOwned{
	use PluginOwnedTrait;

	public function __construct(Loader $loader){
		parent::__construct('emoji');
		$this->setPermission('emoji.cmd');
		$this->owningPlugin = $loader;
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
		if($sender instanceof Player && $this->testPermission($sender)){
			
			return true;
		}
		return false;
	}

}