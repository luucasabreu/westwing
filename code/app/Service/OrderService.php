<?php

namespace App\Service;

use App\Repository\OrderRepository;

class OrderService
{

    protected $orderRepository;

    /**
     * OrderService constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Method to find order by number
     * @param $number
     * @return mixed
     */
    public function findByNumber($number)
    {
        return $this->orderRepository->findBy('number', $number);
    }
}