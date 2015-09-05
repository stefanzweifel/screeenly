<?php

namespace Screeenly\Core\Screeenshot;

interface ScreenshotInterface
{
    public function setHeight($height);

    public function getHeight();

    public function getWidth();

    public function setWidth($width);

    public function setRequestUrl($requestUrl);

    public function getRequestUrl();

    public function getBase64();
}
