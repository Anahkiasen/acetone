<?php
use Acetone\Collection;

class CollectionTest extends AcetoneTests
{
	public function testCanCreateCollection()
	{
		$collection = new Collection('foobar');

		$this->assertInstanceOf('Acetone\Collection', $collection);
		$this->assertInstanceOf('Illuminate\Support\Collection', $collection);
	}

	public function testCanGetAndSetCollectionName()
	{
		$collection = new Collection('foobar');
		$this->assertEquals('foobar', $collection->getName());

		$collection->setName('changed');
		$this->assertEquals('changed', $collection->getName());
	}

	public function testCanSetAssets()
	{
		$collection = new Collection('foobar');
		$collection->setAssets(array(
			__DIR__.'/dummies/test.css',
			__DIR__.'/dummies/test.js',
		));

		$this->assertEquals('test.css', $collection[0]->getBasename());
		$this->assertEquals('test.js', $collection[1]->getBasename());
	}

	public function testCanCreateCollectionWithAssetsViaArray()
	{
		$collection = new Collection('foobar', array(
			__DIR__.'/dummies/test.css',
			__DIR__.'/dummies/test.js',
		));

		$this->assertEquals('test.css', $collection[0]->getBasename());
		$this->assertEquals('test.js', $collection[1]->getBasename());
	}
}