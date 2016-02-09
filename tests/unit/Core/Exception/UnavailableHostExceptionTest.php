<?php

use Screeenly\Core\Exception\UnavailableHostException;

class UnavailableHostExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception()
    {
        $this->setExpectedException(
                UnavailableHostException::class, 'Message'
            );
        throw new UnavailableHostException('Message', 10);
    }
}
