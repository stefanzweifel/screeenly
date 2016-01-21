<?php


    function setActive($route, $class = 'bg-orange black')
    {
        return (Route::currentRouteName() == $route) ? $class : '';
    }
