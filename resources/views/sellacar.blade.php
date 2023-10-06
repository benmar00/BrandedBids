@extends('layouts.app')
@section('content')
    <section class="headaches">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sell-more-car">
                        {!! $page->findSection('header-title') !!}
                        <div class="seller-img">
                            <figure>
                                <img src="{{ $page->findSection('header-image') }}" class="img-fluid" alt="">
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    {!! $page->findSection('live-support-point') !!}
                </div>
                <div class="col-lg-6">
                    <div class="reviews-wrap desktop-wrap">
                        <h2>{{ $page->findSection('testimonial-heading') }}</h2>
                        <div class="First-Slide owl-carousel owl-theme">
                            @foreach ($testimonal as $item)
                                <div class="item">
                                    <div class="cars-slide">
                                        <div class="star-icon">
                                            <figure>
                                                <img src="{{ asset($item->image) }}" class="img-fluid" alt="">
                                            </figure>
                                            <h4>{{ $item->name }}</h4>
                                        </div>
                                        <div class="more-info-sell">
                                            {!! $item->comments !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="more-link mt-5">
                        {!! $page->findSection('mid-page-banner-title') !!}
                        <a class="nav-link btn btn-green" data-toggle="modal" data-target="#signup-btn"
                            href="javascript:;">Sell now — it’s free!</a>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="counter">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">/
                    <div class="counter-h">
                        {!! $page->findSection('why-cars') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="recent-sales">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="counter-h">
                        <h4>{{ $page->findSection('recent-sales-heading') }}</h4>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="first-main">
                        <a href="#">
                            <div class="car-img">
                                <figure>
                                    <img src="{{ asset('front/images/175.jpg') }}" class="img-fluid" alt="">

                                </figure>
                            </div>
                            <p class="img-span"><img src="{{ asset('front/images/2.png') }}" class="img-fluid" alt="">
                                <span>Sold</span>for <span>$675,000</span>
                            </p>
                        </a>
                        <div class="mercedes">
                            <div class="f-h">
                                <h5><a href="#">1988 Lamborghini <span>Countach LP5000</span>
                                        <span>Quattrovalvole</span>
                                    </a></h5>
                                <img src="{{ asset('front/images/3.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="first-main">
                        <a href="#">
                            <div class="car-img">
                                <figure>
                                    <img src="{{ asset('front/images/176.jpg') }}" class="img-fluid" alt="">

                                </figure>

                            </div>
                            <p class="img-span"><img src="{{ asset('front/images/2.png') }}" class="img-fluid" alt="">
                                <span>Sold</span>for <span>$86,500</span>
                            </p>
                        </a>
                        <div class="mercedes">
                            <div class="f-h">
                                <h5><a href="#">2001 Audi RS4 Avant
                                    </a></h5>
                                <img src="{{ asset('front/images/3.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="first-main">
                        <a href="#">
                            <div class="car-img">
                                <figure>
                                    <img src="{{ asset('front/images/177.jpg') }}" class="img-fluid" alt="">

                                </figure>

                            </div>
                            <p class="img-span"><img src="{{ asset('front/images/2.png') }}" class="img-fluid" alt="">
                                <span>Sold</span>for <span>$103,001</span>
                            </p>
                        </a>
                        <div class="mercedes">
                            <div class="f-h">
                                <h5><a href="#">2023 Rivian R1S <span>Launch Edition
                                        </span></a></h5>
                                <img src="{{ asset('front/images/3.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="first-main">
                        <a href="#">
                            <div class="car-img">
                                <figure>
                                    <img src="{{ asset('front/images/178.jpg') }}" class="img-fluid" alt="">

                                </figure>

                            </div>
                            <p class="img-span"><img src="{{ asset('front/images/2.png') }}" class="img-fluid" alt="">
                                <span>Sold</span>for <span>$28,000</span>
                            </p>
                        </a>
                        <div class="mercedes">
                            <div class="f-h">
                                <h5><a href="#">1989 Honda Acty SDX
                                    </a></h5>
                                <img src="{{ asset('front/images/3.png') }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="recent-sales">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="counter-h">
                        <h4>{{ $page->findSection('our-auctions-heading') }}</h4>
                    </div>
                </div>
                {!! $page->findSection('our-auctions-description') !!}

            </div>
        </div>
    </section>


    <section class="recent-sales">
        <div class="container">
            <div class="row">
                {!! $page->findSection('how-it-works-area') !!}
                <div class="col-lg-12">
                    <div class="more-link mt-5">
                        <a class="nav-link btn btn-green" data-toggle="modal" data-target="#signup-btn"
                            href="javascript:;">Get Started Now</a>
                        <!--<a href="what-is.php#selling-a-car">Learn more about how selling works on Cars & Bids.</a>-->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
