@extends('layouts.app')

@section('conteudo')
<div class="row">
    <div class="col">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Pesquisas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($surveys as $survey)
                <tr>
                    <td>
                        <a href="{{route('surveys.results', $survey)}}">
                        {{$survey->name}}
                        </a>
                    </td>
                    <td>
                        <div class="float-end">
                            <a class="btn btn-warning" href="{{route('surveys.edit', ['id'=> $survey->id])}}">
                                Editar
                            </a>

                            <form method='POST' action="{{route('surveys.delete', ['id'=> $survey->id])}}" onsubmit="return confirm('Tem certeza que deseja remover {{ addslashes( $survey->name )}}?')" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {!! $surveys->links() !!}
    </div>
</div>
@endsection

