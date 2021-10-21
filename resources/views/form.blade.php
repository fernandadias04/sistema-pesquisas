<form method="POST" action="{{ isset($survey)? route('surveys.update', ['id'=> $survey->id]) : route('surveys.store')}}">
    @csrf
    <div>
        <x-label for="name" :value="__('Titulo da Enquete')" />
        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', isset($survey)? $survey->name :'')" required autofocus />
    </div>


    <div id="option">
        @if (isset($survey))
            @foreach ( $survey->options as $index=> $option)
                <div id="option{{$index}}">
                    <x-input  class="block mt-1 w-full" type="text" name="options[{{$index}}][name]" :value="$option->name" required autofocus />
                    <input  type="hidden" name="options[{{$index}}][id]" value="{{$option->id}}"/>
                    <button type="button" onclick="document.getElementById('option{{$index}}').remove()">Excluir</button>
                </div>
            @endforeach
        @endif
        <div>
            <div id="optionGroupHide">
                <div id="optionHide" style="display: none;">
                    <x-input class="block mt-1 w-full"/>
                    <button type="button" onclick="this.parentNode.remove()">Apagar</button>
                </div>
            </div>
            <button type="button"id="add">Adicionar Pergunta</button>
        </div>
    </div>



    <button type="submit">Salvar</button>
</form>

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
