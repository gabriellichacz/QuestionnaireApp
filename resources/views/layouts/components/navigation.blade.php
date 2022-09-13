<!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-violet" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand text-white-50" href="/"> {{ __('Ankiety') }} </a>
        <button class="navbar-toggler navbar-toggler-right  " type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            {{ __('Menu') }}
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto ">
                <!-- Links -->
                <li class="nav-item"><a class="nav-link text-white-50" href="/home"> {{ _('Home') }} </a></li>
                <!-- end of Links -->
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link  text-white-50" href="{{ route('login') }}">{{ __('Zaloguj się') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link  text-white-50" href="{{ route('register') }}">{{ __('Zarejestruj się') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white-50" href="#" role="button" 
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end text-white-50" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Wyloguj się') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                <!-- end of Authentication Links -->
            </ul>
        </div>
    </div>
</nav>
<!-- end of navigation -->