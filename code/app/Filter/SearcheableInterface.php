<?php

namespace App\Filter;

interface SearcheableInterface
{
    /**
     * Return const value __NAMESPACE__
     * @return string
     */
    public static function getNamespace();
}