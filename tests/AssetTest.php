<?php
use Acetone\Asset;

class AssetTest extends AcetoneTests
{
	public function testCanGetContentsOfAsset()
	{
		$asset = new Asset(__DIR__.'/dummies/test.css');

		$this->assertEquals('body {
	color: red;
}', $asset->getContents());
	}
}