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
use pocketmine\command\ConsoleCommandSender;
use pocketmine\utils\TextFormat as SH;

class BroadcastCommand extends CommandBase
{
	
	public $bcprefix = SH::GRAY . "» " . SH::AQUA . SH::BOLD . "Broadcast". SH::RESET . SH::GRAY . " » ";
	public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";
	
   public function __construct() 
   {
      parent::__construct("broadcast", "broadcast command", "/broadcast <message>", ["bc"]);
   }
   public function execute(CommandSender $sender, string $commandLabel, array $args)
   {
       if($sender->hasPermission("serverhelper.command.broadcast")){
           if(!empty($args[0])){
               $sender->getServer()->broadcastMessage($this->bcprefix . implode(" ", $args));
           }else{
               $sender->sendMessage($this->prefix . "Usage: /broadcast <message>");
           }
       }else{
           $sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
       }

	}
}
