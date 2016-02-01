<?php

use Screeenly\Core\Client\AbstractClient;
use Screeenly\Core\Client\ClientInterface;
use Screeenly\Core\Screeenshot\Screenshot;
use Illuminate\Contracts\Config\Repository as Config;

class AbstractClientTest extends TestCase
{
    /**
     * Return Mocked Abstract Class
     * (Mock by PHPUnit)
     */
    protected function getClass()
    {
        $screenshot = app()->make(Screenshot::class);

        return $this->getMockForAbstractClass(
            AbstractClient::class,
            array(
                $screenshot
            ));
    }

    public function testSettersandGetters()
    {
        $stub = $this->getClass();

        $this->assertEquals($stub->setHeight(1000), 1000);
        $this->assertEquals($stub->getHeight(), 1000);

        $this->assertEquals($stub->setWidth(1000), 1000);
        $this->assertEquals($stub->getWidth(), 1000);

        $this->assertEquals($stub->getViewportHeight(), 768);
    }

    public function testBootMethodReturnsAbstractClientInstance()
    {
        $stub = $this->getClass();

        $this->assertInstanceOf(AbstractClient::class, $stub);
    }

    public function testBootMethodReturnsClientInterfaceInstance()
    {
        $stub = $this->getClass();

        $this->assertInstanceOf(ClientInterface::class, $stub);
    }
}
