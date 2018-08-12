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

class ShhelpCommand extends CommandBase
{
    public $prefix = SH::GRAY . "» " . SH::AQUA . "S-H" . SH::GRAY . " » ";

    public function __construct()
    {
        parent::__construct("shhelp", "ServerHelper help command", "/shhelp", ["shh"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        $sender->sendMessage(SH::RED . "═════════════════════╗");
        $sender->sendMessage(SH::GREEN . "/shhelp" . SH::GRAY . " » " . SH::WHITE . "ServerHelper Help Command");
        $sender->sendMessage(SH::GREEN . "/me" . SH::GRAY . " » " . SH::WHITE . "/me Command for Altay Servers");
        $sender->sendMessage(SH::GREEN . "/fly" . SH::GRAY . " » " . SH::WHITE . "fly Command");
        $sender->sendMessage(SH::GREEN . "/feed" . SH::GRAY . " » " . SH::WHITE . "feed players");
        $sender->sendMessage(SH::GREEN . "/heal" . SH::GRAY . " » " . SH::WHITE . "heal players");
        $sender->sendMessage(SH::GREEN . "/broadcast" . SH::GRAY . " » " . SH::WHITE . "broadcast your message");
        $sender->sendMessage(SH::GREEN . "/test" . SH::GRAY . " » " . SH::WHITE . "test command | check your ping");
        $sender->sendMessage(SH::RED . "══════════════════════");
    }
}