<?php

#╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗
#║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║
#║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗
#║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║
#║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║
#╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝

namespace ServerHelper\commands;

use ServerHelper\ServerHelper;
use ServerHelper\CommandBase;
use pocketmine\plugin\PluginCommand;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as SH;
use pocketmine\Server;
use pocketmine\Player;

class BroadcastCommand extends CommandBase{
	
	public $bcprefix = SH::GRAY . "» " . SH::AQUA . SH::BOLD . "Broadcast". SH::RESET . SH::GRAY . " » ";
	public $prefix = SH::GRAY . "» " . SH::AQUA . "S-H" . SH::GRAY . " » ";
	
   public function __construct() 
   {
      parent::__construct("broadcast", "broadcast command", "/broadcast <message>", ["bc"]);
   }
   public function execute(CommandSender $sender, string $commandLabel, array $args)
   {
   	if(!empty($args[0])){
   		$sender->getServer()->broadcastMessage($this->bcprefix . $args[0]);
   	}else{
			$sender->sendMessage($this->prefix . "Usage: /broadcast <message>");
		}
   }
}
