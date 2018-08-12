<?php

#╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗
#║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║
#║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗
#║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║
#║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║
#╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝

namespace ServerHelper\commands;

use ServerHelper\CommandBase;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as SH;
use pocketmine\Player;

class BroadcastCommand extends CommandBase
{
	
	public $bcprefix = SH::GRAY . "» " . SH::AQUA . SH::BOLD . "Broadcast". SH::RESET . SH::GRAY . " » ";
	public $prefix = SH::GRAY . "» " . SH::AQUA . "S-H" . SH::GRAY . " » ";
	
   public function __construct() 
   {
      parent::__construct("broadcast", "broadcast command", "/broadcast <message>", ["bc"]);
   }
   public function execute(CommandSender $sender, string $commandLabel, array $args)
   {
   	if($sender instanceof Player){
			if($sender->hasPermission("serverhelper.command.broadcast")){
				if(!empty($args[0])){
   				$sender->getServer()->broadcastMessage($this->bcprefix . $args[0]);
   			}else{
					$sender->sendMessage($this->prefix . "Usage: /broadcast <message>");
				}
			}else{
				$sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
			}
	  	}else{
			$sender->sendMessage($this->prefix . "This Command is Only for Players!");
		}
	}
}
