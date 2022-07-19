@extends('adminlte::page')

@section('title', "Editar o Plano {$plan->name}")

@section('content_header')
    <h1>Editar o Plano {{$plan->name}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', $plan->url) }}" class="form" method="POST">  {{--Pega os dados digitados no formulário e mando pro método store dentro do controller que manda pra view que será exibido no index.blade.php  --}}
                @csrf
                @method('PUT')
                
                {{-- O formulário de edit e create estão duplicados, desta forma criei o mesmo formulário para ambos dentro da pastinha _partials/form.blade.php --}}
                @include('admin/pages/plans/_partials/form')

            </form>
        </div>
    </div>
@endsection
