<?php

use Screeenly\Core\Exception\InvalidUrlException;

class InvalidUrlExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception()
    {
        $this->setExpectedException(
                InvalidUrlException::class, 'Message'
            );
        throw new InvalidUrlException('Message', 10);
    }
}
