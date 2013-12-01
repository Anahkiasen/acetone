<?php
namespace Acetone;

use SplFileInfo;
use Illuminate\Support\Str;

/**
 * An asset in a collection
 */
class Asset extends SplFileInfo
{
	/**
	 * Check if an asset is remote
	 *
	 * @return boolean
	 */
	public function isRemote()
	{
		return Str::startsWith($this->getPath(), 'http') || Str::startsWith($this->getPath(), '//');
	}

	/**
	 * Get the path to an asset
	 *
	 * @return string
	 */
	public function getRealpath()
	{
		$path = parent::getRealpath();
		$path = $path ?: $this->getPath().'/'.$this->getBasename();

		return $path;
	}

	/**
	 * Get the minified version of the path
	 *
	 * @return string
	 */
	public function getMinifiedPath()
	{
		$extension = $this->getExtension();

		return str_replace('.'.$extension, '.min.'.$extension, $this->getRealpath());
	}
}