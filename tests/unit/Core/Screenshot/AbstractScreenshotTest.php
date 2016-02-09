<?php

use Illuminate\Contracts\Filesystem\Filesystem as Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Screeenly\ApiKey;
use Screeenly\Core\Screeenshot\AbstractScreenshot;
use Screeenly\Core\Screeenshot\ScreenshotInterface;

class AbstractScreenshotTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Return Mocked Abstract Class
     * (Mock by PHPUnit).
     */
    protected function getClass()
    {
        $storage = app()->make(Storage::class);
        $apiKey = app()->make(ApiKey::class);

        return $this->getMockForAbstractClass(
            AbstractScreenshot::class,
            [
                $storage,
                $apiKey,
            ]);
    }

    /**
     * @test
     */
    public function it_generates_filename()
    {
        $screenshot = $this->getClass();

        $filename = $screenshot->generateFilename();

        $this->assertStringEndsWith('.jpg', $filename);
    }

    /**
     * @test
     */
    public function it_generates_filename_and_is_equal_to_getter()
    {
        $screenshot = $this->getClass();

        $filename = $screenshot->generateFilename();

        $this->assertEquals($filename, $screenshot->getFilename());
    }

    /**
     * @test
     */
    public function it_sets_default_storage_path()
    {
        $screenshot = $this->getClass();

        $defaultPath = \Config::get('screeenly.core.storage_path');

        $screenshot->setStoragePath();

        $this->assertEquals($defaultPath, $screenshot->getStoragePath());
    }

    /**
     * @test
     */
    public function it_overrides_default_storage_path()
    {
        $screenshot = $this->getClass();
        $defaultPath = \Config::get('screeenly.core.storage_path');
        $newPath = 'images/will/be/stored/here/';

        $screenshot->setStoragePath($newPath);

        $this->assertEquals($newPath, $screenshot->getStoragePath());
        $this->assertNotEquals($defaultPath, $screenshot->getStoragePath());
    }

    /**
     * @test
     */
    public function it_sets_api_key_to_null()
    {
        $screenshot = $this->getClass();
        $apiKey = null;

        $screenshot->setKey($apiKey);

        $this->assertEquals($screenshot->getKey(), null);
    }

    /**
     * @test
     */
    public function it_sets_api_key_to_db_model()
    {
        $screenshot = $this->getClass();

        // TODO: Implement Test
    }

    /**
     * @test
     * @expectedException Screeenly\Core\Exception\InvalidApiKeyException
     */
    public function it_throws_exception_for_wrong_api_key()
    {
        $screenshot = $this->getClass();

        // will throw exception
        $screenshot->setKey('this-key-does-not-exist');
    }

    /**
     * @test
     */
    public function it_checks_if_a_screenshot_exists()
    {
        $screenshot = $this->getClass();

        // TODO: Implement Test
        // See: https://laracasts.com/lessons/testing-with-virtual-file-systems
    }

    /**
     * @test
     * @expectedException Screeenly\Core\Exception\ScreenshotNotExistsException
     */
    public function it_throws_exception_if_screenshot_does_not_exist()
    {
        $screenshot = $this->getClass();

        $screenshot->generateFilename();
        $screenshot->setStoragePath();
        $screenshot->setFullStoragePath();

        // will throw exception
        $screenshot->doesScreenshotExist();
    }

    /**
     * @test
     */
    public function it_creates_directory_if_storage_path_does_not_exist()
    {
        $screenshot = $this->getClass();

        // TODO: Implement Test
    }

    /**
     * @test
     */
    public function it_is_instance_of_abstract_screenshot()
    {
        $stub = $this->getClass();

        $this->assertInstanceOf(AbstractScreenshot::class, $stub);
    }

    /**
     * @test
     */
    public function it_implements_screenshot_interface()
    {
        $stub = $this->getClass();

        $this->assertInstanceOf(ScreenshotInterface::class, $stub);
    }
}
