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

class MeCommand extends CommandBase
{
	public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";
	
	public function __construct() 
   {
		parent::__construct("me", "me command", "/me <message>", ["me"]);
   }
	public function execute(CommandSender $sender, string $commandLabel, array $args)
   {
		if($sender instanceof Player){
			if($sender->hasPermission("serverhelper.command.me")){
				if(!empty($args[0])){
					$sender->getServer()->broadcastMessage(" * " . $sender->getName() . " " . $args[0]);
				}else{
					$sender->sendMessage($this->prefix . "Usage: /me <message>");
				}
			}else{
				$sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
			}
		}else{
			$sender->sendMessage($this->prefix . "This Command is Only for Players!");
		}
	}
}
