<?php

namespace App\Filter;

use Illuminate\Http\Request;
use App\Repository\Contracts\CriteriaInterface;

trait SearcheableTrait
{
    public static function apply(CriteriaInterface $repository, Request $filters)
    {
        static::applyDecoratorsFromRequest($filters, $repository);
    }

    private static function applyDecoratorsFromRequest(Request $request, CriteriaInterface $repository)
    {
        foreach ($request->all() as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);
            if (static::isValidDecorator($decorator)) {
                $repository->pushCriteria(new $decorator($value));
            }
        }
    }

    private static function createFilterDecorator(string $name)
    {
        return static::getNamespace() . '\\Conditions\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));
    }

    private static function isValidDecorator(string $decorator)
    {
        return class_exists($decorator);
    }
}