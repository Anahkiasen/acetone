<?php
namespace Acetone;

use Illuminate\Http\Request;
use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Html\HtmlBuilder;
use Illuminate\Container\Container;

/**
 * Bind the various Acetone classes to Laravel
 */
class AcetoneServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// ...
	}

	/**
	 * Bind classes and commands
	 *
	 * @return void
	 */
	public function boot()
	{
		// Register classes and commands
		$this->app = static::make($this->app);
	}

	////////////////////////////////////////////////////////////////////
	/////////////////////////// CLASS BINDINGS /////////////////////////
	////////////////////////////////////////////////////////////////////

	/**
	 * Make a Acetone container
	 *
	 * @return Container
	 */
	public static function make($app = null)
	{
		if (!$app) {
			$app = new Container;
		}

		$serviceProvider = new static($app);

		// Bind classes
		$app = $serviceProvider->bindCoreClasses($app);
		$app = $serviceProvider->bindClasses($app);

		return $app;
	}

	/**
	 * Bind the core classes
	 *
	 * @param  Container $app
	 *
	 * @return Container
	 */
	public function bindCoreClasses(Container $app)
	{
		$app->bindIf('files', 'Illuminate\Filesystem\Filesystem');

		$app->bindIf('request', function ($app) {
			return Request::createFromGlobals();
		});

		$app->bindIf('url', function($app) {
			$routes = new RouteCollection;

			return new UrlGenerator($routes, $app['request']);
		});

		$app->bindIf('html', function ($app) {
			return new HtmlBuilder($app['url']);
		});

		$app->bindIf('path.public', function() {
			return realpath(__DIR__.'/../../');
		});

		return $app;
	}

	/**
	 * Bind the Acetone classes to the Container
	 *
	 * @param  Container $app
	 *
	 * @return Container
	 */
	public function bindClasses(Container $app)
	{
		$app->singleton('acetone.acetone', function ($app) {
			return new Acetone($app);
		});

		return $app;
	}
}
