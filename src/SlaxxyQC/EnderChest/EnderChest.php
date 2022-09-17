<?php

namespace SlaxxyQC\EnderChest;

use SlaxxyQC\EnderChest\Command\EnderChestCommand;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class EnderChest extends PluginBase
{
    use SingletonTrait;

    protected function onLoad(): void
    {
        self::setInstance($this);
    }

    protected function onEnable(): void
    {

        $this->saveResource("config.yml");

        $this->getServer()->getCommandMap()->register("ec", new EnderChestCommand());

        $this->getLogger()->notice("EnderChest By SlaxxyQC");

        if(!InvMenuHandler::isRegistered()){
            InvMenuHandler::register($this);
        }

    }

}