@extends('layout')

@section('conteudo')
<p>{{$survey->name}}</p>
<form id="form" action="{{route('survey.vote', $survey)}}" method="POST">
    @csrf
    @foreach ($survey->options as $option )
        <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
            <input type="radio" name="vote" id="opIp{{$option->id}}" value="{{$option->id}}" class="form-control"><label for="opIp{{$option->id}}">{{$option->name}}</label>
            </div>
        </div>
        </div>
    @endforeach

<button>Votar</button>
</form>

@endsection
