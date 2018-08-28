<?php

#╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗
#║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║
#║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗
#║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║
#║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║
#╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝

namespace ServerHelper\player;

use ServerHelper\CommandBase;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as SH;
use pocketmine\Player;

class PlayerSize extends CommandBase
{
    public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";

    public function __construct()
    {
        parent::__construct("playersize", "change your skin scale", "/size <1-20>", ["size"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player) {
            if ($sender->hasPermission("serverhelper.command.size")) {
                if (count($args) == 1) {
                        if ($args[0] >= 0 && $args[0] <= 20) {
                            $sender->setScale($args[0]);
                            $sender->sendMessage($this->prefix . "Your Skin scale was set to " . SH::GREEN . $args[0] . SH::RESET . "!");
                        }else{
                            $sender->sendMessage($this->prefix . "Usage: /size 0.1-20");
                             }
                        }else{
                            $sender->sendMessage($this->prefix . "Usage: /size 0.1-20");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You dont have the Permission to use this Command!");
                    }
        }else{
            $sender->sendMessage($this->prefix . "This Command is Only for Players!");
        }
    }
}