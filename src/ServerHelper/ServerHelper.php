<?php

#╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗
#║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║
#║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗
#║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║
#║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║
#╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝

namespace ServerHelper;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as SH;
use ServerHelper\commands\HealCommand;
use ServerHelper\commands\FeedCommand;
use ServerHelper\commands\FlyCommand;
use ServerHelper\commands\BroadcastCommand;
use ServerHelper\commands\TestCommand;
use ServerHelper\commands\MeCommand;
use ServerHelper\commands\ShhelpCommand;
use ServerHelper\commands\NickCommand;
use ServerHelper\commands\NickOffCommand;
use ServerHelper\commands\VanishCommand;
use ServerHelper\commands\VanishOffCommand;

class ServerHelper extends PluginBase{
	public function onEnable(){
		$this->Banner();
		$this->CommandLoader();
		$this->getLogger()->info(SH::GOLD . "Server-Helper was activated!");
	}
	
	public function onDisable(){
		$this->Banner();
		$this->getLogger()->info("Server-Helper was stopped!");
	}
	
	private function Banner(){
		$banner = strval(
		"\n".
        	"╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗\n".
		"║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║\n".
		"║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗\n".
		"║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║\n".
		"║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║\n".
		"╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝"
		);
		$this->getLogger()->info($banner);
	}
	private function CommandLoader(){
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new HealCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new FeedCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new FlyCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new BroadcastCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new TestCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new MeCommand()]);
        	$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new ShhelpCommand()]);
        	$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new NickCommand()]);
        	$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new NickOffCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new VanishCommand()]);
        	$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new VanishOffCommand()]);
	}
}
