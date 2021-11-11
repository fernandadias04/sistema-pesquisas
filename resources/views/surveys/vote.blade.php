@extends('layouts.app')

@section('conteudo')

@if(session('mensagem'))
        <div class="alert alert-success">
            <p>{{session('mensagem')}}</p>
        </div>
 @endif

<h3 class="mb-4">{{$survey->name}}</h3>

<form id="form" action="{{route('survey.vote', $survey)}}" method="POST">
    @csrf
    @foreach ($survey->options as $option )
        <div class="form-check mb-2">
            <input name="vote" class="form-check-input" type="radio" value="{{$option->id}}" id="opIp{{$option->id}}">
            <label class="form-check-label" for="opIp{{$option->id}}">
                {{$option->name}}
            </label>
        </div>
    @endforeach

    <div class="mt-4">
        <button class="btn btn-primary">Votar</button>
    </div>

</form>

@endsection
