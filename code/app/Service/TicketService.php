<?php

namespace App\Service;

use App\Filter\Ticket\TicketFilter;
use App\Models\Client;
use App\Models\Order;
use App\Models\Ticket;
use App\Repository\TicketRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \Dotenv\Exception\ValidationException;

class TicketService
{

    /**
     * @var TicketRepository
     */
    protected $ticketRepository;

    /**
     * @var ClientService
     */
    protected $clientService;

    /**
     * @var OrderService
     */
    protected $orderService;

    /**
     * TicketService constructor.
     *
     * @param TicketRepository $ticketRepository
     * @param ClientService $clientService
     * @param OrderService $orderService
     */
    public function __construct(TicketRepository $ticketRepository, ClientService $clientService, OrderService $orderService)
    {
        $this->ticketRepository = $ticketRepository;
        $this->clientService = $clientService;
        $this->orderService = $orderService;
    }

    /**
     * Method to get all tickets without Pagination
     *
     * @param Request $request
     * @return mixed
     */
    public function allWithoutPaginate(Request $request)
    {
        //LineFilter::apply($this->lineRepository, $request);
        return $this->ticketRepository->all();
    }

    /**
     * Method to list tickets
     *
     * @param Request $request
     * @return mixed
     */
    public function all(Request $request)
    {
        TicketFilter::apply($this->ticketRepository, $request);

        return $this->ticketRepository->all();
    }

    /**
     * Method to get ticket information
     *
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->ticketRepository->find($id);
    }

    /**
     * Method to create ticket
     *
     * @param $data
     * @return array
     */
    public function create($data)
    {
        DB::beginTransaction();

        try {
            unset($data['_token']);

            $client = $this->clientService->findByEmail($data['email']);

            if (!$client) {
                $client = new Client();
                $client->fill($data);
                $client->save();
            }

            $order = $this->orderService->findByNumber($data['number']);

            if (!$order) {
                $order = new Order();
                $order->fill($data);
                $order->client_id = $client->id;
                $order->save();
            }

            if($order->client_id != $client->id) {
                throw new ValidationException("O pedido de n° {$order->number} já esta cadastrado para o cliente: {$order->client->name} .");
            }

            $ticket = new Ticket();
            $ticket->fill($data);
            $ticket->order_id = $order->id;

            $ticket->save();
            DB::commit();

            return [
                'status' => '00'
            ];

        } catch (\Exception $e) {
            DB::rollback();
            return ['status' => '01', 'message' => $e->getMessage()];
        }
    }

    /**
     * Method to update ticket
     *
     * @param $id
     * @param $data
     * @return array
     */
    public function update($id, $data)
    {
        if (!$id) {
            return ['status' => '01'];
        }

        DB::beginTransaction();

        try {
            unset($data['_method'], $data['_token']);

            $data['usualt'] = Auth::user()->idusuario;

            $return = $this->lineRepository->update($data, $id, 'idlinha');

            if ($return) {
                $status = $this->getFilesName($data["car"]);
                if ($status) {
                    $this->createFolders($id);
                    $statusMove = $this->moveFile($status['linha'], $data['car'], $id);

                    if ($statusMove) {
                        $post = [
                            'img' => $status['linha'][0]
                        ];

                        $update = $this->lineRepository->update($post, $id, 'idlinha');

                        if ($update) {
                            if ($this->removeCar($data['car'])) {
                                DB::commit();
                                $return = ['status' => '00', 'id' => $id];
                            }
                        }
                    }
                }else{
                    DB::commit();
                    $return = ['status' => '00', 'id' => $id];
                }
            } else {
                DB::rollback();
                $return = ['status' => '01', 'message' => 'Ocorreu um erro'];
            }

            return $return;

            DB::rollback();
            return ['status' => '01', 'message' => 'Ocorreu um erro!'];
        } catch (\Exception $e) {
            DB::rollback();
            return ['status' => '01', 'message' => $e->getMessage()];
        }
    }

    /**
     * Method to delete ticket
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $dir = public_path('../storage/app/public/linha/linha_' . $id);

        if(is_dir($dir)){
            $this->clearFolder($dir);
        }

        $this->lineRepository->find($id);

        try {
            $this->lineRepository->delete($id);
            return ['status' => '00'];
        } catch (\Exception $e) {
            return ['status' => '01'];
        }
    }
}