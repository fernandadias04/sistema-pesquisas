@extends('layout')

@section('conteudo')
        <div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Pesquisas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($surveys as $survey)

                    <tr>

                        <th>
                            <a href="{{route('surveys.results', $survey)}}">
                            {{$survey->name}}
                            </a>
                        </th>

                        <form action="{{route('surveys.edit', ['id'=> $survey->id])}}">
                        @csrf
                        <th><button>Editar</button></th>
                        </form>

                        <form method='POST' action="{{route('surveys.delete', ['id'=> $survey->id])}}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $survey->name )}}?')" >

                            @csrf
                            @method('delete')
                            <th><button >Excluir</button></th>
                        </form>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
@endsection

