<?php
namespace Acetone\Facades;

use Illuminate\Support\Facades\Facade;
use Acetone\AcetoneServiceProvider;

/**
 * A Facade for Acetone
 */
class Acetone extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		if (!static::$app) {
			static::$app = AcetoneServiceProvider::make();
		}

		return 'acetone.acetone';
	}
}
