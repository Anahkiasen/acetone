<?php
namespace Acetone;

use Illuminate\Container\Container;
use Illuminate\Support\Str;

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
		$assets = (array) $assets;
		foreach ($assets as $key => $asset) {
			$assets[$key] = $asset;
		}

		$this->collections[$name] = new Collection($name, $assets);
	}

	/**
	 * Show a particular collection
	 *
	 * @param string $collection
	 *
	 * @return Collection
	 */
	public function show($name, $type = null)
	{
		$contents = '';
		if (!$type) {
			list($name, $type) = explode('.', $name);
		}

		if ($collection = array_get($this->collections, $name)) {
			$assets = (array) $collection->get($type);
			foreach ($assets as $asset) {
				$path = $this->getPath($asset);
				if (!$asset->isRemote() and !file_exists(public_path($path))) {
					continue;
				}

				$type = $asset->getExtension() == 'css' ? 'style' : 'script';
				$path = str_replace($this->app['path.public'], null, $path);
				$contents .= $this->app['html']->$type($path);
			}
		}

		return trim($contents);
	}

	/**
	 * Display multiple CSS files directly
	 *
	 * @param array $assets
	 *
	 * @return string
	 */
	public function stylesheets($assets)
	{
		$name = sizeof($this->collections);
		$this->collection($name, $assets);

		return $this->show($name, 'css');
	}

	/**
	 * Display multiple JS files directly
	 *
	 * @param array $assets
	 *
	 * @return string
	 */
	public function scripts($assets)
	{
		$name = sizeof($this->collections);
		$this->collection($name, $assets);

		return $this->show($name, 'js');
	}

	////////////////////////////////////////////////////////////////////
	//////////////////////////////// ASSETS ////////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Get the path of an asset
	 *
	 * @param Asset $asset
	 *
	 * @return string
	 */
	protected function getPath(Asset $asset)
	{
		return $this->app['env'] == 'local' ? $asset->getRealpath() : $asset->getMinifiedPath();
	}
}