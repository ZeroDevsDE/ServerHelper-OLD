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
use pocketmine\entity\Effect;

class VanishOffCommand extends CommandBase
{
    public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";

    public function __construct()
    {
        parent::__construct("vanishoff", "vanishoff command", "/vanishoff", ["voff"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            if($sender->hasPermission("serverhelper.command.vanish")){
                $sender->setDisplayName($sender->getName());
                $sender->removeEffect(Effect::INVISIBILITY);
                $sender->removeEffect(Effect::NIGHT_VISION);
                $sender->sendMessage($this->prefix . "You are now Visible");
            }else{
                $sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
            }
        }else{
            $sender->sendMessage($this->prefix . "This Command is Only for Players!");
        }
    }
}
