<?php

namespace Sandertv\BlockSniper\events;

use pocketmine\event\Cancellable;
use pocketmine\event\plugin\PluginEvent;
use pocketmine\Player;
use Sandertv\BlockSniper\Loader;

class PresetCreationEvent extends PluginEvent implements Cancellable {
	
	public static $handlerList;
	
	private $player;
	private $presetData;
	
	public function __construct(Loader $plugin, Player $player, array $presetData) {
		parent::__construct($plugin);
		$this->player = $player;
		$this->presetData = $presetData;
	}
	
	/**
	 * Returns the player that created the preset.
	 *
	 * @return Player
	 */
	public function getPlayer(): Player {
		return $this->player;
	}
	
	/**
	 * Returns an array looking like this:
	 *  "name" => string,
	 *  "type" => string,
	 *  "decrement" => bool,
	 *  "perfect" => bool,
	 *  "size" => int,
	 *  "hollow" => bool,
	 *  "blocks" => array,
	 *  "obsolete" => array,
	 *  "height" => int,
	 *  "biome" => string|int
	 *
	 * @return array
	 */
	public function getPresetData(): array {
		return $this->presetData;
	}
}