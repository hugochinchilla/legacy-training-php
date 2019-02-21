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
        $items = array(new Item("aName", 10, 20));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(9, $items[0]->sell_in);
    }

    /** @test */
    public function quality_is_decremented_by_one()
    {
        /** @var Item[] $items */
        $items = array(new Item("aName", 10, 1));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(0, $items[0]->quality);
    }

    /** @test */
    public function quality_remains_equal_at_zero()
    {
        /** @var Item[] $items */
        $items = array(new Item("aName", 10, 0));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(0, $items[0]->quality);
    }

    /** @test */
    public function for_negative_sell_in_quality_decrements_by_two()
    {
        /** @var Item[] $items */
        $items = array(new Item("aName", -10, 3));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(1, $items[0]->quality);
    }

    /** @test */
    public function for_negative_sell_in_quality_decrements_by_two_until_zero()
    {
        /** @var Item[] $items */
        $items = array(new Item("aName", -10, 1));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(0, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_one_for_aged_brie()
    {
        /** @var Item[] $items */
        $items = array(new Item("Aged Brie", 10, 49));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(50, $items[0]->quality);
    }

    /** @test */
    public function quality_remains_equal_for_aged_brie_over_49_quality()
    {
        /** @var Item[] $items */
        $items = array(new Item("Aged Brie", 10, 50));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(50, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_two_for_aged_brie_with_negative_sell_in()
    {
        /** @var Item[] $items */
        $items = array(new Item("Aged Brie", -10, 20));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(22, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_3_for_passes_with_sellin_under_6()
    {
        /** @var Item[] $items */
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 5, 47));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(50, $items[0]->quality);
    }

    public function intsFrom6to10()
    {
      return [
        [6], [7], [8], [9], [10],
      ];
    }

    /**
     * @test
     * @dataProvider intsFrom6to10
     */
    public function quality_is_increased_by_2_for_passes_with_sellin_from_6_to_10($sellin)
    {
        /** @var Item[] $items */
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", $sellin, 48));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(50, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_1_for_passes_with_sellin_over_10()
    {
        /** @var Item[] $items */
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 11, 49));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(50, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_one_for_backstage_passes_over_xxxx()
    {
        /** @var Item[] $items */
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 11, 10));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(11, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_one_for_backstage_passes_over_10()
    {
        /** @var Item[] $items */
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 11, 49));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(50, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_one_until_50_is_reached_for_passes_with_sellin_over_10()
    {
        /** @var Item[] $items */
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 11, 50));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(50, $items[0]->quality);
    }

    /** @test */
    public function quality_is_increased_by_three_for_backstage_passes_with_sell_in_under_6()
    {
        /** @var Item[] $items */
        $items = array(new Item("Backstage passes to a TAFKAL80ETC concert", 5, 20));
        $gildedRose = new GildedRose($items);

        $gildedRose->update_quality();

        $this->assertEquals(23, $items[0]->quality);
    }
}
