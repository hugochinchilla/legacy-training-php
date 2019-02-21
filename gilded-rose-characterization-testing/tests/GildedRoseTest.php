<?php

namespace GildedRose\Test;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /** @test */
    public function name_remains_unchanged()
    {
        /** @var Item[] $items */
        $items = array(new Item("aName", 10, 20));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals("aName", $items[0]->name);
    }

    /** @test */
    public function sell_in_is_decremented_by_one()
    {
        /** @var Item[] $items */
        $items = array(new Item("aName", 9, 20));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(8, $items[0]->sell_in);
    }
}
