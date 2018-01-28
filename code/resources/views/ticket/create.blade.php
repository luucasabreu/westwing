@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="main-title">
                <div class="col-sm-10 col-xs-8">
                    <h2>Adicionar Chamado</h2>
                </div>
            </div>

            <div class="line"></div>

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{ route('ticket.store') }}" method="post" class="add-store">
                            {{ csrf_field() }}

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($message = session('message'))
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @endif

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">Nome Cliente</label>
                                    <input name="name" type="text" id="name" class="form-control" placeholder="Nome do Cliente" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">E-mail</label>
                                    <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="name">N° do Pedido</label>
                                    <input name="number" type="number" id="number" class="form-control" placeholder="N° do Pedido" value="{{ old('number') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="name">Título</label>
                                    <input name="title" type="text" id="title" class="form-control" placeholder="Título" value="{{ old('title') }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="obs">Observa&ccedil;&otilde;es</label>
                                    <textarea class="form-control" id="note" name="note" rows="4">{{ old('note') }}</textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary pull-right submit-form">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection