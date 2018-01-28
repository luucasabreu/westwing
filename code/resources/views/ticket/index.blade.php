@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1>Relat&oacute;rio de chamados</h1>
            </div>

            <div class="col-lg-12">
                @if($succes = session('success'))
                    <div class="alert alert-success">
                        {{ $succes}}
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form>
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input type="email" name="email" class="form-control" placeholder="E-mail" value="{{ request('email') }}">
                                </div>

                                <div class="col-sm-4">
                                    <input type="number" name="number" class="form-control" placeholder="Número do Pedido" value="{{ request('number') }}">
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Filtrar <i class="fa fa-filter"></i></button>

                                @if(!empty(request('email')) || !empty(request('number')))
                                    <div class="btn btn-danger m-l-sm">
                                        <a href="{{ request()->url() }}" style="color:#fff">Limpar Filtros <i class="fa fa-trash"></i></a>
                                    </div>
                                @endif

                            </div>
                            <div class="col-sm-1">
                                <a href="{{ route('ticket.create') }}" class="btn btn-primary pull-right">Adicionar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>N° do Pedido</th>
                                    <th>Nome do Cliente</th>
                                    <th>Email do Cliente</th>
                                    <th>Título</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($tickets) > 0)
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{ (new \Carbon\Carbon($ticket->created_at))->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ $ticket->order->number }}</td>
                                            <td>{{ $ticket->order->client->name }}</td>
                                            <td>{{ $ticket->order->client->email }}</td>
                                            <td>{{ $ticket->title }}</td>
                                            <td>{{ $ticket->note }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Nenhum registro encontrado na Base de Dados.</td>
                                    </tr>
                                @endif
                            </tbody>
                            @if($tickets->total() > 5)
                                <tfoot>
                                <tr>
                                    <td colspan="6" class="footable-visible">
                                        {{ $tickets->appends(request()->input())->links() }}
                                    </td>
                                </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection