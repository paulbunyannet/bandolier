<?php

namespace Tests\Type\Collection;

/**
 * CollectionTest
 *
 * Created 6/9/17 12:54 PM
 * Tests for collection
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package ${NAMESPACE}
 */

use Pbc\Bandolier\Exception\Collection\KeyHasUseException;
use Pbc\Bandolier\Exception\Collection\KeyInvalidException;
use Pbc\Bandolier\Type\Collection;
use Tests\BandolierTestCase;

class CollectionTest extends BandolierTestCase
{

    /**
     * Test Collection can add item without key name
     * @test testCollectionCanAddItemWithoutKeyName
     * @group Collection
     */
    public function testCollectionCanAddItemWithoutKeyName()
    {
        $item = self::$faker->sentence();
        $collection = new Collection();
        $collection->addItem($item);
        $this->assertArrayHasKey(0, $collection->getItems());
        $this->assertSame($item, $collection->getItem(0));
    }

    /**
     * Test Collection can add an item with a key name
     * @test testCollectionCanAddAnItemWithAKeyName
     * @group Collection
     */
    public function testCollectionCanAddAnItemWithAKeyName()
    {
        $value = self::$faker->sentence();
        $key = implode('-', self::$faker->words());
        $collection = new Collection();
        $collection->addItem($value, $key);
        $this->assertArrayHasKey($key, $collection->getItems());
        $this->assertSame($value, $collection->getItem($key));
    }

    /**
     * Test Collection can add an items with key name pairs
     * @test testCollectionCanAddAnItemWithAKeyName
     * @group Collection
     */
    public function testCollectionCanAddAnItems()
    {
        $collection = new Collection();
        $list = ['foo' => 'bar', 'bar' => 'bizz'];
        $collection->addItems($list);
        $this->assertArrayHasKey('foo', $collection->getItems());
        $this->assertSame($list['foo'], $collection->getItem('foo'));
        $this->assertArrayHasKey('bar', $collection->getItems());
        $this->assertSame($list['bar'], $collection->getItem('bar'));
    }



    /**
     * Test Collection when adding an item it will throw an exception if key already exists
     * @test testCollectionWhenAddingAnItemItWillThrowAnExceptionIfKeyAlreadyExists
     * @group Collection
     */
    public function testCollectionWhenAddingAnItemItWillThrowAnExceptionIfKeyAlreadyExists()
    {
        $this->expectException(KeyHasUseException::class);
        $value = self::$faker->sentence();
        $key = implode('-', self::$faker->words());
        $collection = new Collection();
        $collection->addItem($value, $key);
        $collection->addItem($value, $key);

    }

    /**
     * Test Collection when setting an item with a missing key throws an exception
     * @test testCollectionWhenSettingAnItemWithKeyOfNoneTrueThrowsAnException
     * @group Collection
     */
    public function testCollectionWhenSettingAnItemWithKeyIsMissingThrowsAnException()
    {
        $this->expectException(KeyInvalidException::class);
        $this->expectExceptionMessage('Invalid key foo-bar.');
        $item = self::$faker->sentence();
        $collection = new Collection();
        $collection->setItem($item, 'foo-bar');
    }

    /**
     * Test Collection can set an item that exists
     * @test testCollectionCanSetAnItemThatExists
     * @group Collection
     */
    public function testCollectionCanSetAnItemThatExists()
    {
        $item = self::$faker->sentence();
        $key = implode('-', self::$faker->words());
        $collection = new Collection();
        $collection->addItem(['foo', 'var', 'baz'], $key);
        $collection->setItem($item, $key);
        $this->assertSame($item, $collection->getItem($key));
    }

    /**
     * Test Collection can get a key by name
     * @test testCollectionCanGetAKeyByName
     * @group Collection
     */
    public function testCollectionCanGetAKeyByName()
    {
        $item = self::$faker->sentence();
        $key = implode('-', self::$faker->words());
        $collection = new Collection();
        $collection->addItem($item, $key);
        $this->assertSame($item, $collection->getItem($key));
    }

    /**
     * Test Collection when getting a key will thow an exception if it does not exist
     * @test testCollectionWhenGettingAKeyWillThowAnExceptionIfItDoesNotExist
     * @group Collection
     */
    public function testCollectionWhenGettingAKeyWillThowAnExceptionIfItDoesNotExist()
    {
        $this->expectException(KeyInvalidException::class);
        $key = implode('-', self::$faker->words());
        $collection = new Collection();
        $collection->getItem($key);
    }

    /**
     * Test Collection can delete a key
     * @test testCollectionCanDeleteAKey
     * @group Collection
     */
    public function testCollectionCanDeleteAKey()
    {
        $item = self::$faker->sentence();
        $key = implode('-', self::$faker->words());
        $collection = new Collection();
        $collection->addItem($item, $key);
        $collection->deleteItem($key);
        $this->assertArrayNotHasKey($key, array_flip($collection->keys()));
    }

    /**
     * Test Collection when deleting a key that does not exist an exception will be thown
     * @test testCollectionWhenDeletingAKeyThatDoesNotExistAnExceptionWillBeThown
     * @group Collection
     */
    public function testCollectionWhenDeletingAKeyThatDoesNotExistAnExceptionWillBeThown()
    {
        $this->expectException(KeyInvalidException::class);
        $collection = new Collection();
        $collection->deleteItem('foo');
    }

    /**
     * Test Collection can get a listing of all the keys
     * @test testCollectionCanGetAListingOfAllTheKeys
     * @group Collection
     */
    public function testCollectionCanGetAListingOfAllTheKeys()
    {
        $keys = ['foo', 'bar', 'baz'];
        $collection = new Collection();
        for ($i = 0, $iCount = count($keys); $i < $iCount; $i++) {
            $collection->addItem(self::$faker->md5, $keys[$i]);
        }

        $this->assertSame($keys, $collection->keys());
    }

    /**
     * Test Collection can get the length of the key list
     * @test testCollectionCanGetTheLengthOfTheKeyList
     * @group Collection
     */
    public function testCollectionCanGetTheLengthOfTheKeyList()
    {
        $keys = ['foo', 'bar', 'baz'];
        $collection = new Collection();
        for ($i = 0, $iCount = count($keys); $i < $iCount; $i++) {
            $collection->addItem(self::$faker->md5, $keys[$i]);
        }

        $this->assertSame(count($keys), $collection->length());
    }

    /**
     * Test Collection can check if a key exsits
     * @test testCollectionCanCheckIfAKeyExsits
     * @group Collection
     */
    public function testCollectionCanCheckIfAKeyExsits()
    {
        $keys = ['foo', 'bar', 'baz'];
        $collection = new Collection();
        for ($i = 0, $iCount = count($keys); $i < $iCount; $i++) {
            $collection->addItem(self::$faker->md5, $keys[$i]);
            $this->assertTrue($collection->keyExists($keys[$i]));
        }

        $this->assertFalse($collection->keyExists('nope'));
    }

}
