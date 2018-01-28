<?php

namespace App\Repository;

class OrderRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\Order';
    }
}