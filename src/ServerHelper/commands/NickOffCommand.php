<?php

#╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗
#║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║
#║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗
#║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║
#║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║
#╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝

namespace ServerHelper\commands;

use ServerHelper\CommandBase;;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as SH;
use pocketmine\Player;

class NickOffCommand extends CommandBase
{
    public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";

    public function __construct()
    {
        parent::__construct("nicknameoff", "nicknameoff command", "/nicknameoff", ["nickoff"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            if($sender->hasPermission("serverhelper.command.nick")){
                $sender->setDisplayName($sender->getName());
                $sender->setNameTag($sender->getName());
                $sender->sendMessage($this->prefix . "Your Nickname was reset to " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
            }else{
                $sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
            }
        }else{
            $sender->sendMessage($this->prefix . "This Command is Only for Players!");
        }
    }
}
