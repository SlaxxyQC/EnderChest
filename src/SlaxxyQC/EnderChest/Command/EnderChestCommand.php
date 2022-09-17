<?php

namespace SlaxxyQC\EnderChest\Command;

use muqsit\invmenu\InvMenu;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\inventory\Inventory;
use pocketmine\player\Player;

class EnderChestCommand extends Command
{
    public function __construct()
    {
        parent::__construct("enderchest", "Cette command ouvre votre enderchest", "", ["ec"]);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) {
            return;
        }

        if (!isset($args[0])) {
            if ($sender->hasPermission("ec.use")) {
                $enderchest = InvMenu::create(InvMenuTypeIds::TYPE_ENDER_CHEST);
                $enderchest->getInventory()->setContents($sender->getEnderInventory()->getContents());
                $enderchest->setInventoryCloseListener(function (Player $player, Inventory $inventory) {
                    $player->getEnderInventory()->setContents($inventory->getContents());
                });
                $enderchest->send($sender);
                $sender->sendMessage("§6EnderChest!");
            } else {
                $enderchest = InvMenu::create(InvMenuTypeIds::TYPE_HOPPER);
                $enderchest->getInventory()->setContents($sender->getEnderInventory()->getContents());
                $enderchest->setInventoryCloseListener(function (Player $player, Inventory $inventory) {
                    $player->getEnderInventory()->setContents($inventory->getContents());
                });
                $enderchest->send($sender);
                $sender->sendMessage("§6EnderChest!");
            }
        }

        if (isset($args[0]) == "enderinfo") {
            if (!isset($args[1])) {
                $sender->sendMessage('§6By SlaxxyQC');
            }
        }
    }
}