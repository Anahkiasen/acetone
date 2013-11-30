<?php
namespace Acetone;

use Illuminate\Support\Collection as IlluminateCollection;

/**
 * A collection of assets
 */
class Collection extends IlluminateCollection
{
	/**
	 * The name of the collection
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * Build a new Collection
	 *
	 * @param string $name
	 * @param array  $assets
	 */
	public function __construct($name, array $assets = array())
	{
		$this->name = $name;
		$this->setAssets($assets);
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////////// ASSETS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set the collection's assets
	 *
	 * @param array $assets
	 */
	public function setAssets(array $assets = array())
	{
		$items = array();
		foreach ($assets as $key => $value) {
			$asset = new Asset($value);
			$items[$asset->getExtension()][] = $asset;
		}

		$this->items = $items;
	}
}