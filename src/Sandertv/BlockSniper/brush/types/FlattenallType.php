<?php

namespace Sandertv\BlockSniper\brush\types;

use pocketmine\block\Block;
use pocketmine\block\Flowable;
use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\math\Vector3;
use pocketmine\Player;
use Sandertv\BlockSniper\brush\BaseType;
use Sandertv\BlockSniper\brush\BrushManager;
use Sandertv\BlockSniper\Loader;

class FlattenallType extends BaseType {
	
	/*
	 * Flattens the terrain below the selected point and removes the blocks above it within the brush radius.
	 */
	public function __construct(Loader $main, Player $player, Level $level, array $blocks = []) {
		parent::__construct($main);
		$this->level = $level;
		$this->blocks = $blocks;
		$this->center = $player->getTargetBlock(100);
		$this->player = $player;
	}
	
	/**
	 * @return bool
	 */
	public function fillShape(): bool {
		$undoBlocks = [];
		foreach($this->blocks as $block) {
			$randomBlock = BrushManager::get($this->player)->getBlocks()[array_rand(BrushManager::get($this->player)->getBlocks())];
			if(($block->getId() === Item::AIR || $block instanceof Flowable) && $block->y <= $this->center->y) {
				if($block->getId() !== $randomBlock->getId()) {
					$undoBlocks[] = $block;
				}
				$this->level->setBlock(new Vector3($block->x, $block->y, $block->z), $randomBlock, false, false);
			}
			if($block->getId() !== Item::AIR && $block->y > $this->center->y) {
				$undoBlocks[] = $block;
				$this->level->setBlock($block, Block::get(Block::AIR));
			}
		}
		$this->getMain()->getUndoStore()->saveUndo($undoBlocks, $this->player);
		return true;
	}
	
	public function getName(): string {
		return "Flatten All";
	}
	
	public function getPermission(): string {
		return "blocksniper.type.flattenall";
	}
}
