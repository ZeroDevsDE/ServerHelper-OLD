<?php

#╔═══╗╔═╗╔═╗╔═══╗╔═╗╔═╗╔═══╗╔═══╗╔═══╗╔════╗╔═══╗
#║╔═╗║║║╚╝║║║╔══╝╚╗╚╝╔╝║╔═╗║║╔══╝║╔═╗║║╔╗╔╗║║╔═╗║
#║╚═╝║║╔╗╔╗║║╚══╗─╚╗╔╝─║╚═╝║║╚══╗║╚═╝║╚╝║║╚╝║╚══╗
#║╔══╝║║║║║║║╔══╝─╔╝╚╗─║╔══╝║╔══╝║╔╗╔╝──║║──╚══╗║
#║║───║║║║║║║╚══╗╔╝╔╗╚╗║║───║╚══╗║║║╚╗──║║──║╚═╝║
#╚╝───╚╝╚╝╚╝╚═══╝╚═╝╚═╝╚╝───╚═══╝╚╝╚═╝──╚╝──╚═══╝
#
#ServerHelper (c) 2018
#This Plugin is licensed under GNU General Public License v3.0, it is free to use.
#You can take some code out of our Plugin but please do not change the Author and Name.
#
#>----------------------------------------------------------------------------------------<
#
# Team: PMExpertsDE
# Author: HonorGamerHD
# Discord: https://discordapp.com/invite/Cnffuhs
# Website: http://pmexperts.tk

namespace ServerHelper;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as SH;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\utils\Config;
use pocketmine\math\Vector3;


class ServerHelper extends PluginBase{

    protected $lang;

    public function onEnable()
    {
        $this->saveResource("config.yml");
        @mkdir($this->getDataFolder());
        $this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);

        if (!file_exists($this->getDataFolder() . "lang/")) {
            @mkdir($this->getDataFolder() . "lang/");
            $this->saveResource("lang/English.yml");
            $this->saveResource("lang/Deutsch.yml");
            $this->saveResource("lang/Italiano.yml");
        }

        $language = $this->cfg->get("Language");
        if(!is_file($this->getDataFolder() . "lang/{$language}.yml")){
            if($this->saveResource("lang/{$language}.yml")){
                $this->getLogger()->warning("The Language " . $language . " was not found! if this is your first session with ServerHelper Plugin, Please restart your Server!");
                $language = 'English';
                $this->saveResource("lang/English.yml");
            }
        }
        $this->lang = new Config($this->getDataFolder() . "lang/{$language}.yml", Config::YAML);
        $this->lang->save();

        $pluginversion = $this->cfg->get("VERSION");
        $prefix = $this->cfg->get("PluginPrefix");
        $broadcastprefix = $this->cfg->get("BroadcastPrefix");
        $langselected = $this->getLang("lang.NAME");
        $langid = $this->getLang("lang.ID");

        //log stuff
        $this->getLogger()->info(SH::GREEN . $this->getLang("message.logger.startup"));
        $this->getLogger()->info(SH::GREEN . $this->getLang("message.logger.version") . $pluginversion);
        $this->getLogger()->info(SH::GREEN . $this->getLang("message.logger.choosen.prefix") . $prefix);
        $this->getLogger()->info(SH::GREEN . $this->getLang("message.logger.choosen.bcprefix") . $broadcastprefix);
        $this->getLogger()->info(SH::GREEN . $this->getLang("message.logger.choosen.lang") . $langselected . " §eID: §7" . $langid);
        $this->Banner();
    }

    public function getLang(string $configKey, array $keys = array()) {
        $language = $this->lang;
        $key = $language->get($configKey);
        if (!is_string($key))
            return $this->getLang("message.warning.configkey") . $configKey;
        $key = strtr($key, $keys);
        return str_replace("&", "§", $key);
    }

    public function replaceVars($str, array $vars){
        foreach($vars as $key => $value){
            $str = str_replace("{" . $key . "}", $value, $str);
        }
        return $str;
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
    public function onCommand(CommandSender $sender, Command $command, string $lable, array $args): bool
    {
        $prefix = $this->cfg->get("PluginPrefix");
        $broadcastprefix = $this->cfg->get("BroadcastPrefix");

        switch($command->getName()){
            case "aboutsh":
                $sender->sendMessage($prefix . $this->getLang("message.about.line1"));
                $sender->sendMessage($this->getLang("message.about.line2"));
                $sender->sendMessage($this->getLang("message.about.line3"));
                $sender->sendMessage("Github: https://github.com/pmexpertsde");
                return true;

            case "changelogsh":
                $sender->sendMessage($prefix . $this->getLang("message.changelog"));
                return true;

            case "broadcast":
                if($sender->hasPermission("serverhelper.command.broadcast")){
                    if(!empty($args[0])){
                        $sender->getServer()->broadcastMessage($broadcastprefix . implode(" ", $args));
                        $sender->sendMessage($prefix . $this->getLang("message.broadcast.successful"));
                    }else{
                        $sender->sendMessage($broadcastprefix . $this->getLang("message.broadcast.usage"));
                    }
                }
                return true;

            case "clear":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.clear")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $target->getInventory()->clearAll();
                                $target->getArmorInventory()->clearAll();
                                $target->sendMessage($prefix . $this->getLang("message.clear.target.part1") . $sender->getDisplayName() . $this->getLang("message.clear.target.part2"));
                                $sender->sendMessage($prefix . $this->getLang("message.clear.sender.part1") . $target->getDisplayName() . $this->getLang("message.clear.sender.part2"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->getInventory()->clearAll();
                            $sender->getArmorInventory()->clearAll();
                            $sender->sendMessage($prefix . $this->getLang("message.clear.self"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "cleararmor":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.cleararmor")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $target->getArmorInventory()->clearAll();
                                $target->sendMessage($prefix . $this->getLang("message.cleararmor.target.part1") . $sender->getName() . $this->getLang("message.cleararmor.target.part2"));
                                $sender->sendMessage($prefix . $this->getLang("message.cleararmor.sender.part1") . $target->getDisplayName() . $this->getLang("message.cleararmor.sender.part2"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->getArmorInventory()->clearAll();
                            $sender->sendMessage($prefix . $this->getLang("message.cleararmor.self"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "day":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.day")){
                        $sender->getLevel()->setTime(6000);
                        $sender->sendMessage($prefix . $this->getLang("message.day"));
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "night":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.night")){
                        $sender->getLevel()->setTime(15000);
                        $sender->sendMessage($prefix . $this->getLang("message.night"));
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "feed":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.feed")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $target->setFood(20);
                                $target->sendMessage($prefix . $this->getLang("message.feed.target.part1") . $sender->getName() . $this->getLang("message.feed.target.part2"));
                                $sender->sendMessage($prefix . $this->getLang("message.feed.sender.part1") . $target->getDisplayName() . $this->getLang("message.feed.sender.part2"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->setFood(20);
                            $sender->sendMessage($prefix . $this->getLang("message.feed.self"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
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
                                    $target->sendMessage($prefix . $this->getLang("message.fly.target.on"));
                                }else{
                                    if($target->getAllowFlight()){
                                        $target->setAllowFlight(false);
                                        $target->sendMessage($prefix . $this->getLang("message.fly.target.off"));
                                    }
                                }
                            }else{
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            if(!$sender->getAllowFlight()){
                                $sender->setAllowFlight(true);
                                $sender->sendMessage($prefix . $this->getLang("message.fly.self.on"));
                            }else{
                                if($sender->getAllowFlight()){
                                    $sender->setAllowFlight(false);
                                    $sender->sendMessage($prefix . $this->getLang("message.fly.self.off"));
                                }
                            }
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "gma":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gma")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $target->setGameMode(2);
                                $target->sendMessage($prefix . $this->getLang("message.gamemode.part1") . $this->getLang("message.gamemode.adventure"));
                                $sender->sendMessage($prefix . $this->getLang("message.gamemode.sender.part1") . $target->getDisplayName() . $this->getLang("message.gamemode.sender.part2") . $this->getLang("message.gamemode.adventure"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->setGameMode(2);
                            $sender->sendMessage($prefix . $this->getLang("message.gamemode.part1") . $this->getLang("message.gamemode.adventure"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "gmc":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gmc")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $target->setGameMode(1);
                                $target->sendMessage($prefix . $this->getLang("message.gamemode.part1") . $this->getLang("message.gamemode.creative"));
                                $sender->sendMessage($prefix . $this->getLang("message.gamemode.sender.part1") . $target->getDisplayName() . $this->getLang("message.gamemode.sender.part2") . $this->getLang("message.gamemode.creative"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->setGameMode(1);
                            $sender->sendMessage($prefix . $this->getLang("message.gamemode.part1") . $this->getLang("message.gamemode.creative"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "gms":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gms")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $target->setGameMode(0);
                                $target->sendMessage($prefix . $this->getLang("message.gamemode.part1") . $this->getLang("message.gamemode.survival"));
                                $sender->sendMessage($prefix . $this->getLang("message.gamemode.sender.part1") . $target->getDisplayName() . $this->getLang("message.gamemode.sender.part2") . $this->getLang("message.gamemode.survival"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->setGameMode(0);
                            $sender->sendMessage($prefix . $this->getLang("message.gamemode.part1") . $this->getLang("message.gamemode.survival"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "gmsp":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.gmsp")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $target->setGameMode(3);
                                $target->sendMessage($prefix . $this->getLang("message.gamemode.part1") . $this->getLang("message.gamemode.spectator"));
                                $sender->sendMessage($prefix . $this->getLang("message.gamemode.sender.part1") . $target->getDisplayName() . $this->getLang("message.gamemode.sender.part2") . $this->getLang("message.gamemode.spectator"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->setGameMode(3);
                            $sender->sendMessage($prefix . $this->getLang("message.gamemode.part1") . "Spectator" . SH::GRAY . "!");
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "heal":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.commands.heal")){
                        if(!empty($args[0])){
                           $target = $this->getServer()->getPlayer($args[0]);
                           if($target == true){
                               $target->setHealth($target->getMaxHealth());
                               $target->sendMessage($prefix . $this->getLang("message.heal.target"));
                               $sender->sendMessage($prefix . $this->getLang("message.heal.sender.part1") . $target->getDisplayName() . $this->getLang("message.heal.sender.part2"));
                           }
                           if($target == null){
                               $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                           }
                        }
                        if(empty($args[0])){
                            $sender->setHealth($sender->getMaxHealth());
                            $sender->sendMessage($prefix . $this->getLang("message.heal.self"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "itemid":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.commands.itemid")){
                        $item = $sender->getInventory()->getItemInHand();
                        $sender->sendMessage($prefix . $this->getLang("message.itemid") . $item->getID());
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "nickname":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.nickname")){
                        if(!empty($args[0])){
                            if(!empty($args[1])){
                                $target = $this->getServer()->getPlayer($args[0]);
                                if($target == true){
                                    if($args[1] == "reset"){
                                        $target->setDisplayName($target->getName());
                                        $target->setNameTag($target->getName());
                                        $target->sendMessage($prefix . $this->getLang("message.nick.reset") . $target->getName() . $this->getLang("message.nick.!"));
                                        $sender->sendMessage($prefix . $this->getLang("message.nick.nickof") . $target->getName() . $this->getLang("message.nick.wasreset"));
                                        return true;
                                    }
                                    if($args[1] == "off"){
                                        $target->setDisplayName($sender->getName());
                                        $target->setNameTag($sender->getName());
                                        $target->sendMessage($prefix . $this->getLang("message.nick.reset") . $target->getName() . $this->getLang("message.nick.!"));
                                        $sender->sendMessage($prefix . $this->getLang("message.nick.nickof") . $target->getName() . $this->getLang("message.nick.wasreset"));
                                        return true;
                                    }else{
                                        $target->setDisplayName($args[1]);
                                        $target->setNameTag($args[1]);
                                        $target->sendMessage($prefix . $this->getLang("message.nick.wassetto") . $target->getDisplayName() . $this->getLang("message.nick.by") . $sender->getName() . $this->getLang("message.nick.!"));
                                        $sender->sendMessage($prefix . $this->getLang("message.nick.nickof") . $target->getName() . $this->getLang("message.nick.wassetto2") . $target->getDisplayName() . $this->getLang("message.nick.!"));
                                        return true;
                                    }
                                }
                                if($target == null){
                                    $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                                }

                            }else{
                                if($args[0] == "reset"){
                                    $sender->setDisplayName($sender->getName());
                                    $sender->setNameTag($sender->getName());
                                    $sender->sendMessage($prefix . $this->getLang("message.nick.reset") . $sender->getName() . $this->getLang("message.nick.!"));
                                    return true;
                                }
                                if($args[0] == "off"){
                                    $sender->setDisplayName($sender->getName());
                                    $sender->setNameTag($sender->getName());
                                    $sender->sendMessage($prefix . $this->getLang("message.nick.reset") . $sender->getName() . $this->getLang("message.nick.!"));
                                    return true;
                                }else{
                                    $sender->setDisplayName($args[0]);
                                    $sender->setNameTag($args[0]);
                                    $sender->sendMessage($prefix . $this->getLang("message.nick.wassetto") . $sender->getDisplayName() . $this->getLang("message.nick.!"));
                                    return true;
                                }
                            }
                        }else{
                            $sender->sendMessage($prefix . $this->getLang("message.nick.usage"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "test":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.test")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $sender->sendMessage($prefix . $this->getLang("message.ping.sender.part1") . $target->getDisplayName() . $this->getLang("message.ping.sender.part2") . $target->getPing() . $this->getLang("message.ping.sender.part3"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[0])){
                            $sender->sendMessage($prefix . $this->getLang("message.ping.self") . $sender->getPing() . $this->getLang("message.ping.sender.part3"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "tstop":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.tstop")){
                        $sender->getLevel()->stopTime();
                        $sender->sendMessage($prefix . $this->getLang("message.tstop"));
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "playersize":
                if($sender->hasPermission("serverhelper.command.playersize")){
                    if(!empty($args[0])){
                        if(!empty($args[1])){
                            $target = $this->getServer()->getPlayer($args[1]);
                            if($target == true){
                                if(!is_numeric($args[0])){
                                    if($args[0] == "reset") {
                                        $target->setScale(1);
                                        $target->sendMessage($prefix . $this->getLang("message.size.sizewasresetby") . $sender->getName() . $this->getLang("message.size.!"));$sender->sendMessage($prefix . $this->getLang("message.size.sizeof") . $target->getName() . $this->getLang("message.size.wasreset"));
                                    }
                                }
                                if(is_numeric($args[0])){
                                    if($args[0] >= 0 && $args[0] <= 20){
                                        $target->setScale($args[0]);
                                        $target->sendMessage($prefix . $this->getLang("message.size.target.part1") . $args[0] . $this->getLang("message.nick.by") . $sender->getName() . $this->getLang("message.nick.!"));
                                        $sender->sendMessage($prefix . $this->getLang("message.size.sender.part1") . $target->getName() . $this->getLang("message.nick.sender.part2") . $args[0] . $this->getLang("message.size.!"));
                                    }else{
                                        $sender->sendMessage($prefix . $this->getLang("message.size.usage"));
                                    }
                                }
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }
                        if(empty($args[1])){
                            if(!is_numeric($args[0])){
                                if($args[0] == "reset"){
                                    $sender->setScale(1);
                                    $sender->sendMessage($prefix . $this->getLang("message.size.self.reset"));
                                }else{
                                    $sender->sendMessage($prefix . $this->getLang("message.size.usage"));
                                }
                            }
                            if(is_numeric($args[0])){
                                if($args[0] >= 0 && $args[0] <= 20) {
                                    $sender->setScale($args[0]);
                                    $sender->sendMessage($prefix . $this->getLang("message.size.self.setsize") . $args[0] . $this->getLang("message.size.!"));
                                }else{
                                    $sender->sendMessage($prefix . $this->getLang("message.size.usage"));
                                }
                            }
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.size.usage"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                }
                return true;

            case "vanish":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.vanish")){
                        if(empty($args[0])){
                            $sender->sendMessage($prefix . $this->getLang("message.vanish.usage"));
                            return true;
                        }
                        if(!empty($args[1])){
                            $target = $this->getServer()->getPlayer($args[1]);
                            if($target == true){
                                if($args[0] == "on") {
                                    $target->setDisplayName(" ");
                                    $target->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), (99999999 * 20), (1), (false)));
                                    $target->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), (99999999 * 20), (1), (false)));
                                    $target->sendMessage($prefix . $this->getLang("message.vanished.true"));
                                    return true;
                                }
                                if($args[0] == "off"){
                                    $target->setDisplayName(" ");
                                    $target->removeEffect(Effect::INVISIBILITY);
                                    $target->removeEffect(Effect::NIGHT_VISION);
                                    $target->sendMessage($prefix . $this->getLang("message.vanished.false"));
                                    return true;
                                }else{
                                    $sender->sendMessage($prefix . $this->getLang("message.vanish.usage"));
                                }
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                            return true;
                        }
                        if(empty($args[1])){
                            if($args[0] == "off"){
                                $sender->setDisplayName($sender->getDisplayName());
                                $sender->removeEffect(Effect::INVISIBILITY);
                                $sender->removeEffect(Effect::NIGHT_VISION);
                                $sender->sendMessage($prefix . $this->getLang("message.vanished.false"));
                                return true;
                            }
                            if($args[0] == "on"){
                                $sender->setDisplayName(" ");
                                $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::NIGHT_VISION), (99999999*20), (1), (false)));
                                $sender->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), (99999999*20), (1), (false)));
                                $sender->sendMessage($prefix . $this->getLang("message.vanished.true"));
                                return true;
                            }else{
                                $sender->sendMessage($prefix . $this->getLang("message.vanish.usage"));
                            }
                            return true;
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "tphere":
                if($sender instanceof Player){
                    if($sender->hasPermission("serverhelper.command.tphere")){
                        if(!empty($args[0])){
                            $target = $this->getServer()->getPlayer($args[0]);
                            if($target == true){
                                $x = $sender->getX();
                                $y = $sender->getY();
                                $z = $sender->getZ();
                                $level = $sender->getLevel();
                                $target->teleport(new Vector3($x ,$y, $z, $level));
                                $target->sendMessage($prefix . $this->getLang("message.tphere.target") . $sender->getDisplayName() . $this->getLang("message.tphere.!"));
                                $sender->sendMessage($prefix . $this->getLang("message.tphere.sender.part1") . $target->getDisplayName() . $this->getLang("message.tphere.sender.part2"));
                            }
                            if($target == null){
                                $sender->sendMessage($prefix . $this->getLang("message.warning.noplayerfound"));
                            }
                        }else{
                            $sender->sendMessage($prefix . $this->getLang("message.tphere.usage"));
                        }
                    }else{
                        $sender->sendMessage($prefix . $this->getLang("message.warning.noperm"));
                    }
                }else{
                    $sender->sendMessage($prefix . $this->getLang("message.warning.onlyplayers"));
                }
                return true;

            case "shhelp":
                if(!empty($args[0])) {
                    if ($args[0] == "alias") {
                        $sender->sendMessage($this->getLang("message.help.aliases"));
                        $sender->sendMessage(SH::GREEN . "/shh" . SH::GRAY . " » " . $this->getLang("message.help.shhelp"));
                        $sender->sendMessage(SH::GREEN . "/bc" . SH::GRAY . " » " . $this->getLang("message.help.broadcast"));
                        $sender->sendMessage(SH::GREEN . "/nick" . SH::GRAY . " » " . $this->getLang("message.help.nickname"));
                        $sender->sendMessage(SH::GREEN . "/v" . SH::GRAY . " » " . $this->getLang("message.help.vanish"));
                        $sender->sendMessage(SH::GREEN . "/c" . SH::GRAY . " » " . $this->getLang("message.help.clear"));
                        $sender->sendMessage(SH::GREEN . "/ca" . SH::GRAY . " » " . $this->getLang("message.help.cleararmor"));
                        $sender->sendMessage(SH::GREEN . "/size" . SH::GRAY . " » " . $this->getLang("message.help.size"));
                        return true;
                    }else{
                        $sender->sendMessage($this->getLang("message.help.CommandList"));
                        $sender->sendMessage($this->getLang("message.help.wantseealiases"));
                        $sender->sendMessage(SH::GREEN . "/shhelp" . SH::GRAY . " » " . $this->getLang("message.help.shhelp"));
                        $sender->sendMessage(SH::GREEN . "/fly" . SH::GRAY . " » " . $this->getLang("message.help.fly"));
                        $sender->sendMessage(SH::GREEN . "/feed" . SH::GRAY . " » " . $this->getLang("message.help.feed"));
                        $sender->sendMessage(SH::GREEN . "/heal" . SH::GRAY . " » " . $this->getLang("message.help.heal"));
                        $sender->sendMessage(SH::GREEN . "/broadcast" . SH::GRAY . " » " . $this->getLang("message.help.broadcast"));
                        $sender->sendMessage(SH::GREEN . "/test" . SH::GRAY . " » " . $this->getLang("message.help.test"));
                        $sender->sendMessage(SH::GREEN . "/nickname" . SH::GRAY . " » " . $this->getLang("message.help.nickname"));
                        $sender->sendMessage(SH::GREEN . "/vanish" . SH::GRAY . " » " . $this->getLang("message.help.vanish"));
                        $sender->sendMessage(SH::GREEN . "/gmc" . SH::GRAY . " » " . $this->getLang("message.help.gmc"));
                        $sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . $this->getLang("message.help.gma"));
                        $sender->sendMessage(SH::GREEN . "/gms" . SH::GRAY . " » " . $this->getLang("message.help.gms"));
                        $sender->sendMessage(SH::GREEN . "/gmsp" . SH::GRAY . " » " . $this->getLang("message.help.gmsp"));
                        $sender->sendMessage(SH::GREEN . "/day" . SH::GRAY . " » " . $this->getLang("message.help.day"));
                        $sender->sendMessage(SH::GREEN . "/night" . SH::GRAY . " » " . $this->getLang("message.help.night"));
                        $sender->sendMessage(SH::GREEN . "/clear" . SH::GRAY . " » " . $this->getLang("message.help.clear"));
                        $sender->sendMessage(SH::GREEN . "/cleararmor" . SH::GRAY . " » " . $this->getLang("message.help.cleararmor"));
                        $sender->sendMessage(SH::GREEN . "/itemid" . SH::GRAY . " » " . $this->getLang("message.help.itemid"));
                        $sender->sendMessage(SH::GREEN . "/tstop" . SH::GRAY . " » " . $this->getLang("message.help.tstop"));
                        $sender->sendMessage(SH::GREEN . "/aboutsh" . SH::GRAY . " » " . $this->getLang("message.help.about"));
                        $sender->sendMessage(SH::GREEN . "/playersize" . SH::GRAY . " » " . $this->getLang("message.help.size"));
                    }
                }
                if(empty($args[0])){
                        $sender->sendMessage($this->getLang("message.help.CommandList"));
                        $sender->sendMessage($this->getLang("message.help.wantseealiases"));
                        $sender->sendMessage(SH::GREEN . "/shhelp" . SH::GRAY . " » " . $this->getLang("message.help.shhelp"));
                        $sender->sendMessage(SH::GREEN . "/fly" . SH::GRAY . " » " . $this->getLang("message.help.fly"));
                        $sender->sendMessage(SH::GREEN . "/feed" . SH::GRAY . " » " . $this->getLang("message.help.feed"));
                        $sender->sendMessage(SH::GREEN . "/heal" . SH::GRAY . " » " . $this->getLang("message.help.heal"));
                        $sender->sendMessage(SH::GREEN . "/broadcast" . SH::GRAY . " » " . $this->getLang("message.help.broadcast"));
                        $sender->sendMessage(SH::GREEN . "/test" . SH::GRAY . " » " . $this->getLang("message.help.test"));
                        $sender->sendMessage(SH::GREEN . "/nickname" . SH::GRAY . " » " . $this->getLang("message.help.nickname"));
                        $sender->sendMessage(SH::GREEN . "/vanish" . SH::GRAY . " » " . $this->getLang("message.help.vanish"));
                        $sender->sendMessage(SH::GREEN . "/gmc" . SH::GRAY . " » " . $this->getLang("message.help.gmc"));
                        $sender->sendMessage(SH::GREEN . "/gma" . SH::GRAY . " » " . $this->getLang("message.help.gma"));
                        $sender->sendMessage(SH::GREEN . "/gms" . SH::GRAY . " » " . $this->getLang("message.help.gms"));
                        $sender->sendMessage(SH::GREEN . "/gmsp" . SH::GRAY . " » " . $this->getLang("message.help.gmsp"));
                        $sender->sendMessage(SH::GREEN . "/day" . SH::GRAY . " » " . $this->getLang("message.help.day"));
                        $sender->sendMessage(SH::GREEN . "/night" . SH::GRAY . " » " . $this->getLang("message.help.night"));
                        $sender->sendMessage(SH::GREEN . "/clear" . SH::GRAY . " » " . $this->getLang("message.help.clear"));
                        $sender->sendMessage(SH::GREEN . "/cleararmor" . SH::GRAY . " » " . $this->getLang("message.help.cleararmor"));
                        $sender->sendMessage(SH::GREEN . "/itemid" . SH::GRAY . " » " . $this->getLang("message.help.itemid"));
                        $sender->sendMessage(SH::GREEN . "/tstop" . SH::GRAY . " » " . $this->getLang("message.help.tstop"));
                        $sender->sendMessage(SH::GREEN . "/aboutsh" . SH::GRAY . " » " . $this->getLang("message.help.about"));
                        $sender->sendMessage(SH::GREEN . "/playersize" . SH::GRAY . " » " . $this->getLang("message.help.size"));
                    }
                return true;
        }
        return false;
    }
}