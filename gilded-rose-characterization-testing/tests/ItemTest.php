<?php

namespace GildedRose\Test;

use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    /** @test */
    public function string_conversion_shows_all_fields()
    {
        $item = new Item("aName", 10, 20);

        $text = (string) $item;

        $this->assertEquals("aName,10,20", $text);
    }
}
