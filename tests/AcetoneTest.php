<?php

class AcetoneTest extends AcetoneTests
{
	public function testCanShowCollection()
	{
		$this->app['acetone.acetone']->collection('foobar', array(
			'dummies/test.css',
			'dummies/test.js',
			'dummies/test2.css',
		));

		$html = $this->app['acetone.acetone']->show('foobar.css');
		$this->assertEquals('<link media="all" type="text/css" rel="stylesheet" href="http://test/dummies/test.css">
<link media="all" type="text/css" rel="stylesheet" href="http://test/dummies/test2.css">', $html);
	}

	public function testCanShowProductionCollection()
	{
		$this->app['env'] = 'production';
		$this->app['acetone.acetone']->collection('foobar', array(
			'dummies/test.css',
			'dummies/test.js',
			'dummies/test2.css',
		));

		$html = $this->app['acetone.acetone']->show('foobar.js');
		$this->assertEquals('<script src="http://test/dummies/test.min.js"></script>', $html);
	}
}