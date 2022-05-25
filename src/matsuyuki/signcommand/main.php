<?php

namespace matsuyuki\signcommand;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\block\BaseSign;
use pocketmine\event\player\PlayerInteractEvent;

class main extends PluginBase implements Listener {

   public function onEnable():void {

       $this->getServer()->getPluginManager()->registerEvents($this, $this);

   }

    public function onTap(PlayerInteractEvent $event):void {

       $block = $event->getBlock();
        if ($block->getId() != 63 && $block->getId() != 68) { //タップしたブロックが看板じゃないなら返す
            return;
        }
        $sign = $event->getPlayer()->getWorld()->getBlock($block->getPosition());
        if (!($sign instanceof BaseSign)) { //本当は21行目と25行目はどっちか1個でいいんだけど、一応...ね((
            return;
        }
        $txtf = $sign->getText();
        if (substr($txtf->getLine(0), 0, 1) === "/") { //看板の最初の文字が「/」なら
            $contents = $txtf->getLines();
            $content = "";
            foreach ($contents as $i) {
                $content = $content. $i;
            }
            $event->getPlayer()->chat($content);
        }

    }


}
