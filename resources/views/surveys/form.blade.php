@extends('layouts.app')

@section('conteudo')
    <div class="row">
        <div class="col">
            @if(session('message'))
                <div class="alert alert-success">
                    <p>{{session('message')}}</p>
                </div>
            @endif

            <form method="POST" action="{{ isset($survey)? route('surveys.update', ['id'=> $survey->id]) : route('surveys.store')}}">
                @csrf

                <div class="mb-4">
                    <label for="name" >{{__('Survey Title')}}</label>

                    <input id="name" class="form-control" type="text" name="name" value="{{old('name', isset($survey)? $survey->name :'')}}" required autofocus />
                </div>

                <div id="option">
                    <h3>{{__('Survey Options')}}</h3>
                    @if (isset($survey))
                        @foreach ( $survey->options as $index=> $option)
                            <div class="mb-4" id="option{{$index}}">
                                <div class="row">
                                    <div class="col-11">
                                        <input class="form-control" type="text" name="options[{{$index}}][name]" value="{{$option->name}}" required autofocus />
                                        <input type="hidden" name="options[{{$index}}][id]" value="{{$option->id}}"/>
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-outline-danger" type="button" onclick="document.getElementById('option{{$index}}').remove()">Excluir</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div>
                        <div id="optionGroupHide">
                            <div class="mb-3" id="optionHide" style="display: none;">
                                <div class="row">
                                    <div class="col-11">
                                        <input type="text" class="form-control">
                                    </div>
                                    <div class="col-1">
                                        <button class="btn btn-outline-danger" type="button" onclick="this.parentNode.remove()">Excluir</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" id="add" class="btn btn-primary">
                            {{__('Add Option')}}
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        {{__('Save')}}
                    </button>

                    <a href="{{route('surveys.index')}}" class="btn btn-dark">
                        {{__('Back')}}
                    </a>
                </div>
            </form>
        </div>
    </div>




<script>
    var butAdd = document.getElementById("add");
    butAdd.addEventListener('click', function(){
        var optionHide = document.getElementById("optionHide");
        var opClone =optionHide.cloneNode(true);
        opClone.id = null;
        opClone.style.display = 'block';
        var inputHide = opClone.getElementsByTagName('input')[0];
        inputHide.name = 'optionsHide[]';
        var optionGroupHide = document.getElementById('optionGroupHide');
        optionGroupHide.appendChild(opClone);
    });

</script>

@endsection
