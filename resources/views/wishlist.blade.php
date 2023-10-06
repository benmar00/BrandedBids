@extends('layouts.app')
@section('content')
    <div class="page container subflow account">
        <div class="row subbody">
            <div class="col container">

                <div class="section">
                    <p class="bio"></p>
                </div>


                    <div class="section">

                        <h2>Watchlist
                        </h2>



                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ currentSelectedURL('home') || currentSelectedURL('searchForm') ? 'active' : '' }}" data-toggle="tab"
                                    href="#tabs-1" role="tab">Ending
                                    soon</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Newly listed</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">No reserve</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Lowest mileage</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ currentSelectedURL('past') ? 'active' : '' }}" data-toggle="tab"
                                    href="#tabs-5" role="tab">Past Auctions</a>
                            </li>
                        </ul><!-- Tab panes -->
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane {{ currentSelectedURL('home') || currentSelectedURL('searchForm') ? 'active' : '' }}" id="tabs-1"
                            role="tabpanel">
                            <div class="main-sec">
                                <div class="col-lg-12">
                                    <div class="row" id="content_filter">
                                        @forelse ($vehcile->where('expire', '>=', now()) as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="first-main">
                                                    <a href="{{ route('vehicleDetail', $item->slug) }}">
                                                        <div class="car-img">
                                                            <figure>
                                                                <img src="{{ asset($item->image) }}"
                                                                    class="img-fluid img-cars" alt="">
                                                                <p class="img-span">
                                                                    <span
                                                                        class="time-expire">{{ Carbon::parse($item->expire)->diffForHumans() }}</span>Bid
                                                                    @if ($item->highBid)
                                                                        @php
                                                                            $amount = number_format($item->highBid->highest_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $amount = number_format($item->starting_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @endif
                                                                    <span class="max-bid">${{ $amount }}</span>
                                                                </p>
                                                            </figure>
                                                        </div>
                                                    </a>
                                                    <div class="mercedes">
                                                        <div class="f-h">
                                                            <a class=""
                                                                href="{{ route('vehicleDetail', $item->slug) }}">
                                                                <h5 class="name">{{ $item->name }}</h5>
                                                                @if ($item->reserve)
                                                                    <h6> <span class="badge badge-success">No
                                                                            Reserve</span></h6>
                                                                @endif
                                                            </a>
                                                            @if (Auth::check())
                                                                <button
                                                                    class="{{ $item->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                                                    onclick="setWishlist(this,{{ $item->id }})"></button>
                                                            @else
                                                                <button class="fa-regular fa-star staricon"
                                                                    data-toggle="modal" data-target="#signup-btn"></button>
                                                            @endif

                                                        </div>
                                                        <div class="mt-2" class="start-desc">
                                                            {!! $item->short_desc !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <span class="badge badge-danger no-result">No Result</span>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpane2">
                            <div class="main-sec">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @foreach ($vechile->latest()->get() as $item)
                                            <div class="col-lg-4">
                                                <div class="first-main">

                                                    <a href="{{ route('vehicleDetail', $item->slug) }}">
                                                        <div class="car-img">
                                                            <figure>
                                                                <img src="{{ asset($item->image) }}"
                                                                    class="img-fluid img-cars" alt="">
                                                                <p class="img-span">
                                                                    <span
                                                                        class="time-expire">{{ Carbon::parse($item->expire)->diffForHumans() }}</span>Bid
                                                                    @if ($item->highBid)
                                                                        @php
                                                                            $amount = number_format($item->highBid->highest_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $amount = number_format($item->starting_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @endif
                                                                    <span class="max-bid">${{ $amount }}</span>
                                                                </p>
                                                            </figure>
                                                        </div>
                                                    </a>
                                                    <div class="mercedes">
                                                        <div class="f-h">
                                                            <a class=""
                                                                href="{{ route('vehicleDetail', $item->slug) }}">
                                                                <h5 class="name">{{ $item->name }}</h5>
                                                                @if ($item->reserve)
                                                                    <h6> <span class="badge badge-success">No
                                                                            Reserve</span></h6>
                                                                @endif
                                                            </a>
                                                            @if (Auth::check())
                                                                <button
                                                                    class="{{ $item->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                                                    onclick="setWishlist(this,{{ $item->id }})"></button>
                                                            @else
                                                                <button class="fa-regular fa-star staricon"
                                                                    data-toggle="modal"
                                                                    data-target="#signup-btn"></button>
                                                            @endif
                                                        </div>
                                                        <div class="mt-2" class="start-desc">
                                                            {!! $item->short_desc !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane " id="tabs-3" role="tabpane3">
                            <div class="main-sec">
                                <div class="col-lg-12">
                                    <div class="row" id="content_filter">
                                        @forelse ($vehcile->where('reserve') as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="first-main">
                                                    <a href="{{ route('vehicleDetail', $item->slug) }}">
                                                        <div class="car-img">
                                                            <figure>
                                                                <img src="{{ asset($item->image) }}"
                                                                    class="img-fluid img-cars" alt="">
                                                                <p class="img-span">
                                                                    <span
                                                                        class="time-expire">{{ Carbon\Carbon::parse($item->expire)->diffForHumans() }}</span>Bid
                                                                    @if ($item->highBid)
                                                                        @php
                                                                            $amount = number_format($item->highBid->highest_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $amount = number_format($item->starting_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @endif
                                                                    <span class="max-bid">${{ $amount }}</span>
                                                                </p>
                                                            </figure>
                                                        </div>
                                                    </a>
                                                    <div class="mercedes">
                                                        <div class="f-h">
                                                            <a class=""
                                                                href="{{ route('vehicleDetail', $item->slug) }}">
                                                                <h5 class="name">{{ $item->name }} </h5>
                                                                @if ($item->reserve)
                                                                    <h6> <span class="badge badge-success">No
                                                                            Reserve</span></h6>
                                                                @endif


                                                            </a>
                                                            @if (Auth::check())
                                                                <button
                                                                    class="{{ $item->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                                                    onclick="setWishlist(this,{{ $item->id }})"></button>
                                                            @else
                                                                <button class="fa-regular fa-star staricon"
                                                                    data-toggle="modal"
                                                                    data-target="#signup-btn"></button>
                                                            @endif

                                                        </div>
                                                        <div class="mt-2" class="start-desc">
                                                            {!! $item->short_desc !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <span class="badge badge-danger no-result">No Result</span>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane " id="tabs-4" role="tabpane4">
                            <div class="main-sec">
                                <div class="col-lg-12">
                                    <div class="row">
                                        @foreach ($vechile->orderBy('mileage', 'asc')->get() as $item)
                                            <div class="col-lg-4">
                                                <div class="first-main">
                                                    <a href="{{ route('vehicleDetail', $item->slug) }}">
                                                        <div class="car-img">
                                                            <figure>
                                                                <img src="{{ asset($item->image) }}"
                                                                    class="img-fluid img-cars" alt="">
                                                                <p class="img-span">
                                                                    <span
                                                                        class="time-expire">{{ Carbon\Carbon::parse($item->expire)->diffForHumans() }}</span>Bid
                                                                    @if ($item->highBid)
                                                                        @php
                                                                            $amount = number_format($item->highBid->highest_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $amount = number_format($item->starting_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @endif
                                                                    <span class="max-bid">${{ $amount }}</span>
                                                                </p>
                                                            </figure>
                                                        </div>
                                                    </a>
                                                    <div class="mercedes">
                                                        <div class="f-h">
                                                            <a class="" href="{{ route('vehicleDetail', $item->slug) }}">
                                                                <h5 class="name">{{ $item->name }}</h5>
                                                                @if ($item->reserve)
                                                                    <h6> <span class="badge badge-success">No
                                                                            Reserve</span></h6>
                                                                @endif
                                                            </a>
                                                            @if (Auth::check())
                                                                <button
                                                                    class="{{ $item->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                                                    onclick="setWishlist(this,{{ $item->id }})"></button>
                                                            @else
                                                                <button class="fa-regular fa-star staricon"
                                                                    data-toggle="modal"
                                                                    data-target="#signup-btn"></button>
                                                            @endif
                                                        </div>
                                                        <div class="mt-2" class="start-desc">
                                                            {!! $item->short_desc !!}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane {{ currentSelectedURL('past') ? 'active' : '' }}" id="tabs-5"
                            role="tabpane5">
                            <div class="main-sec">
                                <div class="col-lg-12">
                                    <div class="row" id="content_filter">
                                        @forelse ($vehcile->where('expire', '<=', now()) as $item)
                                            <div class="col-lg-4 col-md-4 col-sm-6">
                                                <div class="first-main">
                                                    <a href="{{ route('vehicleDetail', $item->slug) }}">
                                                        <div class="car-img">
                                                            <figure>
                                                                <img src="{{ asset($item->image) }}"
                                                                    class="img-fluid img-cars" alt="">
                                                                <p class="img-span">
                                                                    <span
                                                                        class="time-expire">{{ Carbon\Carbon::parse($item->expire)->diffForHumans() }}</span>Bid
                                                                    @if ($item->highBid)
                                                                        @php
                                                                            $amount = number_format($item->highBid->highest_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $amount = number_format($item->starting_bid, 0, '.', ',');
                                                                        @endphp
                                                                    @endif
                                                                    <span class="max-bid">${{ $amount }}</span>
                                                                </p>
                                                            </figure>
                                                        </div>
                                                    </a>
                                                    <div class="mercedes">
                                                        <div class="f-h">
                                                            <a href="{{ route('vehicleDetail', $item->slug) }}">
                                                                <h5 class="name">{{ $item->name }}</h5>
                                                            </a>
                                                            @if (Auth::check())
                                                                <button
                                                                    class="{{ $item->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                                                    onclick="setWishlist(this,{{ $item->id }})"></button>
                                                            @else
                                                                <button class="fa-regular fa-star staricon"
                                                                    data-toggle="modal"
                                                                    data-target="#signup-btn"></button>
                                                            @endif

                                                        </div>
                                                        <div class="mt-2" class="start-desc">
                                                            {!! $item->short_desc !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <span class="badge badge-danger no-result">No Result</span>
                                        @endforelse

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    </div>

            </div>
            </div>
            </div>

        <style>
#root>.page {
    min-height: calc(100vh - 80px);
}


.subflow.account .col {
    max-width: 60% !important;
}



</style>

@endsection

