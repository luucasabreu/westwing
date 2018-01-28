<?php

namespace App\Http\Controllers;

//use App\Modules\Gestao\Http\Requests\LineRequest;
use App\Http\Requests\TicketRequest;
use App\Service\TicketService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TicketController extends Controller {

    /**
     * @var TicketService
     */
    protected $ticketService;

    /**
     * LineController constructor.
     *
     * @param TicketService $ticketService
     */
    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * Tickets list
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var LengthAwarePaginator $tickets */
        $tickets = $this->ticketService->all($request);

        return view('ticket.index', compact('tickets'));
    }

    /**
     * Method to create ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Method to create ticket in database
     *
     * @param TicketRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TicketRequest $request)
    {
        $return = $this->ticketService->create($request->all());

        if($return['status'] == '00'){
            return redirect(route('ticket'))->with('success', 'Chamado adicionado com sucesso');
        }

        return redirect()->back()->with('message', $return['message'])->withInput($request->all());
    }

    /**
     * Method to delete line
     *
     * @param $id
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize('excluir_linha');

        $return = $this->lineService->delete($id);

        return \Response::json($return);
    }
}