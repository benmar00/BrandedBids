<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset($logo) }}" class="img-fluid"
                            alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto w-100">
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="index.php" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Auctions
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Live Auctions</a>
                                    <a class="dropdown-item" href="{{ route('past') }}">Past Results</a>
                                </div>
                            </li>
                            <li>
                                <a class="btn btn-green" href="{{ route('sellacar') }}">Sell a Car</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('whycars') }}">What’s Cars & Bids?</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('crash-gallery') }}">Crash Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#signup" href="javascript:;">Daily
                                    Email</a>
                            </li>
                        </ul>
                        <div class="form-inline">
                            <div class="search">
                                <form action="{{ route('searchForm') }}" method="GET">
                                    <button class="btn search-btn">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>

                                    <input type="text" autocomplete="off" aria-autocomplete="list"
                                        aria-controls="react-autowhatever-1" class="form-control w-50"
                                        placeholder="Search for cars (ex. BMW, Audi, Ford)" name="search"
                                        value="{{ Request::has('search') ? Request::get('search') : '' }}">
                                </form>

                            </div>
                            @if (Auth::check())
                                <div class="login-section">


                                    <a href="{{ route('wishlist') }}"><i class="fa-regular fa-star"></i></a>
                                    <ul class="navbar-nav ml-auto custom-notification">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="#" id="notification" id="bell"
                                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                @if (Auth::user()->unreadNotifications->count() > 0)
                                                    <span
                                                        class="badge badge-primary rounded-circle">{{ Auth::user()->unreadNotifications->count() }}</span>
                                                @endif

                                                <i class="fa-regular fa-bell"></i>
                                            </a>
                                            @if (Auth::user()->unreadNotifications->count())
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                                    <p class="header">
                                                        <a href="{{ route('allread') }}">Mark as all read</a>
                                                    </p>
                                                    @foreach (Auth::user()->unreadNotifications as $item)
                                                        <a class="dropdown-item" href="{{ $item->data['link'] }}"
                                                            target="_blank">

                                                            {!! $item->data['data'] !!}
                                                        </a>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="#" id="navbarDropdown2" role="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <img class="account-toggler-icon"
                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGwAAAAqCAYAAABWZ768AAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAT0SURBVHgB7Zu9Thw7FMfPLitxodoCrW5pChDQhAv0d/MEIV1SLW9A0qVjeYKEJ2DzBCFdukx6QKTgu8jQIYEQ3SIk2PwPeMhghp0ve8Ze5SehGRvPrMfHY/v8faZCFjI9Pb1cqVTavV6vThrBPS9x2Li9vV09ODjwyUGqZCFo2CXdxmL4nvhbwv2/T0xMzJKDWGkwNKrpxhS1Wu0LOYh1BpuamhJUDAK/1STHqJF9CCXtd7vd/3zfv6ScYG7s4NAK0hgal3HwyCFsHBKb4QSGR0+HseS9OupvCSG0z5UmqWFYaFWr1U8GJnkf92xjNfY5zUXo9f8rWR5pAnXx8Jb59Octro+MjCzh+IkcoWpi+SwRuHfqhsA1jxYcNzc3P0kjeFa1A70ih2CDmRwSUg1lvNRWOs/l8fHxDumlo6SdGharcCLf4+iTZthJReOvprlmaGhIXc7rNhZJh9kL542Ojr4jR6jhATr0tNeVAozcDKdh8B9khq8UWtzgd3jl2CYHsGqVCIO9ULI8MsDw8HBHylQBzvhk1hhsdna2riocWHBoWc6r7Ozs8HD9aLiFARfJAawx2NXV1RM5CvLRiinNL2J+bbmw+KhQyfBQhN69wst5Q+6FKTx2xNP6mXkZohKBsdhQHbp3ZP8ht2A/c7HRaNDZ2ZmpxdETSnvDYCze5linAQBv2ktWUZKWn5ub42fvbW1tJXo7w+VLE39RgRYNCDykU8IVrWz8dXkutre3V2PKr/P+IJ/Pz88b0RKTaojNcALXjLuyC8xbQGjEX6GsTAsjlgVhEHrOaGFjBZjQEjNpiC5t2UfUNXH7wTjsAz4YSBptRS2nGouv4SHRlJZoxH8aFDY3N9v9jBZlLL6Gz2usJcoxWJAGWEHgIBf6S1/YAAsLCzwV3BkqGB7pfoRaCsqFjXWXppLAvlRPyWIBtkn384GQeaxG8Jy4UaS/ww409sla/eoj3ZEH9vf3M7UljNYOjKaiGusuj0oiwmBxZNoQTcvk5OQiFJb1tPN6VoMxUUaLMhZjZdTUM/BQ0ZmZmVkhQ6ATfcQWz5eiFZeIOS3SWHf/o5LI8IY9wG7I7u7ue9KIVF3alJE8b1hAEoe6FINFqRxysbKGUy9QDfA2sb7Ic9sTJxtK/uujo6MNGsD69KMUg+HtYqdThLJ8Ke/4UeWlo/pdueay2+2Oawp/s6o+/Sh8DuPeTIoL0a9xGP4fl1E2HYOIp4GqTxyFGwwP+ShKSW5R+HHXcRk5RIVpUk5sq08cOrXERMtuNJBAuYc0xv41So6Hv/Aq8QXlxLb6xKFTS0ykIaphAGnC2CK2MATlxLb6xFFjLTHcw3JSuIaYxz1wEW1xiSniEP1wIk20UhHfdOWpD9pAexylShlxifxQIkhg/mxSws0/SEbGAz7z1Acd9oQMU4Y09Sj+AQ+5nOSbMFnG+C51nvrgWuMfCRbuOHP84fX19S9loZPFUfUhB43TgNUnjsKjpk5PT6/GxsYOcfomlF1HA7xrNBqiXq+fXFxcnHImzyfIa8mtjH/D92GJ6Pz8PPeXLbbVJ44yxV92AZYpA6xm7+3ttUkjttXnOUqLS0Rv/IaeXVE/gEjAGoaeD6QZ2+rzHKUGkqKRPDTSifyIr6/zzm4DVIi3h4eHqQN8XK1P5O+SJcgtDtb1BP0JG/Pp3g3woIR/Nq2E21yfgN/UsOMw4TCRPwAAAABJRU5ErkJggg=="
                                                    alt="Account Toggle">
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                                <a href="{{ route('user.dashboard') }}" class="inner-profile">

                                                    <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('front/images/default.png') }}"
                                                        alt="">
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <li> <a class="dropdown-item" href="{{ route('user.listings') }}">My
                                                        Listing</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ route('user.settings') }}">Settings</a></li>
                                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}"
                                                        method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>




                                </div>
                            @else
                                <a class="nav-link btn btn-green" data-toggle="modal" data-target="#signup-btn"
                                    href="javascript:;">Sign Up</a>
                            @endif
                            </form>


                        </div>
                </nav>
            </div>
        </div>
    </div>
</header>
