<?php

class AcetoneTest extends AcetoneTests
{
	public function testCanShowCollection()
	{
		$this->app['acetone.acetone']->collection('foobar', array(
			__DIR__.'/dummies/test.css',
			__DIR__.'/dummies/test.js',
			__DIR__.'/dummies/test2.css',
		));

		$html = $this->app['acetone.acetone']->show('foobar.css');
		$this->assertEquals('<link media="all" type="text/css" rel="stylesheet" href="http://test/tests/dummies/test.css">
<link media="all" type="text/css" rel="stylesheet" href="http://test/tests/dummies/test2.css">', $html);
	}

	public function testCanShowProductionCollection()
	{
		$this->app['env'] = 'production';
		$this->app['acetone.acetone']->collection('foobar', array(
			__DIR__.'/dummies/test.css',
			__DIR__.'/dummies/test.js',
			__DIR__.'/dummies/test2.css',
		));

		$html = $this->app['acetone.acetone']->show('foobar.js');
		$this->assertEquals('<link media="all" type="text/css" rel="stylesheet" href="http://test/tests/dummies/test.min.js">', $html);
	}
}