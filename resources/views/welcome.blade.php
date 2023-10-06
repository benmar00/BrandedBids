@extends('layouts.app')
@section('content')
  <section class="cars-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="sell-cars">
                        <div class="auction">
                            <h2>Auctions</h2>
                            <div class="services">
                                <span>Years</span>
                                <select class="form-control year" id="start_year">
                                    <option value="null" hidden>Select Year</option>
                                    @for ($year = 1981; $year < date('Y') + 1; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor


                                </select>
                                <span class="to">To</span>
                                <select class="form-control year" id="end_year">
                                    <option value="null" hidden>Select Year</option>
                                    @for ($year = 1981; $year < date('Y') + 1; $year++)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor

                                </select>
                            </div>
                            <select class="form-control" id="transmission">
                                <option value='null' hidden>Transmission</option>
                                <option value="null">All</option>
                                <option value="automatic">Automatic</option>
                                <option value="manual">Manual</option>
                            </select>
                            <select class="form-control" id="body_style">
                                <option value='null' hidden>Body Style</option>
                                <option value="null">All</option>
                                @foreach ($body as $body)
                                    <option value="{{ $body->id }}">{{ $body->name }}</option>
                                @endforeach

                            </select>
                        </div>


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
                                                            <a class="d-flex"
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
                                                            <a class="d-flex"
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
                                                            <a class="d-flex"
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
                                                            <a class="d-flex" href="{{ route('vehicleDetail', $item->slug) }}">
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
                <div class="col-lg-3 col-md-3">
                    {!! $helper->homeSidebarContent() !!}

                    <div class="mian-side-bar">
                        <div class="h-mian">
                            <h5>New Listings</h5>
                        </div>
                        @foreach ($all as $item)
                            <div class="item mb-2">
                                <div class="flex-img-main">
                                    <div class="one-img">
                                        <figure>
                                            <img src="{{ asset($item->image) }}" class="img-fluid" alt="">
                                            <span class="new-cars">NEW</span>
                                        </figure>
                                    </div>
                                    <div class="block-img">
                                        @foreach ($item->takeImages(2) as $value)
                                            <figure>
                                                <img src="{{ asset($value) }}" class="img-fluid" alt="">
                                            </figure>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="mercedes">
                                    <div class="f-h">
                                        <h5><a href="{{ route('vehicleDetail', $item->slug) }}">{{ $item->name }}</a>
                                        </h5>

                                        @if (Auth::check())
                                            <button
                                                class="{{ $item->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                                onclick="setWishlist(this,{{ $item->id }})"></button>
                                        @else
                                            <button class="fa-regular fa-star staricon" data-toggle="modal"
                                                data-target="#signup-btn"></button>
                                        @endif
                                        <img src="{{ asset($item->image) }}" class="img-fluid" alt="">
                                    </div>
                                    {!! $item->short_desc !!}
                                </div>
                            </div>
                        @endforeach



                    </div>

                </div>

            </div>
            <div class="col-lg-12">
                <div class="page-change">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{ $vehcile->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        setWishlist = (event, id) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('add_to_wishlist') }}",
                type: "post",
                data: {
                    vechile: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Wishlist',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                    } else {
                        $.toast({
                            heading: 'Wishlist',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                    }
                }
            })
            if ($(event).hasClass('fa-regular'))
                $(event).attr('class', 'fa-solid fa-star staricon')
            else if ($(event).hasClass('fa-solid'))
                $(event).attr('class', 'fa-regular fa-star staricon')


        }
        search = (start, year) => {
            $.ajax({
                url: "{{ route('search.vechile') }}",
                type: "GET",
                data: {
                    year: [start, year],
                    transmission_mode: document.getElementById('transmission').value === "null" ? null :
                        document
                        .getElementById('transmission').value,
                    body_style_id: document.getElementById('body_style').value === "null" ? null : document
                        .getElementById('body_style').value,

                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        let html = ""
                        response.data.forEach(item => {
                            let highbid = item.starting_bid
                            if (item.high_bid != null) {
                                let highbid = item.high_bid.highest_bid
                            }
                            html += `<div class="col-lg-4">
                                <div class="first-main">
                                    <a href="${response.url + 'vehicle-detail/' + item.slug}">
                                        <div class="car-img">
                                            <figure>
                                                <img src="${window.location.href+item.image}" class="img-fluid img-cars" alt="">
                                                <p class="img-span">
                                                    <span class="time-expire">${moment(item.expire).fromNow()}</span>Bid
                                                    <span class="max-bid">$${highbid}</span>
                                                </p>
                                            </figure>
                                        </div>
                                    </a>
                                    <div class="mercedes">
                                        <div class="f-h">
                                            <a href="${window.location.href  + 'vehicle-detail/' + item.slug}">
                                                <h5 class="name">${item.name}</h5>
                                            </a>
                                            <img src="${window.location.href + item.image}" class="img-fluid img-car" alt="">
                                        </div>
                                        <div class="mt-2">
                                            ${item.short_desc}
                                        </div>
                                    </div>
                                </div>
                            </div>`

                        });
                        $('#content_filter').html('')
                        $('#content_filter').html(html)
                    } else {
                        $('#content_filter').html('')
                        $('#content_filter').html(
                            '<span class="badge badge-danger no-result">No Result</span>')


                    }


                }
            })
        }
        $('.auction select').change(function() {
            let start = $('.year')[0].value;
            let year = $('.year')[1].value;
            if (parseInt(start) < parseInt(year)) {
                search(start, year)


            } else if (start === "null" && year === "null") {
                search(null, null)
            } else if (start === "null" || year === "null") {
                $.toast({
                    heading: 'Cannot Search',
                    text: 'Select both year',
                    showHideTransition: 'slide',
                    icon: 'error'
                })
            } else {

                $.toast({
                    heading: 'Cannot Search',
                    text: 'Staring year should not be greater than ending year',
                    showHideTransition: 'slide',
                    icon: 'error'
                })
            }
        })
    </script>
@endpush
