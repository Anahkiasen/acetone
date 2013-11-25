<?php
namespace Acetone;

use SplFileObject;

/**
 * An asset in a collection
 */
class Asset extends SplFileObject
{
	/**
	 * Get the Asset's contents
	 *
	 * @return string
	 */
	public function getContents()
	{
		return file_get_contents($this->getRealPath());
	}
}