<?php


// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Screeenly\Core\Screeenshot\AbstractScreenshot;
use Screeenly\Core\Screeenshot\Screenshot;
use Screeenly\Core\Screeenshot\ScreenshotInterface;

class ScreenshotTest extends TestCase
{
    /**
     * Return Mocked Abstract Class
     * (Mock by PHPUnit).
     */
    protected function getClass()
    {
        return app()->make(Screenshot::class);
    }

    /**
     * @test
     */
    public function it_extends_abstract_screenshot()
    {
        $screenshot = $this->getClass();

        $this->assertInstanceOf(AbstractScreenshot::class, $screenshot);
    }

    /**
     * @test
     */
    public function it_implements_screenshot_interface()
    {
        $screenshot = $this->getClass();

        $this->assertInstanceOf(ScreenshotInterface::class, $screenshot);
    }
}
