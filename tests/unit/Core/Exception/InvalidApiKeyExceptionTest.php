<?php

use Screeenly\Core\Exception\InvalidApiKeyException;

class InvalidApiKeyExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception()
    {
        $this->setExpectedException(
                InvalidApiKeyException::class, 'Message'
            );
        throw new InvalidApiKeyException('Message', 10);
    }
}
