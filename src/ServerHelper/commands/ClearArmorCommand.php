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

class ClearArmorCommand extends CommandBase
{
    public $prefix = SH::GRAY . "» " . SH::AQUA . "S-H" . SH::GRAY . " » ";

    public function __construct()
    {
        parent::__construct("cleararmor", "cleares your Armor inventory", "/cleararmor", ["ca"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            if($sender->hasPermission("serverhelper.command.cleararmor")){
            	$sender->getArmorInventory()->clearAll();
                $sender->sendMessage($this->prefix . "Your Armor Inventory was cleared successful!");
            }else{
                $sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
            }
        }else{
            $sender->sendMessage($this->prefix . "This Command is Only for Players!");
        }
    }
}