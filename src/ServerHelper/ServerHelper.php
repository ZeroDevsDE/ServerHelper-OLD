<?php

namespace ServerHelper;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as SH;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\command\ConsoleCommandSender;

class ServerHelper extends PluginBase{

    public $prefix = SH::GRAY . "» " . SH::AQUA . "SH" . SH::GRAY . " » ";
    public $broadcast = SH::GRAY . "» " . SH::AQUA . SH::UNDERLINE . SH::BOLD . "Broadcast" . SH::RESET . SH::GRAY . " » ";

    public function onEnable()
    {
        $this->getLogger()->info(SH::GREEN . "Server-Helper was activated!");
        $this->Banner();
    }

    private function Banner(){
        $banner = strval(
            "\n".
            "╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗\n".
            "║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║\n".
            "║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗\n".
            "║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║\n".
            "║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║\n".
            "╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝"
        );
        $this->getLogger()->info($banner);
    }

    //Commands
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch($command->getName()){
            case "aboutsh":
                $sender->sendMessage($this->prefix . "ServerHelper by PMExperts!");
                $sender->sendMessage("you want a list of alle SH Commands? do /shhelp!");
                $sender->sendMessage("problems? Join our Discord: https://discord.gg/M7aQfm");
                $sender->sendMessage("Github: https://github.com/pmexpertsde");
                return true;

            case "changelogsh":
                $sender->sendMessage($this->prefix . "Look here: https://github.com/PMExpertsDE/Server-Helper/commits/master");
                return true;

            case "broadcast":
                if($sender->hasPermission("serverhelper.command.broadcast")){
                    if(!empty($args[0])){
                        $sender->getServer()->broadcastMessage($this->broadcast . implode(" ", $args));
                        $sender->sendMessage($this->prefix . SH::GREEN . "your broadcast message was send successful!");
                    }else{
                        $sender->sendMessage($this->prefix . "Usage: /broadcast <message>");
                    }
                }
                return true;

            case "clear":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.clear")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->getInventory()->clearAll();
                            $target->getArmorInventory()->clearAll();
                            $target->sendMessage($this->prefix . "Your Inventory was cleared by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->getInventory()->clearAll();
                            $sender->getArmorInventory()->clearAll();
                            $sender->sendMessage($this->prefix . "Your Inventory was cleared successful!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "cleararmor":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.cleararmor")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->getArmorInventory()->clearAll();
                            $target->sendMessage($this->prefix . "Your Armor Inventory was cleared by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->getArmorInventory()->clearAll();
                            $sender->sendMessage($this->prefix . "Your Armor Inventory was cleared successful!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "day":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.day")){
                        $sender->getLevel()->setTime(6000);
                        $sender->sendMessage($this->prefix . "Time was set to " . SH::GREEN . "Day" . SH::GRAY . "!");
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "night":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.night")){
                        $sender->getLevel()->setTime(15000);
                        $sender->sendMessage($this->prefix . "Time was set to " . SH::GREEN . "Night" . SH::GRAY . "!");
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "feed":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.feed")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->setFood(20);
                            $target->sendMessage($this->prefix . "You were fed by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->setFood(20);
                            $sender->sendMessage($this->prefix . "You were fed!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "fly":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.commands.fly")) {
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                if(!$target->getAllowFlight()){
                                    $target->setAllowFlight(true);
                                    $target->sendMessage($this->prefix . SH::GREEN . "You can now fly.");
                                }else{
                                    if($target->getAllowFlight()){
                                        $target->setAllowFlight(false);
                                        $target->sendMessage($this->prefix . SH::RED . "You can no longer fly.");
                                    }
                                }
                            }else{
                                $sender->sendMessage($this->prefix . "There isn't any player with this name!");
                            }
                        }
                        if(empty($args[0])){
                            if(!$sender->getAllowFlight()){
                                $sender->setAllowFlight(true);
                                $sender->sendMessage($this->prefix . SH::GREEN . "You can now fly.");
                            }else{
                                if($sender->getAllowFlight()){
                                    $sender->setAllowFlight(false);
                                    $sender->sendMessage($this->prefix . SH::RED . "You can no longer fly.");
                                }
                            }
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "gma":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gma")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->setGameMode(2);
                            $target->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Adventure" . SH::GRAY . " by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->setGameMode(2);
                            $sender->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Adventure" . SH::GRAY . "!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "gmc":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gmc")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->setGameMode(1);
                            $target->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Creative" . SH::GRAY . " by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->setGameMode(1);
                            $sender->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Creative" . SH::GRAY . "!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "gms":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gms")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->setGameMode(0);
                            $target->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Survival" . SH::GRAY . " by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->setGameMode(0);
                            $sender->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Survival" . SH::GRAY . "!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "gmsp":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gma")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->setGameMode(3);
                            $target->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Spectator" . SH::GRAY . " by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->setGameMode(3);
                            $sender->sendMessage($this->prefix . "Your Gamemode was set to " . SH::GREEN . "Spectator" . SH::GRAY . "!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "heal":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.commands.heal")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            $target->setHealth($target->getMaxHealth());
                            $target->sendMessage($this->prefix . "You were healed by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                        }else{
                            $sender->setHealth($sender->getMaxHealth());
                            $sender->sendMessage($this->prefix . "You were healed!");
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "itemid":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.commands.itemid")){
                        $item = $sender->getInventory()->getItemInHand();
                        $sender->sendMessage($this->prefix . "Item ID: " . $item->getID());
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "nickname":
                if($sender instanceof Player) {
                    if ($sender->hasPermission("serverhelper.command.nick")) {
                        if (!empty($args[0])) {
                            if (!empty($args[1])) {
                                $target = $this->getServer()->getPlayer($args[0]);
                                if ($target == true) {
                                    if ($args[1] == "reset") {
                                        $target->setDisplayName($target->getName());
                                        $target->setNameTag($target->getName());
                                        $target->sendMessage($this->prefix . "Your Nickname was reset to " . SH::GREEN . $target->getName() . SH::GRAY . "!");
                                        $sender->sendMessage($this->prefix . "Nickname of " . SH::GREEN . $target->getName() . SH::GRAY . " was reset!");
                                        return true;
                                    }
                                    if ($args[1] == "off") {
                                        $target->setDisplayName($sender->getName());
                                        $target->setNameTag($sender->getName());
                                        $target->sendMessage($this->prefix . "Your Nickname was reset to " . SH::GREEN . $target->getName() . SH::GRAY . "!");
                                        $sender->sendMessage($this->prefix . "Nickname of " . SH::GREEN . $target->getName() . SH::GRAY . " was reset!");
                                        return true;
                                    } else {
                                        $target->setDisplayName($args[1]);
                                        $target->setNameTag($args[1]);
                                        $target->sendMessage($this->prefix . "Your Nickname was set to " . SH::GREEN . $target->getDisplayName() . SH::GRAY . "by " . SH::GREEN . $sender->getName() . "!");
                                        $sender->sendMessage($this->prefix . "Nickname of " . SH::GREEN . $target->getName() . SH::GRAY . " was set to " . SH::GREEN . $target->getDisplayName() . SH::GRAY . "!");
                                        return true;
                                    }
                                }
                                if ($target == null) {
                                    $sender->sendMessage($this->prefix . "There isn't any player with this name!");
                                }

                            } else {
                                if ($args[0] == "reset") {
                                    $sender->setDisplayName($sender->getName());
                                    $sender->setNameTag($sender->getName());
                                    $sender->sendMessage($this->prefix . "Your Nickname was reset to " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                                    return true;
                                }
                                if ($args[0] == "off") {
                                    $sender->setDisplayName($sender->getName());
                                    $sender->setNameTag($sender->getName());
                                    $sender->sendMessage($this->prefix . "Your Nickname was reset to " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                                    return true;
                                } else {
                                    $sender->setDisplayName($args[0]);
                                    $sender->setNameTag($args[0]);
                                    $sender->sendMessage($this->prefix . "Your Nickname was set to " . SH::GREEN . $sender->getDisplayName() . SH::GRAY . "!");
                                    return true;
                                }
                            }
                        } else {
                            $sender->sendMessage($this->prefix . "Usage: /nickname <nickname> <player>");
                        }
                    } else {
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "test":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.test")){
                        $sender->sendMessage($this->prefix . SH::GREEN . "Your Ping is: " . SH::GOLD . $sender->getPing() . SH::GREEN . "ms");
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "tstop":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.tstop")){
                        $sender->getLevel()->stopTime();
                        $sender->sendMessage($this->prefix . "Time was stopped!");
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "playersize":
                if($sender->hasPermission("serverhelper.command.playersize")){
                    if(!empty($args[0])){
                        $target = $this->getServer()->getPlayer($args[0]);
                        if($target == true){
                            if(!is_numeric($args[1])){
                                if($args[1] == "reset"){
                                    $target->setScale(1);
                                    $target->sendMessage($this->prefix . "Your Size was reset by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                                    $sender->sendMessage($this->prefix . "Size of " . SH::GREEN . $target->getName() . SH::GRAY . " was reset!");
                                }
                            }
                            if(is_numeric($args[1])){
                                if(count($args) == 1){
                                    if($args[1] >= 0 && $args[1] <= 20){
                                        $target->setScale($args[0]);
                                        $target->sendMessage($this->prefix . "Your size was changed to " . SH::GREEN . $args[1] . SH::GRAY . " by " . SH::GREEN . $sender->getName() . SH::GRAY . "!");
                                        $sender->sendMessage($this->prefix . "Size of " . SH::GREEN . $target->getName() . SH::GRAY . " was changed to " . SH::GREEN . $args[1] . SH::GRAY . "!");
                                    }else{
                                        $sender->sendMessage($this->prefix . "Usage: /size 0.1-20");
                                    }
                                }else{
                                    $sender->sendMessage($this->prefix . "Usage: /size 0.1-20");
                                }
                            }
                        }
                        if($target == null){
                            if(!is_numeric($args)){
                                if($args[0] == "reset"){
                                    $sender->setScale(1);
                                    $sender->sendMessage($this->prefix . "You size was reset!");
                                }
                            }
                            if(is_numeric($args)){
                                if($args[0] >= 0 && $args[1] <= 20) {
                                    $sender->setScale($args[0]);
                                    $sender->sendMessage($this->prefix . "Your size was changed to " . SH::GREEN . $args[0] . SH::GRAY . "!");
                                }
                            }
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "Usage: /playersize <size> <player>");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                }
                return true;

            case "vanish":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.vanish")){
                        if(empty($args[0])){
                            $sender->sendMessage($this->prefix . "Usage: /vanish <on/off> <player>");
                            return true;
                        }
                        if(!empty($args[1])){
                            $target = $this->getServer()->getPlayer($args[1]);
                            if($target == true){
                                if($args[0] == "on") {
                                    $target->setDisplayName(" ");
                                    $target->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), (99999999 * 20), (1), (false)));
                                    $target->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), (99999999 * 20), (1), (false)));
                                    $target->sendMessage($this->prefix . "You are now Vanished!");
                                    return true;
                                }
                                if($args[0] == "off"){
                                    $target->setDisplayName(" ");
                                    $target->removeEffect(Effect::INVISIBILITY);
                                    $target->removeEffect(Effect::NIGHT_VISION);
                                    $target->sendMessage($this->prefix . "You are now visible!");
                                    return true;
                                }else{
                                    $sender->sendMessage($this->prefix . "Usage: /vanish <on/off> <player>");
                                }
                            }
                            if($target == null){
                                $sender->sendMessage($this->prefix . "There isn't any player with this name!");
                            }
                            return true;
                        }
                        if(empty($args[1])){
                            if($args[0] == "off"){
                                $sender->setDisplayName($sender->getDisplayName());
                                $sender->removeEffect(Effect::INVISIBILITY);
                                $sender->removeEffect(Effect::NIGHT_VISION);
                                $sender->sendMessage($this->prefix . "You are now Visible!");
                                return true;
                            }
                            if($args[0] == "on"){
                                $sender->setDisplayName(" ");
                                $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), (99999999*20), (1), (false)));
                                $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), (99999999*20), (1), (false)));
                                $sender->sendMessage($this->prefix . "You are now Vanished!");
                                return true;
                            }else{
                                $sender->sendMessage($this->prefix . "Usage: /vanish <on/off> <player>");
                            }
                            return true;
                        }
                    }else{
                        $sender->sendMessage($this->prefix . "You don't have the Permission to use this Command!");
                    }
                }else{
                    $sender->sendMessage($this->prefix . "This Command is Only for Players!");
                }
                return true;

            case "shhelp":
                if(!empty($args[0])) {
                    if ($args[0] == "alias") {
                        $sender->sendMessage(SH::GREEN . "All ServerHelper-CommandAliases!");
                        $sender->sendMessage(SH::GREEN . "/shh" . SH::GRAY . " » " . SH::WHITE . "ServerHelper Help Command");
                        $sender->sendMessage(SH::GREEN . "/bc" . SH::GRAY . " » " . SH::WHITE . "broadcast your message");
                        $sender->sendMessage(SH::GREEN . "/nick" . SH::GRAY . " » " . SH::WHITE . "change your nickname");
                        $sender->sendMessage(SH::GREEN . "/v" . SH::GRAY . " » " . SH::WHITE . "makes you invisible");
                        $sender->sendMessage(SH::GREEN . "/c" . SH::GRAY . " » " . SH::WHITE . "cleares your Inventory");
                        $sender->sendMessage(SH::GREEN . "/ca" . SH::GRAY . " » " . SH::WHITE . "cleares only your Armor Inventory");
                        $sender->sendMessage(SH::GREEN . "/size" . SH::GRAY . " » " . SH::WHITE . "changes your playersize");
                        return true;
                    }else{
                        $sender->sendMessage(SH::GRAY . "Command List" . SH::GREEN . " ServerHelper");
                        $sender->sendMessage(SH::GRAY . "You want to see all Aliasses? do /shh alias");
                        $sender->sendMessage(SH::GREEN . "/shhelp" . SH::GRAY . " » " . SH::WHITE . "ServerHelper Help Command");
                        $sender->sendMessage(SH::GREEN . "/me" . SH::GRAY . " » " . SH::WHITE . "/me Command for Altay Servers");
                        $sender->sendMessage(SH::GREEN . "/fly" . SH::GRAY . " » " . SH::WHITE . "fly Command");
                        $sender->sendMessage(SH::GREEN . "/feed" . SH::GRAY . " » " . SH::WHITE . "feed players");
                        $sender->sendMessage(SH::GREEN . "/heal" . SH::GRAY . " » " . SH::WHITE . "heal players");
                        $sender->sendMessage(SH::GREEN . "/broadcast" . SH::GRAY . " » " . SH::WHITE . "broadcast your message");
                        $sender->sendMessage(SH::GREEN . "/test" . SH::GRAY . " » " . SH::WHITE . "test command | check your ping");
                        $sender->sendMessage(SH::GREEN . "/nickname" . SH::GRAY . " » " . SH::WHITE . "change your nickname");
                        $sender->sendMessage(SH::GREEN . "/vanish" . SH::GRAY . " » " . SH::WHITE . "makes you invisible");
                        $sender->sendMessage(SH::GREEN . "/gmc" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Creative");
                        $sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Surival");
                        $sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Adventure");
                        $sender->sendMessage(SH::GREEN . "/gmsp" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Spectator");
                        $sender->sendMessage(SH::GREEN . "/day" . SH::GRAY . " » " . SH::WHITE . "set world time to day");
                        $sender->sendMessage(SH::GREEN . "/night" . SH::GRAY . " » " . SH::WHITE . "set world time to night");
                        $sender->sendMessage(SH::GREEN . "/clear" . SH::GRAY . " » " . SH::WHITE . "cleares your Inventory");
                        $sender->sendMessage(SH::GREEN . "/cleararmor" . SH::GRAY . " » " . SH::WHITE . "cleares only your Armor Inventory");
                        $sender->sendMessage(SH::GREEN . "/itemid" . SH::GRAY . " » " . SH::WHITE . "gets the id of the item in your hand");
                        $sender->sendMessage(SH::GREEN . "/tstop" . SH::GRAY . " » " . SH::WHITE . "stop time in your world");
                        $sender->sendMessage(SH::GREEN . "/aboutsh" . SH::GRAY . " » " . SH::WHITE . "about ServerHelper");
                        $sender->sendMessage(SH::GREEN . "/playersize" . SH::GRAY . " » " . SH::WHITE . "changes your playersize");
                    }
                }
                if(empty($args[0])){
                        $sender->sendMessage(SH::GRAY . "Command List" . SH::GREEN . " ServerHelper");
                        $sender->sendMessage(SH::GRAY . "You want to see all Aliasses? do /shh alias");
                        $sender->sendMessage(SH::GREEN . "/shhelp" . SH::GRAY . " » " . SH::WHITE . "ServerHelper Help Command");
                        $sender->sendMessage(SH::GREEN . "/me" . SH::GRAY . " » " . SH::WHITE . "/me Command for Altay Servers");
                        $sender->sendMessage(SH::GREEN . "/fly" . SH::GRAY . " » " . SH::WHITE . "fly Command");
                        $sender->sendMessage(SH::GREEN . "/feed" . SH::GRAY . " » " . SH::WHITE . "feed players");
                        $sender->sendMessage(SH::GREEN . "/heal" . SH::GRAY . " » " . SH::WHITE . "heal players");
                        $sender->sendMessage(SH::GREEN . "/broadcast" . SH::GRAY . " » " . SH::WHITE . "broadcast your message");
                        $sender->sendMessage(SH::GREEN . "/test" . SH::GRAY . " » " . SH::WHITE . "test command | check your ping");
                        $sender->sendMessage(SH::GREEN . "/nickname" . SH::GRAY . " » " . SH::WHITE . "change your nickname");
                        $sender->sendMessage(SH::GREEN . "/vanish" . SH::GRAY . " » " . SH::WHITE . "makes you invisible");
                        $sender->sendMessage(SH::GREEN . "/gmc" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Creative");
                        $sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Surival");
                        $sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Adventure");
                        $sender->sendMessage(SH::GREEN . "/gmsp" . SH::GRAY . " » " . SH::WHITE . "set your gamemode to Spectator");
                        $sender->sendMessage(SH::GREEN . "/day" . SH::GRAY . " » " . SH::WHITE . "set world time to day");
                        $sender->sendMessage(SH::GREEN . "/night" . SH::GRAY . " » " . SH::WHITE . "set world time to night");
                        $sender->sendMessage(SH::GREEN . "/clear" . SH::GRAY . " » " . SH::WHITE . "cleares your Inventory");
                        $sender->sendMessage(SH::GREEN . "/cleararmor" . SH::GRAY . " » " . SH::WHITE . "cleares only your Armor Inventory");
                        $sender->sendMessage(SH::GREEN . "/itemid" . SH::GRAY . " » " . SH::WHITE . "gets the id of the item in your hand");
                        $sender->sendMessage(SH::GREEN . "/tstop" . SH::GRAY . " » " . SH::WHITE . "stop time in your world");
                        $sender->sendMessage(SH::GREEN . "/aboutsh" . SH::GRAY . " » " . SH::WHITE . "about ServerHelper");
                        $sender->sendMessage(SH::GREEN . "/playersize" . SH::GRAY . " » " . SH::WHITE . "changes your playersize");
                    }
                return true;
        }
        return false;
    }
}