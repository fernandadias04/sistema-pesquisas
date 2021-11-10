<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>



    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="{{route('surveys')}}"><h2>Info Pesquisa</h2></a>


                <div>

                    <form  class="form-inline my-2 my-lg-0">
                        @csrf
                        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Pesquisa" value="{{ request()->get('search') }}" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisa</button>
                    </form>


                    <form  class="form-inline btn btn-danger " method="POST" action="{{ route('logout') }}" >
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>

                    <form action="{{'create'}}">
                        <x-button class="btn btn-info">
                                {{ __('Nova Enquete') }}
                        </x-button>
                    </form>

            </div>
        </nav>

        @yield('conteudo')
    </div>
</body>
</html>
