<div class="main-form">
        <div class="my-listings">
            <h2>My Listings</h2>

            <h6>Past Listings</h6>
            @foreach(Auth::user()->vehicle as $car)
                <p><a href="{{route('car.submission',$car->slug)}}">{{$car->name}}</a></p>
            @endforeach
            <hr>
            <a class="nav-link btn btn-green" href="{{ route('user.vehicleupload') }}
            ">Sell another car</a>
        </div>
</div>
