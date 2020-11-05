<?php

declare(strict_types=1);

namespace App;

class GildedRose
{
    public static string $agedBrie = "Aged Brie";
    public static string $backstage = "Backstage passes to a TAFKAL80ETC concert";
    public static string $sulfuras = "Sulfuras, Hand of Ragnaros";
    public static string $conjured = "Conjured";
    
    public static function updateQuality($items)
    {

        for ($i = 0; $i < count($items); $i++) {
            if ((self::$agedBrie != $items[$i]->getName()) && (self::$backstage != $items[$i]->getName())) {
                if ($items[$i]->getQuality() > 0) {
                    if (self::$sulfuras != $items[$i]->getName()) {
                        $items[$i]->setQuality($items[$i]->getQuality() - 1);
                    }
                }
            } else {
                if ($items[$i]->getQuality() < 50) {
                    $items[$i]->setQuality($items[$i]->getQuality() + 1);
                    if (self::$backstage == $items[$i]->getName()) {
                        if ($items[$i]->getSellIn() < 11) {
                            if ($items[$i]->getQuality() < 50) {
                                $items[$i]->setQuality($items[$i]->getQuality() + 1);
                            }
                        }
                        if ($items[$i]->getSellIn() < 6) {
                            if ($items[$i]->getQuality() < 50) {
                                $items[$i]->setQuality($items[$i]->getQuality() + 1);
                            }
                        }
                    }
                }
            }

            if (self::$sulfuras != $items[$i]->getName()) {
                $items[$i]->setSellIn($items[$i]->getSellIn() - 1);
            }

            if ($items[$i]->getSellIn() < 0) {
                if (self::$agedBrie != $items[$i]->getName()) {
                    if (self::$backstage != $items[$i]->getName()) {
                        if ($items[$i]->getQuality() > 0) {
                            if (self::$sulfuras != $items[$i]->getName()) {
                                $items[$i]->setQuality($items[$i]->getQuality() - 1);
                            }
                        }
                    } else {
                        $items[$i]->setQuality($items[$i]->getQuality() - $items[$i]->getQuality());
                    }
                } else {
                    if ($items[$i]->getQuality() < 50) {
                        $items[$i]->setQuality($items[$i]->getQuality() + 1);
                    }
                }
            }
        }
    }

    public function addQuality ($item)
    {
        return $item->getQuality() + 1;
    }
}
