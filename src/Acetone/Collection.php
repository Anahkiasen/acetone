<?php
namespace Acetone;

/**
 * A collection of assets
 */
class Collection extends \Illuminate\Support\Collection
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
		foreach ($assets as $key => $value) {
			$assets[$key] = new Asset($value);
		}

		$this->items = $assets;
	}

	////////////////////////////////////////////////////////////////////
	///////////////////////////////// NAME /////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Set the name of the collection
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Get the name of the collection
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
}