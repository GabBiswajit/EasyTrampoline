<?php

namespace GamerMJay\Trampoline;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\world\Level;
use pocketmine\world\Position;
use pocketmine\world\particle\Particle;
use pocketmine\world\particle\HappyVillagerParticle;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;
use pocketmine\player\Player;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\Server;
use pocketmine\math\Vector3;
use pocketmine\block\Block;

class Main extends PluginBase implements Listener {
	
	public function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this ,$this);
		$this->saveDefaultConfig();
		$this->config = $this->getConfig();
	}
	
	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
        $x = $player->getLocation()->getX();
        $y = $player->getLocation()->getY();
        $z = $player->getLocation()->getZ();
		$world = $player->getworld();
        $block = $world->getBlock($player->getPosition()->getSide(0));
		if($block->getTypeId() = BlockTypeIds::SLIME){
			$direction = $player->getDirectionVector();
            $dx = $direction->getX();
            $dz = $direction->getZ();
			$dy = $direction->getY();
			if($this->config->get("Particle") === "true"){
                $world->addParticle(new Vector3($x - 0.3, $y, $z), new HappyVillagerParticle);
                $world->addParticle(new Vector3($x, $y, $z - 0.3), new HappyVillagerParticle);
                $world->addParticle(new Vector3($x + 0.3, $y, $z), new HappyVillagerParticle);
                $world->addParticle(new Vector3($x, $y, $z + 0.3), new HappyVillagerParticle);
			}
			$player->setMotion(new Vector3(0, $this->config->get('Power'), 0));
		}
	}
}
