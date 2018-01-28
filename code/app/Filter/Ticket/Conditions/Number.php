<?php

namespace App\Filter\Ticket\Conditions;

use App\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class Number implements FilterInterface
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $model
     * @return mixed
     */
    public function apply($model)
    {
        if(strlen($this->value) == 0){
            return $model;
        }

        $this->value = str_replace("'", '/', $this->value);

        $query = $model->where('number', '=', $this->value);

        return $query;
    }
}