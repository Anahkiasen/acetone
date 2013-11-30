<?php
namespace Acetone;

use Illuminate\Container\Container;

class Acetone
{
	/**
	 * The registered collections
	 *
	 * @var array
	 */
	protected $collections = array();

	/**
	 * The Container
	 *
	 * @var Container
	 */
	protected $app;

	/**
	 * Build a new Acetone instance
	 *
	 * @param Container $app
	 */
	public function __construct(Container $app)
	{
		$this->app = $app;
	}

	/**
	 * Register a Collection
	 *
	 * @param string $name
	 * @param array  $assets
	 *
	 * @return Collection
	 */
	public function collection($name, $assets)
	{
		$this->collections[$name] = new Collection($name, $assets);
	}

	/**
	 * Show a particular collection
	 *
	 * @param string $collection
	 *
	 * @return Collection
	 */
	public function show($collection)
	{
		list($name, $type) = explode('.', $collection);
		$contents = '';

		if ($collection = array_get($this->collections, $name)) {
			$assets = (array) $collection->get($type);
			foreach ($assets as $asset) {
				$contents .= $this->app['html']->style($this->getPath($asset));
			}
		}

		return trim($contents);
	}

	/**
	 * Get the path of an asset
	 *
	 * @param Asset $asset
	 *
	 * @return string
	 */
	protected function getPath(Asset $asset)
	{
		$path = str_replace($this->app['path.public'], null, $asset->getRealpath());
		$path = $this->app['env'] == 'local' ? $path : str_replace('.'.$asset->getExtension(), '.min.'.$asset->getExtension(), $path);

		return $path;
	}
}