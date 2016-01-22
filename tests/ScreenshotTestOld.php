<?php

use Screeenly\Screenshot\Screenshot;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScreenshotTestOld extends TestCase
{
use DatabaseMigrations, DatabaseTransactions;

    public function testIsInstanceOfScreenshot()
    {
        $screenshot = new Screenshot();
        $this->assertInstanceOf('Screeenly\Screenshot\Screenshot', $screenshot);
    }

    public function testCheckAttributesAfterConstruct()
    {
        $screenshot = new Screenshot();

        $this->assertObjectHasAttribute('client', $screenshot);
        $this->assertObjectHasAttribute('path', $screenshot);
        $this->assertAttributeEmpty('assetPath', $screenshot);
        $this->assertAttributeEmpty('url', $screenshot);
        $this->assertAttributeEmpty('width', $screenshot);
        $this->assertAttributeEmpty('height', $screenshot);
        $this->assertAttributeEmpty('filename', $screenshot);
        $this->assertAttributeEmpty('assetPath', $screenshot);
        $this->assertAttributeEmpty('base64', $screenshot);
    }

    public function testhasViewportHeight()
    {
        $screenshot = new Screenshot();
        $this->assertObjectHasAttribute('viewportHeight', $screenshot);
        $this->assertAttributeEquals(768, 'viewportHeight', $screenshot);
    }

    public function testHasSetStoragePath()
    {
        $screenshot = new Screenshot();
        $screenshot->setStoragePath('filename.jpg');

        $this->assertObjectHasAttribute('assetPath', $screenshot);
        $this->assertObjectHasAttribute('storagePath', $screenshot);

        $this->assertAttributeNotEmpty('assetPath', $screenshot);
    }

    /**
     * @expectedException Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function testScreenshotDoesnExist()
    {
        $screenshot = new Screenshot();
        $screenshot->setStoragePath('filename.jpg');

        File::get($screenshot->storagePath);
    }
}
