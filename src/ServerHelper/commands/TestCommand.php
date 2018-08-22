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

class TestCommand extends CommandBase
{
	public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";
	
	public function __construct() 
   {
		parent::__construct("test", "test command", "/test", ["t"]);
   }
	public function execute(CommandSender $sender, string $commandLabel, array $args)
   {
		if($sender instanceof Player){
			if($sender->hasPermission("serverhelper.command.test")){
				$sender->sendMessage($this->prefix . SH::GREEN . "Your Ping is: " . SH::GOLD . $sender->getPing() . SH::GREEN . "ms");
			}else{
				$sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
			}
		}else{
			$sender->sendMessage($this->prefix . "This Command is Only for Players!");
		}
	}
}