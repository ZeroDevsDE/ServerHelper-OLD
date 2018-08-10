<?php

namespace ServerHelper;

use pocketmine\plugin\PluginBase;

class ServerHelper extends PluginBase{
	public function onEnable(){
		$this->getLogger()->info("Server-Helper was activated!");
	}
}