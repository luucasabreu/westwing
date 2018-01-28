@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-lg-12" style="text-align: center">
                        <h1>Olá {{ Auth::user()->name }}. Seja bem vindo</h1>
                        <h4>Gestão de Chamados</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
