<?php


    function setActive($route, $class = 'active')
    {
        return (Route::currentRouteName() == $route) ? $class : '';
    }
