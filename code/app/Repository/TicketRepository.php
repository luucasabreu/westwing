<?php

namespace App\Repository;

class TicketRepository extends AbstractRepository
{
    public function model()
    {
        return 'App\Models\Ticket';
    }

    public function all(array $columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model
            ->join('order', 'order.id', '=', 'ticket.order_id')
            ->join('client', 'client.id', '=', 'order.client_id')
            ->paginate(5);
    }
}