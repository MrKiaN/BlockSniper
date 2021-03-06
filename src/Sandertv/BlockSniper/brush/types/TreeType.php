<?php

namespace Sandertv\BlockSniper\brush\types;

use pocketmine\block\Block;
use pocketmine\block\Flowable;
use pocketmine\level\generator\object\Tree;
use pocketmine\level\Level;
use pocketmine\Player;
use pocketmine\utils\Random;
use Sandertv\BlockSniper\brush\BaseType;
use Sandertv\BlockSniper\brush\BrushManager;
use Sandertv\BlockSniper\Loader;

class TreeType extends BaseType {
	
	/*
	 * Grows a tree on the target block. This brush can not undo.
	 */
	public function __construct(Loader $main, Player $player, Level $level, array $blocks) {
		parent::__construct($main);
		$this->level = $level;
		$this->blocks = $blocks;
		$this->player = $player;
		$this->center = $player->getTargetBlock(100);
		$this->tree = BrushManager::get($player)->getTreeType();
	}
	
	/**
	 * @return bool
	 */
	public function fillShape(): bool {
		if(!$this->level->getBlock($this->center) instanceof Flowable && !$this->level->getBlock($this->center)->getId() === Block::AIR) {
			$this->center->y++;
		}
		Tree::growTree($this->level, $this->center->x, $this->center->y, $this->center->z, new Random(mt_rand()), $this->tree);
		return true;
	}
	
	public function getName(): string {
		return "Tree";
	}
	
	public function getPermission(): string {
		return "blocksniper.type.tree";
	}
}