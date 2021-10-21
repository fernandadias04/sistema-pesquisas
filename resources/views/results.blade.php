<table class="table table-striped table-dark">
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
