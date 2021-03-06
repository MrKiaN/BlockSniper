<?php

namespace Sandertv\BlockSniper\events;

use pocketmine\event\Cancellable;
use pocketmine\event\plugin\PluginEvent;
use Sandertv\BlockSniper\brush\Brush;
use Sandertv\BlockSniper\Loader;

class BrushRecoverEvent extends PluginEvent implements Cancellable {
	
	public static $handlerList;
	
	public $player;
	public $brush;
	
	public function __construct(Loader $plugin, string $player, Brush $brush) {
		parent::__construct($plugin);
		$this->player = $player;
		$this->brush = $brush;
	}
	
	/**
	 * Returns the brush (object) that's being recovered.
	 *
	 * @return Brush
	 */
	public function getBrush(): Brush {
		return $this->brush;
	}
	
	/**
	 * Returns the player name of whom's brush is being recovered.
	 * Warning: The player with this name is highly likely not online!
	 *
	 * @return string
	 */
	public function getPlayer(): string {
		return $this->player;
	}
}