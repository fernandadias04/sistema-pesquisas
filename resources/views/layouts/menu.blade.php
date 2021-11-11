
<nav id="menu-top" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('surveys.index') }}">Info Pesquisa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            @auth
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('home')}}">{{__('Home')}}</a>
            </li>
            @endauth

            <li class="nav-item">
                <a href="{{ route('surveys.create') }}" class="nav-link">
                    {{__('New Survey')}}
                </a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" href="#"
                    onclick="event.preventDefault();
                        this.getElementsByTagName('form')[0].submit();">
                        <form method="POST" action="{{ route('logout') }}" style="display: none">
                            @csrf

                        </form>
                    {{ __('Log Out') }}
                </a>
            </li>
            @endauth
        </ul>

        @if(request()->route()->named('surveys.index'))
        <form class="d-flex">
            <input class="form-control me-2" name="search" type="search" placeholder="{{__('Search')}}" value="{{ request()->get('search') }}" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">{{__('Search')}}</button>
        </form>
        @endif
        </div>
    </div>
</nav>
