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
    public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";

    public function __construct()
    {
        parent::__construct("shhelp", "ServerHelper help command", "/shhelp", ["shh"]);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if(!empty($args[0])){
			$sender->sendMessage(SH::GRAY . "Command Alias List" . SH::GREEN . " ServerHelper");
        	$sender->sendMessage(SH::GREEN . "/shh" . SH::GRAY . " » " . SH::WHITE . "ServerHelper Help Command");
        	$sender->sendMessage(SH::GREEN . "/me" . SH::GRAY . " » " . SH::WHITE . "/me Command for Altay Servers");
        	$sender->sendMessage(SH::GREEN . "/fly" . SH::GRAY . " » " . SH::WHITE . "fly Command");
        	$sender->sendMessage(SH::GREEN . "/f" . SH::GRAY . " » " . SH::WHITE . "feed players");
        	$sender->sendMessage(SH::GREEN . "/h" . SH::GRAY . " » " . SH::WHITE . "heal players");
        	$sender->sendMessage(SH::GREEN . "/bc" . SH::GRAY . " » " . SH::WHITE . "broadcast your message");
        	$sender->sendMessage(SH::GREEN . "/t" . SH::GRAY . " » " . SH::WHITE . "test command | check your ping");
        	$sender->sendMessage(SH::GREEN . "/nick" . SH::GRAY . " » " . SH::WHITE . "change your nickname");
       	 $sender->sendMessage(SH::GREEN . "/nickoff" . SH::GRAY . " » " . SH::WHITE . "change your nick to your old name");
     	   $sender->sendMessage(SH::GREEN . "/v" . SH::GRAY . " » " . SH::WHITE . "makes you invisible");
        	$sender->sendMessage(SH::GREEN . "/voff" . SH::GRAY . " » " . SH::WHITE . "makes you visible");
        	$sender->sendMessage(SH::GREEN . "/gmc" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Creative");
        	$sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Surival");
        	$sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Adventure");
        	$sender->sendMessage(SH::GREEN . "/gmsp" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Spectator");
        	$sender->sendMessage(SH::GREEN . "/d" . SH::GRAY . " » " . SH::WHITE . "set world time to day");
        	$sender->sendMessage(SH::GREEN . "/n" . SH::GRAY . " » " . SH::WHITE . "set world time to night");
        	$sender->sendMessage(SH::GREEN . "/c" . SH::GRAY . " » " . SH::WHITE . "cleares your Inventory");
        	$sender->sendMessage(SH::GREEN . "/ca" . SH::GRAY . " » " . SH::WHITE . "cleares only your Armor Inventory");
        	$sender->sendMessage(SH::GREEN . "/ci" . SH::GRAY . " » " . SH::WHITE . "cleares only your ItemInventory");
        	$sender->sendMessage(SH::GREEN . "/in" . SH::GRAY . " » " . SH::WHITE . "gets the id of the item in your hand");
        	$sender->sendMessage(SH::GREEN . "/tstop" . SH::GRAY . " » " . SH::WHITE . "stop time in your world");
        }else{
        	$sender->sendMessage(SH::GRAY . "Command List" . SH::GREEN . " ServerHelper");
        	$sender->sendMessage(SH::GRAY . "You want to see all Aliasses? do /shh <alias>");
        	$sender->sendMessage(SH::GREEN . "/shhelp" . SH::GRAY . " » " . SH::WHITE . "ServerHelper Help Command");
        	$sender->sendMessage(SH::GREEN . "/me" . SH::GRAY . " » " . SH::WHITE . "/me Command for Altay Servers");
        	$sender->sendMessage(SH::GREEN . "/fly" . SH::GRAY . " » " . SH::WHITE . "fly Command");
        	$sender->sendMessage(SH::GREEN . "/feed" . SH::GRAY . " » " . SH::WHITE . "feed players");
        	$sender->sendMessage(SH::GREEN . "/heal" . SH::GRAY . " » " . SH::WHITE . "heal players");
        	$sender->sendMessage(SH::GREEN . "/broadcast" . SH::GRAY . " » " . SH::WHITE . "broadcast your message");
        	$sender->sendMessage(SH::GREEN . "/test" . SH::GRAY . " » " . SH::WHITE . "test command | check your ping");
        	$sender->sendMessage(SH::GREEN . "/nickname" . SH::GRAY . " » " . SH::WHITE . "change your nickname");
       	 $sender->sendMessage(SH::GREEN . "/nicknameoff" . SH::GRAY . " » " . SH::WHITE . "change your nick to your old name");
     	   $sender->sendMessage(SH::GREEN . "/vanish" . SH::GRAY . " » " . SH::WHITE . "makes you invisible");
        	$sender->sendMessage(SH::GREEN . "/vanishoff" . SH::GRAY . " » " . SH::WHITE . "makes you visible");
        	$sender->sendMessage(SH::GREEN . "/gmc" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Creative");
        	$sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Surival");
        	$sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Adventure");
        	$sender->sendMessage(SH::GREEN . "/gmsp" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Spectator");
        	$sender->sendMessage(SH::GREEN . "/day" . SH::GRAY . " » " . SH::WHITE . "set world time to day");
        	$sender->sendMessage(SH::GREEN . "/night" . SH::GRAY . " » " . SH::WHITE . "set world time to night");
        	$sender->sendMessage(SH::GREEN . "/clear" . SH::GRAY . " » " . SH::WHITE . "cleares your Inventory");
        	$sender->sendMessage(SH::GREEN . "/cleararmor" . SH::GRAY . " » " . SH::WHITE . "cleares only your Armor Inventory");
        	$sender->sendMessage(SH::GREEN . "/clearitem" . SH::GRAY . " » " . SH::WHITE . "cleares only your ItemInventory");
        	$sender->sendMessage(SH::GREEN . "/itemid" . SH::GRAY . " » " . SH::WHITE . "gets the id of the item in your hand");
        	$sender->sendMessage(SH::GREEN . "/tstop" . SH::GRAY . " » " . SH::WHITE . "stop time in your world");
        }
    }
}
