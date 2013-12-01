<?php
namespace Acetone;

use SplFileObject;

/**
 * An asset in a collection
 */
class Asset extends SplFileObject
{
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