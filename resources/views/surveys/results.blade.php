@extends('layouts.app')

@section('conteudo')

@if(session('mensagem'))
    <div class="alert alert-success">
        <p>{{session('mensagem')}}</p>
    </div>
@endif
    <table class="table table-hover">
        <thead>
            <tr>
                <th>{{$survey->name}}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($survey->options as $option)
            <tr>
                <td>{{$option->name}}</td>
                <td>{{$option->votes}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <p>Link para compartilhar sua enquete: </p>
        <a href="{{route('survey.share', $survey)}}">{{route('survey.share', $survey)}}</a>
    </div>

    <div class="mt-4">
        <a href="{{route('surveys.index')}}" class="btn btn-dark">
            {{__('Back')}}
        </a>
    </div>
@endsection
