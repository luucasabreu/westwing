<?php

namespace App\Filter\Ticket;

use App\Filter\SearcheableInterface;
use App\Filter\SearcheableTrait;

class TicketFilter implements SearcheableInterface
{
    use SearcheableTrait;

    /**
     * Return const value __NAMESPACE__
     * @return string
     */
    public static function getNamespace()
    {
        return __NAMESPACE__;
    }
}