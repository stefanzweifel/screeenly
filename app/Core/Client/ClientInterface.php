<?php

namespace Screeenly\Core\Client;

interface ClientInterface
{
    public function build();

    public function capture($url, $key = null);
}
