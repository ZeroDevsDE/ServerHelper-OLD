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
use ServerHelper\commands\GmsCommand;
use ServerHelper\commands\GmcCommand;
use ServerHelper\commands\GmaCommand;
use ServerHelper\commands\GmspCommand;
use ServerHelper\commands\DayCommand;
use ServerHelper\commands\NightCommand;
use ServerHelper\commands\ClearAllCommand;
use ServerHelper\commands\ClearArmorCommand;
use ServerHelper\commands\ClearItemCommand;
use ServerHelper\commands\ItemNumCommand;
use ServerHelper\commands\TimeStopCommand;
use ServerHelper\commands\AboutCommand;
use ServerHelper\commands\ChangelogCommand;

class ServerHelper extends PluginBase{
	public function onEnable(){
		$this->Banner();
		$this->CommandLoader();
		$this->getLogger()->info(SH::GREEN . "Server-Helper was activated!");
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
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new GmsCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new GmcCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new GmaCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new GmspCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new DayCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new NightCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new ClearAllCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new ClearArmorCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new ClearItemCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new ItemNumCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new TimeStopCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new AboutCommand()]);
		$this->getServer()->getCommandMap()->registerAll("ServerHelper", [new ChangelogCommand()]);
	}
}
