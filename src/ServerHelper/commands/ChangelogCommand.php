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

class ChangelogCommand extends CommandBase
{
	public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";
	
	public function __construct() 
   {
		parent::__construct("changelogsh", "changelog of ServerHelper", "/changelogsh", ["clsh"]);
   }
	public function execute(CommandSender $sender, string $commandLabel, array $args)
   {
		$sender->sendMessage($this->prefix . "Latest Build:");
		$sender->sendMessage(SH::GREEN . "Build Number: " . SH::RESET  ."2.1.3b");
		$sender->sendMessage(SH::GREEN . "Changes:");
		$sender->sendMessage("- Fixed MeCommmand");
		$sender->sendMessage("- New ChangelogCommand");
		$sender->sendMessage("- Fixed ConsoleCommand");
		$sender->sendMessage("Github: https://github.com/pmexpertsde");
	}
}
