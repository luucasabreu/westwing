<?php

namespace App\Filter\Ticket\Conditions;

use App\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Email implements FilterInterface
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

        $field = DB::raw('UPPER(email)');
        $value = DB::connection()->getPdo()->quote("%{$this->value}%");
        $value = DB::raw("UPPER({$value})");

        $query = $model->where($field, 'LIKE', $value);

        return $query;
    }
}