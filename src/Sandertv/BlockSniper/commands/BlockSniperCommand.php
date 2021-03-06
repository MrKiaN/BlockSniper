<?php

namespace Sandertv\BlockSniper\commands;

use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;
use Sandertv\BlockSniper\Loader;

class BlockSniperCommand extends BaseCommand {
	
	public function __construct(Loader $owner) {
		parent::__construct($owner, "blocksniper", "Get information or change things related to BlockSniper", "[language|reload] [lang]", ["bs"]);
		$this->setPermission("blocksniper.command.blocksniper");
	}
	
	public function execute(CommandSender $sender, $commandLabel, array $args) {
		if(!$this->testPermission($sender)) {
			$this->sendNoPermission($sender);
		}
		
		if(!isset($args[0])) {
			$sender->sendMessage(TF::AQUA . "[BlockSniper] Information\n" .
				TF::GREEN . "Version: " . TF::YELLOW . Loader::VERSION . "\n" .
				TF::GREEN . "Target API: " . TF::YELLOW . Loader::API_TARGET . "\n" .
				TF::GREEN . "Author: " . TF::YELLOW . "Sandertv");
			return true;
		}
		
		switch(strtolower($args[0])) {
			case "language":
				if(!in_array(strtolower($args[1]), $this->getPlugin()->availableLanguages)) {
					$sender->sendMessage(TF::RED . "That language doesn't exist. Please try again.");
					return true;
				}
				$this->getSettings()->set("Message-Language", $args[1]);
				$sender->sendMessage(TF::GREEN . $this->getPlugin()->getTranslation("commands.succeed.language"));
				return true;
			
			case "reload":
				$sender->sendMessage(TF::GREEN . "Reloading...");
				$this->getPlugin()->reloadAll();
				return true;
			
			default:
				$sender->sendMessage(TF::AQUA . "[BlockSniper] Information\n" .
					TF::GREEN . "Version: " . TF::YELLOW . Loader::VERSION . "\n" .
					TF::GREEN . "Target API: " . TF::YELLOW . Loader::API_TARGET . "\n" .
					TF::GREEN . "Author: " . TF::YELLOW . "Sandertv");
				return true;
		}
	}
}
