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

class FeedCommand extends CommandBase
{
	public $prefix = SH::GRAY . "» " . SH::AQUA . "S-H" . SH::GRAY . " » ";
	
	public function __construct() 
   {
		parent::__construct("feed", "feed command", "/feed", ["f"]);
   }
	public function execute(CommandSender $sender, string $commandLabel, array $args)
   {
		if($sender instanceof Player){
			if($sender->hasPermission("serverhelper.command.feed")){
				$sender->setFood(20);
				$sender->sendMessage($this->prefix . "You were fed!");
			}else{
				$sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
			}
		}else{
			$sender->sendMessage($this->prefix . "This Command is Only for Players!");
		}
	}
}
