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

class FlyCommand extends CommandBase
{
	public $prefix = SH::GRAY . "» " . SH::AQUA . "S-H" . SH::GRAY . " » ";
	
	public function __construct() 
   {
		parent::__construct("fly", "fly command", "/fly", ["fly"]);
   }
	public function execute(CommandSender $sender, string $commandLabel, array $args){
		if($sender instanceof Player){
			if($sender->hasPermission("serverhelper.commands.fly")) {
				if(!$sender->getAllowFlight()){
					$sender->setAllowFlight(true);
					$sender->sendMessage($this->prefix . SH::GREEN . "You can now fly.");
				}else{
				if($sender->getAllowFlight()){
					$sender->setAllowFlight(false);
					$sender->sendMessage($this->prefix . SH::RED . "You can no longer fly.");
					}
				}
			}else{
				$sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
			}
		}else{
			$sender->sendMessage($this->prefix . "This Command is Only for Players!");
		}
	}
}
