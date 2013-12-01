<?php
include __DIR__.'/../vendor/autoload.php';

use Acetone\AcetoneServiceProvider;

abstract class AcetoneTests extends PHPUnit_Framework_TestCase
{
	protected $app;

	public function setUp()
	{
		$this->app = AcetoneServiceProvider::make();

		$request = Mockery::mock('Illuminate\Http\Request');
		$request->shouldReceive('getScheme')->andReturn('http');
		$request->shouldReceive('root')->andReturn('http://test');

		$this->app['request'] = $request;
		$this->app['env'] = 'local';
		$this->app['path.public'] = __DIR__;
	}
}