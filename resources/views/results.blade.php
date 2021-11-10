@extends('layout')

@section('conteudo')

@if(session('mensagem'))
    <div class="alert alert-success">
        <p>{{session('mensagem')}}</p>
    </div>
@endif

<table class="table table-hover">
                <thead>
                    <tr>
                        <th>Pesquisas</th>
                    </tr>
                </thead>
                <tbody>


                    <tr>
                        <th> {{$survey->name}}</th>
                    </tr>
                    @foreach ($survey->options as $option)
                    <tr>
                      <th>{{$option->name}}</th>
                      <th>{{$option->votes}}</th>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            <div>
                <p>Link para compartilhar sua enquete: </p>
                <a href="{{route('survey.share', $survey)}}">{{route('survey.share', $survey)}}</a>
            </div>
@endsection
