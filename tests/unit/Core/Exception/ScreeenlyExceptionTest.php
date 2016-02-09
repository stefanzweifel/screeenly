<?php

use Screeenly\Core\Exception\ScreeenlyException;

class ScreeenlyExceptionTest extends TestCase
{
    /**
     * @test
     */
    public function it_throws_exception()
    {
        $this->setExpectedException(
                ScreeenlyException::class, 'Message'
            );
        throw new ScreeenlyException('Message', 10);
    }
}
