<?php

use Screeenly\Core\Exception\ScreenshotNotExistsException;

class ScreenshotNotExistsExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception()
    {
        $this->setExpectedException(
                ScreenshotNotExistsException::class, 'Message'
            );
        throw new ScreenshotNotExistsException('Message', 10);
    }
}
