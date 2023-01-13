<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand px-5 mx-2 border rounded" href="/">{{__('INICIO')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link text-dark bg-light px-5 mx-2 border rounded" href="{{route('reservation.index')}}">{{ __('Reservas') }}<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark bg-light px-5 mx-2 border rounded" href="{{route('search')}}">{{ __('Buscar') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark bg-light px-5 mx-2 border rounded" href="{{route('calendar')}}">{{ __('Calendario') }}</a>
            </li>
        </ul>
    </div>
</nav>