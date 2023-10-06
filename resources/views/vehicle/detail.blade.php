@extends('layouts.app')
@section('content')
    <style>
        .modal-dialog.centered-content .modal-body {
            padding: 0 46px 46px
        }

        .modal-dialog.centered-content div.two-up {
            display: flex;
            justify-content: space-between
        }

        .modal-dialog.centered-content div.two-up button {
            flex-basis: 50%;
            flex-grow: 1
        }

        .modal-dialog.centered-content div.two-up button+button {
            margin-left: 20px
        }

        .modal-dialog.centered-content .form-group label span {
            font-size: 14px
        }

        .modal-dialog.auth p:not(.text-danger) {
            font-size: 15px;
            line-height: 21px
        }

        .modal-dialog.auth p:not(.text-danger) .btn-link {
            margin: 0;
            padding: 0;
            border: 0;
            vertical-align: unset
        }

        .modal-dialog.auth p.text-danger a {
            color: inherit;
            text-decoration: underline
        }

        .modal-dialog.auth p.alt-path {
            margin-bottom: 32px;
            text-align: center
        }

        .modal-dialog.auth div.auth-help {
            padding-top: 16px
        }

        .modal-dialog.auth div.auth-help a {
            font-size: 14px
        }

        .modal-dialog.auth .form-group.checkbox+.form-group.checkbox {
            margin-top: -8px
        }

        .modal-dialog.auth .btn-primary {
            padding-left: 30px;
            padding-right: 30px;
            margin-top: 8px;
            font-weight: 500;
            font-size: 15px;
            line-height: 18px;
            height: 40px;
            min-width: 98px
        }

        .modal-dialog.auth.remove-auth .btn-primary {
            padding-left: 22px;
            padding-right: 22px
        }

        .modal-dialog.auth .btn-link {
            margin-top: 16px;
            padding: 0;
            font-size: 15px;
            line-height: 21px
        }

        .modal-dialog.auth .btn-link.btn-back {
            text-decoration: underline;
            margin: 0;
            font-size: inherit;
            color: inherit
        }

        .modal-dialog.auth .btn-block+.btn-block {
            margin-top: 16px;
            line-height: 26px
        }

        .modal-dialog.auth .btn-primary.btn-block.auth {
            margin-top: 30px
        }

        .modal-dialog.auth p.pseudo-label {
            margin-bottom: 8px
        }

        .modal-dialog.auth select {
            font-size: 15px;
            line-height: 18px
        }

        .modal-dialog.auth .form-group.password.su-p {
            margin-bottom: 30px
        }

        .modal-dialog.auth .form-group.country {
            margin-right: 8px
        }

        .modal-dialog.auth .form-group.daily_email {
            margin-top: -2px;
            margin-bottom: 0
        }

        .modal-dialog.auth label.form-check-label[for=daily_email] {
            color: #828282;
            font-size: 14px;
            line-height: 17px;
            letter-spacing: -.0275em
        }

        .modal-dialog.auth p.legal {
            margin-top: 16px;
            margin-bottom: 0;
            font-size: 14px;
            line-height: 20px;
            color: #828282;
            letter-spacing: -.0275em
        }

        .modal-dialog.auth .signup-callout {
            padding: 14px;
            background: #fafafa;
            border: 1px solid #ebebeb;
            border-radius: 6px
        }

        .modal-dialog.auth .signup-callout p {
            margin: 0;
            font-size: 14px;
            line-height: 20px;
            letter-spacing: -.0275em
        }

        .modal-dialog.auth .signup-callout p+p {
            margin-top: 4px
        }

        .modal-dialog.auth .signup-callout .btn-link {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: -.0275em;
            display: inline
        }

        .modal-dialog.auth .default-auth {
            padding-top: 30px
        }

        .modal-dialog.auth .auth-divider {
            padding-top: 9px;
            margin-bottom: 9px;
            border-bottom: 1px solid #d5d5d5;
            position: relative
        }

        .modal-dialog.auth .auth-divider span {
            position: absolute;
            background: #fff;
            color: #d5d5d5;
            width: 22px;
            display: inline-block;
            line-height: 18px;
            left: 50%;
            margin-left: -11px;
            top: -1px;
            text-align: center
        }

        .modal-dialog.auth .sso-block p.text-danger {
            margin-bottom: 5px;
            font-size: 12px
        }

        .modal-dialog.auth .chosen-sso {
            margin-bottom: 16px
        }

        .modal-dialog.auth .chosen-sso .change {
            margin: 4px 0 0;
            font-size: 14px;
            line-height: 20px
        }

        .modal-dialog.auth .email-req {
            margin-bottom: 16px;
            padding: 14px 14px 16px;
            background: #fafafa;
            border: 1px solid #ebebeb;
            border-radius: 8px
        }

        .modal-dialog.auth .email-req .prov-logo {
            margin-bottom: 13px;
            font-size: 15px;
            line-height: 18px
        }

        .modal-dialog.auth .email-req .prov-logo.facebook:before {
            margin-bottom: -6px;
            margin-right: 8px;
            content: "";
            width: 24px;
            height: 24px;
            background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAQDSURBVHgB1ZrLWdtAEMdnViZwSYwviW8RFQAdmAqACiAVAIdAbsAp4BziVBC7AqCCOBUAFURHSA4YuMAH2snMCowferPY4vd9gK1dSTP7mP3vLAgWmF6/mJ6agiUiNQeAHxFojgCnkYueapHHZR4BnRLptkI4OduvePBMEHIiRk9OllbY2CX+WoMcsDMnSE4D8O53XmcyO2Ba+01pjZDW+1v42TQB/N2sjmRyoLp5vf0ChnchgA4SNs7qb3fT3pPKgerWhUtQOpCxDaPB495YSNMbKqnC+82rJQLneITGC6688/3mxVJSxVgHPmxdr3G0OHipIROHvFOhcyDDNqFeOGI8t3oDCgARbZzXy6G2hDogw0ZaHgqEJn/5b71yOHh9yIFgwsqYtz5s2rKIoYYOONoDX7nmqsKP/Js/E/+gG3WziVDgzw9O7NJwVeeXXeNp9+ZWNzqNSieuVvXz1SrPyJ9R5YFNjpQv9F7vm8QPE8YFK5Dna2mx8k6S8Rmofdi8XO+90HVAhg4grYI19MK/b5UTsA3itqiBx69PPUBqB+y1/q4NoRaGDKWpCdXtBeOAmbiIi2AN3YQXhBSuPfZCMIm1U0NlZ+IS6KPzFK1vROHk0ztZfpdRYk0KpBcm36hV/tgIHFCwArYgbMcVm7kWRJMa9BmVzvhu/WDENFTwwHx6PpQJ/BNXzGvMd0vvq0kvKk2OVZGG9/5lVJk0Fnd/okBLy9SEw4oBqQajwwWLkKI5ljw4C68WchURjlwq2wJBzSpefV14pZDZM4xhs2ILsb0EufFFFXqDV29uIVK4sbxocySaCS8dXhvS8AwHwMujd6LuqW5dQR5EC3lQAHg851mPPIlCtrR6bmRFzTkXPZ7E+hTGDIu6XGpAtqiKu87+piOrISYpnB1UeMxSQh/CuMF8EsO/909NVoIjgChIFzIh6fKQh2q9HLWV5BBa47gxtHEfTsWnez/vt2ceNjTU4vTGdrYHoBt21UncGA3flyfHz0P/SP6aLeXNnS5EBi4LHHyMzcaBh7RHG14PzccFsScv5KfOyY+fJ1u7DohO4bj6A4pPs1eO9GXmbm/1juQgobBI5OsfKX0OyFzgBOoyFBWFO4NicOiAQ4aSZNagcHC27+u71uDV0BMaScjy+t6CooDUMjaFEHnEdFYvrxbCCTF+j22JIPaMzDgxxuEkUTHOeCHxlFK6jsjfGGV0YsM75lxsv7yeVDfRAeG8XmnI8Q4/dBTSu80yYT7qUG+Q1Hvih/A1X/1ywXNDbcedZ+WDPE16I+wgL45UPdDL2V6lKTIW0P8EdvRTOziVL89kNV7InZUQR/hPMziaghqRs8hRy8VEbWz+7UZkywmv/K3nnp/9By2bkkr4mFdeAAAAAElFTkSuQmCC) no-repeat 0 0/100%;
            display: inline-block;
            position: relative
        }

        .modal-dialog.auth .email-req p {
            margin-bottom: 0;
            line-height: 18px
        }

        .modal-dialog.forgot-password p.fp-delivered {
            padding-top: 45px
        }

        .modal-dialog.bidder-modal .modal-header {
            min-height: 56px
        }

        .modal-dialog.bidder-modal div.preload-wrap {
            margin: 0 auto 25px;
            width: 256px;
            height: 170px
        }

        .modal-dialog.bidder-modal h5 {
            margin-bottom: 0
        }

        .modal-dialog.bidder-modal p.state {
            margin-bottom: 14px;
            font-size: 15px;
            line-height: 36px
        }

        .modal-dialog.bidder-modal form {
            padding-top: 28px;
            border-top: 1px solid #e3e3e3
        }

        .modal-dialog.bidder-modal form .form-group {
            margin-bottom: 0
        }

        .modal-dialog.bidder-modal form label {
            margin-bottom: 0;
            margin-right: 7px;
            font-weight: 500;
            font-size: 20px;
            line-height: 24px
        }

        .modal-dialog.bidder-modal form label.disabled {
            cursor: default
        }

        .modal-dialog.bidder-modal form input[type=text] {
            margin-right: 8px;
            padding: 8px 16px;
            min-width: 126px;
            font-weight: 400;
            font-size: 18px;
            line-height: 21px;
            height: 44px
        }

        .modal-dialog.bidder-modal form input[type=text].error {
            border-color: #eb5e4b
        }

        .modal-dialog.bidder-modal form input[type=text]:disabled {
            border-color: #979797;
            background: #fff;
            opacity: .5
        }

        .modal-dialog.bidder-modal form button {
            white-space: nowrap;
            width: 94px;
            flex-shrink: 0
        }

        .modal-dialog.bidder-modal form p.text-danger {
            padding-left: 20px;
            padding-top: 16px;
            font-size: 15px;
            font-weight: 700;
            line-height: 18px;
            margin-bottom: 0
        }

        .modal-dialog.bidder-modal form p.text-danger .btn-link {
            color: inherit;
            text-decoration: underline;
            font-size: 15px;
            line-height: 18px;
            width: auto;
            text-align: left;
            vertical-align: initial
        }

        .modal-dialog.bidder-modal form p.note {
            margin-top: 3px;
            padding-left: 20px;
            padding-top: 16px;
            font-size: 15px;
            font-weight: 400;
            line-height: 18px;
            margin-bottom: 0
        }

        .modal-dialog.bidder-modal form p.highbidder-note {
            margin-top: -4px;
            margin-bottom: 24px;
            font-size: 15px;
            line-height: 21px;
            color: #eb5757
        }

        .modal-dialog.bidder-modal dl.breakdown {
            padding-top: 16px;
            border-top: 1px solid #e3e3e3;
            margin-bottom: 0;
            display: flex;
            flex-flow: row wrap
        }

        .modal-dialog.bidder-modal dl.breakdown dt {
            margin-bottom: 0;
            font-weight: 600;
            font-size: 15px;
            line-height: 24px;
            flex-basis: 50%
        }

        .modal-dialog.bidder-modal dl.breakdown dd {
            margin-bottom: 0;
            margin-left: auto;
            font-weight: 400;
            font-size: 15px;
            line-height: 24px;
            text-align: right;
            flex-basis: 50%
        }

        .modal-dialog.bidder-modal .bid-agreement {
            margin-top: 16px;
            padding-top: 20px;
            padding-bottom: 18px;
            border-top: 1px solid #e3e3e3
        }

        .modal-dialog.bidder-modal .bid-agreement p {
            margin-bottom: 0;
            font-size: 13px;
            line-height: 18px
        }

        .modal-dialog.bidder-modal .bid-agreement p a {
            color: #262626;
            text-decoration: underline
        }

        .modal-dialog.bidder-modal .bid-agreement p+p {
            margin-top: 14px
        }

        .modal-dialog.bidder-modal .btn-block {
            margin-top: 2px;
            height: 46px
        }

        .modal-dialog.bidder-modal .btn-block+.btn-link {
            margin-top: 14px;
            padding: 0;
            font-size: 15px;
            font-weight: 400
        }

        .modal-dialog.bidder-modal .btn-static {
            margin-bottom: 38px
        }


        .modal-dialog.centered-content .modal-logo {
            margin-top: -25px;
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
            align-items: center
        }


        #bidModal button {
            font-size: 16px;
            margin-top: 24px !important;
        }

        ul.nav.nav-tabs li {
            background: transparent;

            margin-left: 10px;
            border: 1px solid #dee2e6;
        }

        ul.nav.nav-tabs li a {
            color: #a6a6a7;
            padding: 5px 10px;
            text-decoration: none;
            font-size: 20px;
        }

        ul.nav.nav-tabs {
            margin-top: 20px;
        }

        a.active {
            background: #000 !important;
            border: 1px solid #000 !important;
            color: #fff !important;
            border: 1px;
            padding: 5px 10px;
        }

        .noth {
            padding: 7px 14px;
            border-radius: 15px;
            font-size: 14px;
        }

        span.noth1 {
            color: #fffc;
        }

        .btn-upvote {
            margin-right: 10px;
            border: 1px solid #979797;
            color: #979797;
            border-radius: 13px;
            padding: 2px 9px;
        }

        svg.reputation {
            margin-right: 5px;
        }

        .auction-stats-meta {
            margin-bottom: 47px;
            padding: 13px 0 0;
            border: 1px solid #eeeef0;
            border-radius: 6px;
        }

        .auction-stats-meta .current-bid h4 {
            padding-left: 11px;
            padding-right: 10px;
            margin-bottom: 0;
            font-weight: 700;
            font-size: 15px;
            line-height: 30px;
            white-space: nowrap;
        }

        .auction-stats-meta .current-bid .bid-value {
            margin-top: 1px;
            margin-left: 20px;
            font-weight: 700;
            font-size: 64px;
            line-height: 64px;
        }

        .auction-stats-meta .financing-cta {
            margin-top: 8px;
            margin-left: 20px;
        }

        .auction-stats-meta .btn-link:not(.btn-manage) {
            margin-left: 5px;
            padding: 0 6px;
            white-space: nowrap;
            text-decoration: underline;
            font-size: 15px;
            line-height: 23px;
            border: 0;
            background: rgba(74, 212, 147, .06);
            border-radius: 4px;
        }

        .auction-stats-meta ul.stats {
            margin-top: 4px;
            padding-left: 30px;
            align-self: start;
            flex-basis: 50%;
        }

        .auction-stats-meta ul.stats li {
            display: table-row;
        }

        .auction-stats-meta ul.stats li .th {
            display: table-cell;
            padding-right: 27px;
            font-weight: 600;
            font-size: 15px;
            line-height: 28px;
            white-space: nowrap;
            vertical-align: middle;
        }

        .auction-stats-meta ul.stats li .td {
            display: flex;
            align-items: center;
            font-weight: 400;
            font-size: 15px;
            line-height: 28px;
            min-height: 28px;
        }

        .username {
            display: flex;
            align-items: center;
        }

        .auction-stats-meta .current-bid {
            flex-basis: 50%;
        }

        .d-flex {
            gap: 0px !important;
        }

        .auction-subheading {
            margin-bottom: 16px;
            padding-left: 4px;
            position: relative;
        }

        h3 {
            padding-left: 10px;
            padding-right: 0;
            margin-bottom: 16px;
            font-size: 22px;
            line-height: 26px;
            font-weight: 700;
        }

        ul.stats li .td img {
            margin-left: 1px;
            margin-right: 7px;
            width: 18px;
            height: 16px;
        }

        .merch-top {
            display: flex;
        }

        .merch-top .share-icon {
            float: right;
            width: 100%;
        }

        .share-icon .share {
            float: right;
            background: transparent;
            border: none;
        }
    </style>
    <section class="GallerySec bg-gradient pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="merch-top">
                        <div class="header">
                            <h5>{{ $vechile->name }} <img src="{{ asset('frontend/images/3.png') }}" class="img-fluid"
                                    alt="">
                                @if (Auth::check())
                                    <button
                                        class="{{ $vechile->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                        onclick="setWishlist(this,{{ $vechile->id }})"></button>
                                @else
                                    <button class=" fa-star staricon" data-toggle="modal"
                                        data-target="#signup-btn"></button>
                                @endif
                            </h5>
                            {!! $vechile->short_desc !!}


                        </div>
                        <div class="share-icon">


                            <button class="sharethislink" data-toggle="modal" data-target="#shareModal">Share <i
                                    class="fa-solid fa-arrow-up-from-bracket"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 pr-3">
                    <div class="col-lg-12 col-md-12 col-12 p-0">
                        <a data-fancybox="gallery" href="{{ asset($vechile->image) }}">
                            <div class="Frame">
                                <figure class="main-image">
                                    <img src="{{ asset($vechile->image) }}" class="img-fluid" alt="">
                                </figure>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 pl-1">
                    <div class="col-lg-12 col-md-12 col-12 p-0">
                        <div class="row">
                            @if ($vechile->images)
                                @foreach (json_decode($vechile->images) as $key => $item)
                                    <a data-fancybox="gallery" class="w-50 p-1 {{ $key > 7 ? 'd-none' : '' }} "
                                        href="{{ asset($item) }}">
                                        <div class="Frame">
                                            <figure>
                                                @if ($key == 7)
                                                    <p class="overlay">All Photos
                                                        ({{ count(json_decode($vechile->images)) }})
                                                    </p>
                                                @endif
                                                <img src="{{ asset($item) }}" class="img-fluid" alt="">
                                            </figure>
                                        </div>
                                    </a>
                                @endforeach
                            @endif

                        </div>



                    </div>

                </div>
            </div>
        </div>
    </section>


    <section class="fixed-tabs">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tabs-sold">
                        <div class="data-timming">
                            <h6>{{ Carbon::parse($vechile->created_at)->format('d M, Y') }}</h6>
                            <h6><img src="{{ asset('front/images/48.png') }}" class="img-fluid" alt=""> Bids
                                {{ $bid_count }}</h6>
                            <h6><img src="{{ asset('front/images/49.png') }}" class="img-fluid" alt=""> Comments
                                {{ $comment_count }}</h6>
                        </div>
                    </div>
                    <div class="mt-3 row" id="po_sticky">
                        <div class="col-md-10">
                            @if (Carbon::parse($vechile->expire)->isPast())
                                <div class="timing-search sold">
                                    @if ($vechile->bids->last())
                                        <p class="text-center">Sold to {{ $vechile->bids->last()->user->name }} This
                                            auction has ended</p>
                                    @else
                                        <p class="text-center">Not Sold This auction has ended</p>
                                    @endif
                                </div>
                            @else
                                <ul class="timing-left bid-stats">
                                    <li class="time-left">
                                        <span><i class="fa-regular fa-clock countdown"></i> Time Left

                                            <b id="countdown">55:32</b></span>
                                    </li>
                                    <li class="time-left">
                                        <span><i class="fa-solid fa-arrow-up"></i> High Bid

                                            <b
                                                id="highbid">${{ $bid == null ? number_format($vechile->starting_bid, 0, '.', ',') : number_format($bid->bid, 0, '.', ',') }}</b></span>

                                    </li>
                                    <li class="time-left">
                                        <span><i class="fa-solid fa-arrow-up"></i> Bids <b>{{ $bid_count }}</b></span>
                                    </li>
                                    <li class="time-left">
                                        <span><i class="fa-regular fa-comment"></i> Comments
                                            <b>{{ $comment_count }}</b></span>
                                    </li>

                                </ul>
                            @endif


                        </div>
                        <div class="col-md-2">
                            @if (!Carbon::parse($vechile->expire)->isPast())
                                @if (Auth::check())
                                    @if ($vechile->seller->id != Auth::user()->id)
                                        <button class="btn btn-success btn-lg btn-bid plac-bid" data-toggle="modal"
                                            data-target="#bidModal">Place
                                            Bid</button>
                                    @endif
                                @else
                                    <button type="button" class="btn btn-success btn-lg btn-bid plac-bid"
                                        data-toggle="modal" data-target="#signup-btn" href="javascript:;">Place
                                        Bid</button>
                                @endif

                            @endif

                        </div>
                    </div>

                    <div class="quick-facts">
                        <dl>
                            <dt>Make</dt>
                            <dd><a>{{ $vechile->make->name }}</a></dd>
                            <dt>Model</dt>
                            <dd class="subscribeable"><a>{{ $vechile->name }}</a></dd>
                            <dt>Mileage</dt>
                            <dd class="wrappable">{{ number_format($vechile->mileage, 0, '.', ',') }}</dd>
                            <dt>VIN</dt>
                            <dd>{{ $vechile->vin }}</dd>
                            <dt>Title Status</dt>
                            <dd class="wrappable">{{ $vechile->title_status }}</dd>
                            <dt>Location</dt>
                            <dd class="wrappable"><a href="#" target="_blank"
                                    rel="noopener noreferrer">{{ $vechile->location }}</a>
                            </dd>
                            <dt>Seller</dt>
                            <dd class="seller">
                                <div class="username">
                                    <div class="photo float-left"><a title="fan_f1" class="usericon"><img
                                                src="{{ $vechile->seller->image ? asset($vechile->seller->image) : asset('front/images/default.png') }}"
                                                class="img-fluid" alt="fan_f1"></a></div>
                                    <div class="text"><a href="{{ route('profile', $vechile->seller->id) }}"
                                            title="fan_f1" class="user">{{ ucwords($vechile->seller->name) }}</a>
                                    </div>
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>Engine</dt>
                            <dd>{{ $vechile->engine }}</dd>
                            <dt>Drivetrain</dt>
                            <dd class="wrappable">{{ $vechile->drivetrain }}</dd>
                            <dt>Transmission</dt>
                            <dd class="wrappable">{{ ucwords($vechile->transmission_mode) }}</dd>
                            <dt>Body Style</dt>
                            <dd>{{ $vechile->bodyStyle->name }}</dd>
                            <dt>Exterior Color</dt>
                            <dd class="wrappable">{{ $vechile->exterior_color }}</dd>
                            <dt>Interior Color</dt>
                            <dd class="wrappable">{{ $vechile->interior_color }}</dd>
                            <dt>Seller Type</dt>
                            <dd class="wrappable">Private Party</dd>
                        </dl>
                    </div>
                    <div class="Dougs-Take d-none">
                        <div class="detail-section dougs-take">
                            <h4 class="d-flex align-items-center">Doug's Take</h4>
                            <div class="detail-body">
                                <p>The original Porsche Cayenne played a big role in convincing enthusiasts that an SUV
                                    could be made worthy of the Porsche emblem – and the GTS dialed up the performance even
                                    higher, boasting a 4.8-liter V8 rated at 405 horsepower. This particular Cayenne GTS
                                    features some modifications intended to enhance its off-road prowess, including a
                                    Eurowise 2.5-inch lift kit, an Arnott coil spring suspension conversion kit, 20-inch
                                    Black Rhino Axle wheels, and Falken Wildpeak all-terrain tires. It's also offered with a
                                    clean, accident-free Carfax report showing ownership in warm-climate Texas and
                                    California from new, for added buyer confidence.</p>
                            </div>
                        </div>
                    </div>
                 
                    <div class="detail-section detail-highlights">
                        <h4>Seller Q&A
                            @if (Auth::check())
                                <a class="ask-a-question" id="ask">Ask a Question</a>
                                <div class="qs-area" style="display: none">
                                    <form action="{{ route('ask.a.question') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="vechile" value="{{ $vechile->id }}">
                                        <div class="form-group">
                                            <label for="">Question:</label>
                                            <div class="ques-flex">
                                                <input type="text" class="form-control" name="question">

                                                <button class="btn btn-green">Post</button>

                                            </div>
                                        </div>

                                    </form>

                                </div>
                            @else
                                <a class="ask-a-question" data-toggle="modal" data-target="#signup-btn"
                                    href="javascript:;">Ask a Question</a>
                            @endif
                        </h4>

                        <div class="detail-answer">
                            <div class="owl-carousel">
                                @foreach ($questions as $item)
                                    <div class="card question-card item">
                                        <div>
                                            <div class="username">
                                                <div class="photo float-left"><a title="KXS" class="usericon"
                                                        href="/user/KXS"><img
                                                            src="{{ $item->user->image ? asset($item->user->image) : asset('front/images/default.png') }}"
                                                            class="img-fluid" alt="KXS"></a></div>
                                                <div class="text"><a title="KXS" class="user"
                                                        href="/user/KXS">{{ $item->user->name }}</a><span
                                                        class="user-extra"><svg class="verified" width="17"
                                                            height="17" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            aria-labelledby="v-30RLRDPMawesomo3000v">
                                                            <title id="v-30RLRDPMawesomo3000v">Registered Bidder
                                                            </title>
                                                            <path
                                                                d="M6.166 1.286c.952-1.715 3.418-1.715 4.37 0l.425.764.84-.24c1.886-.54 3.63 1.205 3.091 3.09l-.24.841.764.425c1.715.952 1.715 3.418 0 4.37l-.764.425.24.84c.54 1.886-1.205 3.63-3.09 3.091l-.841-.24-.424.764c-.953 1.715-3.419 1.715-4.371 0l-.425-.764-.84.24c-1.886.54-3.63-1.205-3.091-3.09l.24-.841-.764-.424c-1.715-.953-1.715-3.419 0-4.371l.764-.425-.24-.84C1.27 3.015 3.015 1.27 4.9 1.81l.841.24.425-.764z"
                                                                fill="#4AD493"></path>
                                                            <path d="M11.5 6.351l-3.625 4.5L6 9.033" stroke="#0F2236"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg></span>
                                                </div>
                                            </div>
                                            <p class="question">Q: {{ $item->content }}</p>

                                            @if ($item->answer)
                                                <p class="answer"><b>A:</b> {{ $item->answer->content }}</p>
                                            @else
                                                @if (Auth::check())
                                                    @if ($vechile->seller_id == Auth::user()->id)
                                                        <a id="answerthis" data-id="{{ $item->id }}"
                                                            data-question="{{ $item->content }}"
                                                            class="grey-italic">Answer
                                                            this question</a>
                                                    @else
                                                        <p class="grey-italic">Not yet Answer</p>
                                                    @endif
                                                @endif
                                            @endif

                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                    @if ($vechile->crash)
                        <div class="detail-section detail-highlights">
                            <h4>Crash Gallery</h4>
                            <div class="crash-img">
                                @foreach(json_decode($vechile->crash) as $item)
                                <img src="{{asset($item)}}" alt="" class="img-fluid">
                                @endforeach
                            </div>


                        </div>
                    @endif
                   {{-- <div class="description">
                        @if(strlen(trim($vechile->description)) > 0)

                            <h4 class="detail-h4 mt-2">Highlights</h4>
                            <p>{!! $vechile->description !!}</p>
                            
                        @endif
                        @if(strlen(trim($vechile->equipment)) > 0)
                            <h4  class="detail-h4 mt-2">Equipment</h4>
                            <p>{!! $vechile->equipment !!}</p>
                        @endif
                        @if(strlen(trim($vechile->flaw_content)) > 0)
                            <h4  class="detail-h4 mt-2">Known Flaw</h4>
                            <p> {!! $vechile->flaw_content !!}</p>
                        @endif
                        @if(strlen(trim($vechile->serv_history)) > 0)
                            <h4  class="detail-h4 mt-2">Recent Service History</h4>
                            <p> {!! $vechile->serv_history !!}</p>
                        @endif
                        @if(strlen(trim($vechile->issues)) > 0)
                            <h4  class="detail-h4 mt-2">Issues</h4>
                            <p>{!! $vechile->issues !!}</p>
                        @endif
                        @if(strlen(trim($vechile->history)) > 0)
                            <h4  class="detail-h4 mt-2">Ownership History</h4>
                            <p>{!! $vechile->history !!}</p>
                        @endif
                        @if(strlen(trim($vechile->videos)) > 0)
                            @if(count(json_decode($vechile->videos,true)) > 0)
                                <h4  class="detail-h4 mt-2">Videos</h4>
                                <div id="videosiframe">
                                    @foreach(json_decode($vechile->videos,true) as $item)
                                    <iframe width="50%" height="398" src="{{$item}}" title="Treaty of Hudaibya | By Sir Khurram Hussain" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                    @endforeach
                                </div>
                              
                            @endif
                        @endif
                    </div> --}}
                    {!! $vechile->description !!}
                    @if(count(json_decode($vechile->videos,true)) > 0)
                    <div class="detail-section">
                        <h4 class="detail-h4 mt-2">Videos</h4>
                        <div class="iframes">
                        @foreach(json_decode($vechile->videos,true) as $key => $item)

                                  <iframe width="50%" height="597" src="{{$item}}"frameborder="0" allowfullscreen></iframe>
                                @endforeach
                        </div>
                       
                            </div>
                    @endif
                    <div id="auction-jump" class="auction-subheading ">
                        <h3>{{ $vechile->name }} </h3>
                    </div>
                    <div class="auction-stats-meta ">
                        <div class="d-flex flex-column flex-md-row">
                            <div class="current-bid d-flex flex-column flex-shrink-1 ">
                                <div class="d-flex bidder">
                                    <h4>Current Bid</h4>
                                    @php
                                        if ($bid) {
                                            $image = $bid->user->image ? asset($bid->user->image) : asset('front/images/default.png');
                                            $sellerorbidder = $bid->user;
                                            $amount = number_format($bid->bid, 0, '.', ',');
                                        } else {
                                            $image = $vechile->seller->image ? asset($vechile->seller->image) : asset('front/images/default.png');
                                            $sellerorbidder = $vechile->seller;
                                            $amount = number_format($vechile->starting_bid, 0, '.', ',');
                                        }

                                    @endphp

                                    <div class="username">
                                        <div class="photo float-left"><a title="Takajo888" class="usericon"
                                                href="/user/Takajo888">
                                                <img src="{{ $image }}" id="cardbidderimg" alt="Takajo888"></a>
                                        </div>
                                        <div class="text"><a title="Takajo888" class="user"
                                                href="{{ route('profile', $sellerorbidder->id) }}"
                                                id="cardbiddername">{{ $sellerorbidder->name }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="bid-value"><span class="dollar">$</span>{{ $amount }}
                                </div>
                                <p class="financing-cta">Ready to buy? Get financing.*</p>
                            </div>

                            <ul class="stats">
                                <li>
                                    <div class="th">Seller</div>
                                    <div class="td">
                                        <div class="username">
                                            <div class="photo float-left"><a title="jy755" class="usericon"
                                                    href=""><img
                                                        src="{{ $vechile->seller->image ? asset($vechile->seller->image) : asset('front/images/default.png') }}"
                                                        alt="jy755"></a></div>
                                            <div class="text"><a title="jy755" class="user"
                                                    href="/user/jy755">{{ ucwords($vechile->seller->name) }}</a></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="th">Ending</div>
                                    <div class="td end-icon"><img src="{{ asset('front/images/calender.png') }}"
                                            class="img-fluid" alt="">
                                        {{ Carbon::parse($vechile->expire)->format('D, F d h:i A') }}
                                    </div>
                                </li>
                                <li>
                                    <div class="th">Bids</div>
                                    <div class="td bid-icon"><img src="{{ asset('front/images/bid.png') }}"
                                            class="img-fluid" alt=""> {{ $bid_count }}</div>
                                </li>
                                <li>
                                    <div class="th">Views</div>
                                    <div class="td views-icon"><img src="{{ asset('front/images/eye.png') }}"
                                            class="img-fluid" alt=""> {{ $vechile->views }}</div>
                                </li>
                            </ul>
                        </div>
                        <div class="grey-section flex-md-row">
                            @if (Auth::check())
                                @if ($vechile->seller->id != Auth::user()->id)
                                    <button class="white-btn plac-a-bid btn" type="button" data-toggle="modal"
                                        data-target="#bidModal">Place a Bid</button>
                                @endif
                            @else
                                <button type="button" class="white-btn plac-a-bid btn" data-toggle="modal"
                                    data-target="#signup-btn" href="javascript:;">Place a Bid</button>
                            @endif
                            <a href="{{ route('whycars') }}#buyimg-a-car" target="_blank"><i
                                    class="fa-regular fa-circle-question"></i> How buying works?</a>
                            <a href="javascript:void(0);" onclick="watchthis(this)"><i
                                    class="fa-regular fa-star"></i><span>Watch this action</span></a>
                            <a href="javascript:void(0);"onclick="notify(this)"><i id="notifyicon"
                                    class="fa-regular fa-bell"></i><span>Notify me for Centruy</span></a>
                        </div>

                    </div>




                    <div class="comments">
                        <div class="heading">
                            <h4>Comments &amp; Bids</h4>
                        </div>
                        <div class="d-flex">
                            <div class="messenger for-comments w-100 mb-2">
                                @if (!Carbon::parse($vechile->expire)->isPast())
                                    <div class="textarea">

                                        <textarea name="" class="form-control" id="commenttextarea" rows="5"></textarea>
                                        <div class="commentbtn">
                                            @if (Auth::check())
                                                @if (!Carbon::parse($vechile->expire)->isPast())
                                                    <button class="btn btn-sm btn-textarea plac-bid"
                                                        id="commentform">Comment</button>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-sm btn-textarea plac-bid"
                                                    data-toggle="modal" data-target="#signup-btn"
                                                    href="javascript:;">Sign Up</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#comment" aria-controls="comment"
                                    role="tab" class="active" data-toggle="tab">Comments</a></li>
                            <li role="presentation"><a href="#bids" aria-controls="bids" role="tab"
                                    data-toggle="tab">Bids</a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="comment">
                                <div id="commentreply" class="mt-4" style="display: none;">
                                    <h6 id="replyhead">Reply</h6>
                                    <textarea id="comentreply" class="form-control"></textarea>
                                    <button id="comment-btn" class="btn btn-primary mt-2 float-right">Comment</button>
                                </div>

                                <ul class="thread">
                                    @foreach ($vechile->comments as $item)
                                        <li class="comment">
                                            <div name="comment-3OVjgRjz">
                                                <div class="username">
                                                    <div class="photo float-left"><a title="KXS" class="usericon"
                                                            href="{{ route('profile', $item->user->id) }}"><img
                                                                src="{{ $item->user->image ? asset($item->user->image) : asset('front/images/default.png') }}"
                                                                class="img-fluid" alt="KXS"></a></div>
                                                    <div class="text"><a title="KXS" class="user"
                                                            href="{{ route('profile', $item->user->id) }}">{{ ucwords($item->user->name) }}
                                                            {!! $item->user->id == $vechile->seller->id ? '<span class="badge badge-primary">Seller</span>' : '' !!}</a><span class="user-extra"><span
                                                                class="time" data-full="1 hour ago"><span
                                                                    class="abbr">{{ Carbon::parse($item->created_at)->diffForHumans() }}</span></span></span>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="message">
                                                        @if ($item->reply_id != 0)
                                                            <p class="reply-text">Re:
                                                                {{ ucwords($item->reply->user->name) }}</p>
                                                        @endif
                                                        <p>{{ $item->comment }}</p>
                                                        <div class="commentsbutton">

                                                            <button
                                                                class="btn btn-sm btn-outline-secondary btn-upvote {{ Auth::check() ? $item->liked->isEmpty() : '' }}"
                                                                {{ Auth::check() ? '' : 'data-toggle=   modal data-target=#signup-btn' }}
                                                                data-comment="{{ $item->id }}"><svg
                                                                    class="reputation" width="8" height="10"
                                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                                    aria-labelledby="ir-9eNWmQw6uv">
                                                                    <title id="ir-9eNWmQw6uv">Reputation Icon</title>
                                                                    <path d="M4 1v8M1 4l3-3 3 3" stroke="#828282"
                                                                        stroke-width="1.25" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </svg><span>{{ $item->like->count() }}</span></button>
                                                            <a data-comment-id="{{ $item->id }}"
                                                                data-user="{{ ucwords($item->user->name) }}"
                                                                {{ Auth::check() ? 'class=reply-comment' : 'data-toggle=modal data-target=#signup-btn' }}
                                                                href="javascript:;">Reply <i
                                                                    class="fa-solid fa-reply"></i></a>
                                                            @if (Auth::check())
                                                                @if (!$item->flagged->isEmpty())
                                                                    <a data-comment-id="{{ $item->id }}"
                                                                        class='flag-inapp'
                                                                        href="javascript:;"><span>Unmark Flag as
                                                                            Inappropiate</span> <i
                                                                            class="fa-solid fa-flag"></i></a>
                                                                @else
                                                                    <a data-comment-id="{{ $item->id }}"
                                                                        class='flag-inapp' href="javascript:;"><span>Flag
                                                                            as
                                                                            Inappropiate</span> <i
                                                                            class="fa-regular fa-flag"></i></a>
                                                                @endif
                                                            @else
                                                                <a data-comment-id="{{ $item->id }}"
                                                                    data-toggle='modal' data-target='#signup-btn'
                                                                    href="javascript:;"><span>Flag as
                                                                        Inappropiate</span> <i
                                                                        class="fa-solid fa-flag"></i></a>
                                                            @endif



                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach




                                </ul>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="bids">
                                <ul class="thread">
                                    @foreach ($vechile->bids as $item)
                                        <li class="comment">
                                            <div name="comment-3OVjgRjz">
                                                <div class="username">
                                                    <div class="photo float-left"><a title="KXS" class="usericon"
                                                            href="{{ route('profile', $item->user->id) }}"><img
                                                                src="{{ $item->user->image ? asset($item->user->image) : asset('front/images/default.png') }}"
                                                                class="img-fluid" alt="KXS"></a></div>
                                                    <div class="text"><a title="KXS" class="user"
                                                            href="{{ route('profile', $item->user->id) }}">{{ $item->user->name }}</a><span
                                                            class="user-extra"><svg class="verified" width="17"
                                                                height="17" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                aria-labelledby="v-30RLRDPMawesomo3000v">
                                                                <title id="v-30RLRDPMawesomo3000v">Registered Bidder
                                                                </title>
                                                                <path
                                                                    d="M6.166 1.286c.952-1.715 3.418-1.715 4.37 0l.425.764.84-.24c1.886-.54 3.63 1.205 3.091 3.09l-.24.841.764.425c1.715.952 1.715 3.418 0 4.37l-.764.425.24.84c.54 1.886-1.205 3.63-3.09 3.091l-.841-.24-.424.764c-.953 1.715-3.419 1.715-4.371 0l-.425-.764-.84.24c-1.886.54-3.63-1.205-3.091-3.09l.24-.841-.764-.424c-1.715-.953-1.715-3.419 0-4.371l.764-.425-.24-.84C1.27 3.015 3.015 1.27 4.9 1.81l.841.24.425-.764z"
                                                                    fill="#4AD493"></path>
                                                                <path d="M11.5 6.351l-3.625 4.5L6 9.033" stroke="#0F2236"
                                                                    stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg><span class="time ml-2" data-full="1 hour ago"><span
                                                                    class="abbr">{{ Carbon::parse($item->created_at)->diffForHumans() }}</span></span></span>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="message">

                                                        <p><span class="badge badge-dark noth"><span
                                                                    class="noth1">Bid</span> ${{ $item->bid }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach




                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mian-side-bar">
                        <div class="h-mian">
                            <h5>New Listings</h5>
                        </div>
                        @foreach ($all as $item)
                            <a href="{{ route('vehicleDetail', $item->slug) }}" class="item">
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
                                <div class="">
                                    <h5 class="mb-0"><a href="{{ route('vehicleDetail', $item->slug) }}"
                                            class="text-dark">{{ $item->name }}</a></h5>
                                    @if (Auth::check())
                                        <button
                                            class="{{ $item->users()->where('user_id', Auth::user()->id)->exists()? 'fa-solid': 'fa-regular' }} fa-star staricon"
                                            onclick="setWishlist(this,{{ $item->id }})"></button>
                                    @else
                                        <button class="fa-regular fa-star staricon" data-toggle="modal"
                                            data-target="#signup-btn"></button>
                                    @endif
                                    {!! $item->short_desc !!}
                                </div>
                            </a>
                        @endforeach


                    </div>


                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2>Share this car</h2>
                    <ul class="sharebuttons">
                        <button class="btn" onclick="copyLink()">Copy this link</button>
                        <button class="btn" onclick="share_fb()">Facebook</button>
                        <button class="btn" onclick="share_twiiter()">Twitter</button>
                        <button class="btn" onclick="share_reddit()">Reddit</button>
                        <button class="btn" onclick="shareByEmail()">Email</button>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @if(Auth::check())
        <div class="modal fade" id="bidModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog register-to-bid-modal centered-content modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-logo"><svg width="61" height="29" viewBox="0 0 61 29"
                                class="carsandbids" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M27.3309 2.5H40.974C41.1857 2.5 41.3748 2.63219 41.4476 2.83098L44.4382 11H47.1005L43.7952 1.97153C43.3617 0.787413 42.2349 0 40.974 0H27.3309C25.9223 0 24.7028 0.978688 24.3978 2.35391L22.4805 11H25.0412L26.8385 2.89517C26.8897 2.6643 27.0945 2.5 27.3309 2.5Z"
                                    fill="#292929"></path>
                                <path
                                    d="M25.7239 0H27.3921L25.0248 3.04476L24.248 3.08484C24.3754 2.18474 24.3581 1.92343 24.4847 1.2016C24.5541 0.805277 24.7031 0 25.7239 0Z"
                                    fill="#292929"></path>
                                <path
                                    d="M57.1106 12.5H21.8894C21.6743 12.5 21.5 12.6743 21.5 12.8894V17.5L20 19.5L19 19.6667V12.8894C19 11.2936 20.2936 10 21.8894 10H57.1106C58.7064 10 60 11.2936 60 12.8894V19.6429L59 19.5L57.5 17.5V12.8894C57.5 12.6743 57.3257 12.5 57.1106 12.5Z"
                                    fill="#292929"></path>
                                <path d="M48.5 23.5H30.5L29.5 25L29.4167 26H49V25L48.5 23.5Z" fill="#292929"></path>
                                <rect x="46" y="14" width="4" height="1.5" rx="0.75"
                                    fill="#292929"></rect>
                                <path
                                    d="M27.5647 10.0158C25.1505 10.0158 25.5529 8.60752 25.8211 7.4004L24.7481 7.19922L23.3398 10.6194H27.2148L27.5647 10.0158Z"
                                    fill="#292929"></path>
                                <circle cx="54" cy="22" r="5.75" stroke="#292929"
                                    stroke-width="2.5"></circle>
                                <circle cx="25" cy="22" r="5.75" stroke="#292929"
                                    stroke-width="2.5"></circle>
                                <rect x="7" y="12" width="7" height="2" rx="1"
                                    fill="#292929"></rect>
                                <rect y="16" width="12" height="2" rx="1" fill="#292929">
                                </rect>
                                <rect x="5" y="20" width="10" height="2" rx="1"
                                    fill="#292929"></rect>
                            </svg></div>
                        <h5 class="text-center">Register to bid</h5>
                        <p class="prompt">We require a valid credit card on file before you can bid. Winning bidders pay a
                            4.5%
                            buyer’s fee to Cars &amp; Bids on top of the winning bid amount. The minimum buyer’s fee is
                            $225,
                            and the maximum is $4,500.<br><br>Bids are binding, so please bid wisely!</p>
                        <form class="bidForm">
                            <h6 class="exists">Credit Card Information</h6>
                            <input type="hidden" name="vehile_id" id="vehile_id" value="{{ $vechile->id }}" />
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
                            <div class="card-js mb-3 exists">
                                <input class="card-number my-custom-class" name="card_number"
                                    value="{{ Auth::user()->card_number }}" required>
                                <input class="name" id="the-card-name-id" name="card_holders_name"
                                    value="{{ Auth::user()->name_card }}" placeholder="Name on card" required />
                                <input class="expiry" name="expiry" value="{{ Auth::user()->expiry_month }}">
                                <input class="expiry-month" name="expiry_month" value="{{ Auth::user()->expiry_month }}"
                                    required>
                                <input class="expiry-year" name="expiry_year" value="{{ Auth::user()->expiry_year }}"
                                    required>
                                <input class="cvc" name="cvc" value="{{ Auth::user()->cvc }}" required>
                            </div>
                            <h6>Contact Information</h6>
                            <p class="pseudo-label exists">Phone Number (in the event you win an auction)</p>

                            <fieldset class="form-group phone mb-3 exists"><label for="phone" class="sr-only">Phone
                                    Number</label><input type="text" class="form-control" name="phone"
                                    id="phone" placeholder="Phone Number" value="{{ Auth::user()->phone }}"
                                    required></fieldset>



                            <fieldset class="form-group mb-3 exists"><label for="bid"></label><input
                                    class="form-control" type="text" name="zip_code" id="zip_code"
                                    placeholder="Zip or Postal Code" value="{{ Auth::user()->zip_code }}" required>
                            </fieldset>
                            <fieldset class="form-group "><label for="bid"></label><input class="form-control"
                                    type="number" step="0.01" name="bid" id="bid"
                                    placeholder="Bid Amount" required></fieldset>
                            <button type="submit" class="btn btn-lg btn-bid mt-3">Register to bid</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="share" tabindex="-1" role="dialog" ari a-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="answer" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Answer Seller Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('answer-question') }}" method="POST">
                            @csrf
                            <input type="hidden" name="question_id" id="modalquestion">
                            <input type="hidden" name="vechile_id" value="{{ $vechile->id }}">
                            <div class="form-group">
                                <label class="question-label">Q: <span id="quesname"></span></label>
                                <p class="answer-label">Answer:</p>
                                <textarea name="content" class="form-control" id="" cols="20" rows="4"></textarea>
                            </div>
                            <button class="btn btn-green m-0 mt-2 p-2 w-100">Post Answer</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="notifymodal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <svg width="61" height="29" viewBox="0 0 61 29" class="carsandbids" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M27.3309 2.5H40.974C41.1857 2.5 41.3748 2.63219 41.4476 2.83098L44.4382 11H47.1005L43.7952 1.97153C43.3617 0.787413 42.2349 0 40.974 0H27.3309C25.9223 0 24.7028 0.978688 24.3978 2.35391L22.4805 11H25.0412L26.8385 2.89517C26.8897 2.6643 27.0945 2.5 27.3309 2.5Z"
                                fill="#292929"></path>
                            <path
                                d="M25.7239 0H27.3921L25.0248 3.04476L24.248 3.08484C24.3754 2.18474 24.3581 1.92343 24.4847 1.2016C24.5541 0.805277 24.7031 0 25.7239 0Z"
                                fill="#292929"></path>
                            <path
                                d="M57.1106 12.5H21.8894C21.6743 12.5 21.5 12.6743 21.5 12.8894V17.5L20 19.5L19 19.6667V12.8894C19 11.2936 20.2936 10 21.8894 10H57.1106C58.7064 10 60 11.2936 60 12.8894V19.6429L59 19.5L57.5 17.5V12.8894C57.5 12.6743 57.3257 12.5 57.1106 12.5Z"
                                fill="#292929"></path>
                            <path d="M48.5 23.5H30.5L29.5 25L29.4167 26H49V25L48.5 23.5Z" fill="#292929"></path>
                            <rect x="46" y="14" width="4" height="1.5" rx="0.75"
                                fill="#292929"></rect>
                            <path
                                d="M27.5647 10.0158C25.1505 10.0158 25.5529 8.60752 25.8211 7.4004L24.7481 7.19922L23.3398 10.6194H27.2148L27.5647 10.0158Z"
                                fill="#292929"></path>
                            <circle cx="54" cy="22" r="5.75" stroke="#292929" stroke-width="2.5">
                            </circle>
                            <circle cx="25" cy="22" r="5.75" stroke="#292929" stroke-width="2.5">
                            </circle>
                            <rect x="7" y="12" width="7" height="2" rx="1"
                                fill="#292929"></rect>
                            <rect y="16" width="12" height="2" rx="1" fill="#292929"></rect>
                            <rect x="5" y="20" width="10" height="2" rx="1"
                                fill="#292929"></rect>
                        </svg>
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Saved Search</h5>
                        <span class="badge badge-custom">{{ $vechile->make->name }}</span>
                        <div class="custom-design">
                            <div class="text-content">
                                <h6>Email me...</h6>
                                <p>When new auction go live</p>
                            </div>
                            <div class="switch-toggle">
                                <div class="form-check form-switch">
                                    <input id="toggle-event" type="checkbox" checked data-toggle="toggle">

                                </div>
                            </div>


                        </div>
                        <button class="w-100 btn-save btn">Save</button>
                        <a class="text-center text-danger" href="">Delete this Saved Search</a>
                    </div>

                </div>
            </div>
        </div>
    @endif
@endsection
@push('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        a#answerthis {
            color: #4ad493;
            font-style: italic;
        }

        label.question-label {
            font-weight: 500;
        }

        p.answer-label {
            color: #655c5c;
            font-weight: 500;
            font-style: italic;
        }
    </style>
@endpush
@push('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        function share_fb() {
            window.open('https://www.facebook.com/sharer/sharer.php?u=' + window.location.href, 'facebook-share-dialog',
                "width=626, height=436")
        }

        function share_twiiter() {
            window.open('http://twitter.com/share?url' + window.location.href,
                "width=626, height=436")
        }

        function share_reddit() {
            window.open('https://www.reddit.com/submit?url=' + window.location.href,
                "width=626, height=436")
        }

        function shareByEmail() {
            var subject = encodeURIComponent("I wanted you to see this site");
            var body = encodeURIComponent("Check out this car " + window.location.href);
            var mailtoLink = "mailto:?subject=bidcar&body=Bids is closing soon";

            window.location.href = mailtoLink;
        }

        function copyLink() {

            var link = window.location.href;


            navigator.clipboard.writeText(link)
            alert("Link copied to clipboard: " + link);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#comment-btn').click(function() {
            if ($('#comentreply').val().length > 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    _token: "{{ csrf_token() }}",
                    url: "{{ route('reply') }}",
                    type: "post",
                    data: {
                        comment: $('#comentreply').val(),
                        reply_id: $('#comentreply').data('comment-id'),
                        vechile: '{{ $vechile->id }}'
                    },
                    success: function(response) {
                        if (response.status) {
                            $.toast({
                                heading: 'Success',
                                text: 'Replied successfully',
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                            $('#comment ul.thread').prepend(` <li class="comment">
                                                <div name="comment-3OVjgRjz">
                                                    <div class="username">
                                                        <div class="photo float-left"><a title="KXS" class="usericon" href="/user/KXS"><img src="${response.image}" class="img-fluid" alt="KXS"></a></div>
                                                        <div class="text"><a title="KXS" class="user" href="/user/KXS">${response.name}</a><span class="user-extra"><span class="time" data-full="${response.date}"><span class="abbr">${response.date}</span></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <div class="message">
                                                            <p class="reply-text">${response.from}</p>
                                                            <p>${ $('#comentreply').val()}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>`)


                        } else {
                            $.toast({
                                heading: 'Sorry',
                                text: 'Can\'t replied!',
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                        }
                        $('#comentreply').val('')
                        $('#comentreply').html('')
                    }
                })

            } else {
                $.toast({
                    heading: 'Sorry',
                    text: 'Can\'t post blank comment.',
                    showHideTransition: 'slide',
                    icon: 'error'
                })
            }

        })
        $('.reply-comment').click(function() {
            $('#replyhead').html('Replying to <span class="text-primary">' + $(this).data('user') + '</span>')
            $('#comentreply').attr('data-comment-id', $(this).data('comment-id'))
            $('#commentreply').slideDown()
            document.getElementById('replyhead').scrollIntoView(true);

        })
        $('#answerthis').click(function() {
            $('#modalquestion').val($(this).data('id'));
            $('#quesname').text($(this).data('question'));

            $('#answer').modal()

        })
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel();
        });
        const targetDateTime = moment("{{ $vechile->expire }}");

        function updateCountdown() {
            // Get the current date and time
            const now = moment();

            // Calculate the duration between now and the targetDateTime
            const duration = moment.duration(targetDateTime.diff(now));
            // Get the remaining hours, minutes, and seconds
            const days = duration.days();
            const hours = duration.hours();
            const minutes = duration.minutes();
            const seconds = duration.seconds();

            // Update the countdown display
            const countdownElement = document.getElementById("countdown");
            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

            // Check if the countdown has reached zero
            if (duration.asSeconds() <= 0) {
                console.log('here');
                clearInterval(timerInterval);
                $('.plac-bid').slideUp();
                $('#countdown').text('Checking...')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    _token: "{{ csrf_token() }}",
                    url: "{{ route('highbid') }}",
                    type: "post",
                    data: {
                        vechile: "{{ $vechile->id }}"
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#countdown').text(`Sold to ${response.name}`)

                        } else {
                            $('#countdown').text(response.message)

                        }

                    }
                });
            }
        }
        if (targetDateTime.isAfter()) {

            var timerInterval = setInterval(updateCountdown, 1000);

            updateCountdown();
        }
    </script>
    <script>
        $('#ask').click(function() {
            $(this).next().slideToggle();
        })
        $('#commentform').click(function(e) {
            if ($('#commenttextarea').val().length != 0) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    _token: "{{ csrf_token() }}",
                    url: "{{ route('comment') }}",
                    type: "post",
                    data: {
                        comment: $('#commenttextarea').val(),
                        vehcile: '{{ $vechile->id }}'
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $.toast({
                                heading: 'Sumbitted',
                                text: response.message,
                                showHideTransition: 'slide',
                                icon: 'success'
                            })
                        } else {
                            $.toast({
                                heading: 'Error',
                                text: 'Can\'t comment, please try again!',
                                showHideTransition: 'slide',
                                icon: 'error'
                            })
                        }
                        $('#comment ul.thread').prepend(` <li class="comment">
                                                <div name="comment-3OVjgRjz">
                                                    <div class="username">
                                                        <div class="photo float-left"><a title="KXS" class="usericon" href="/user/KXS"><img src="${response.image}" class="img-fluid" alt="KXS"></a></div>
                                                        <div class="text"><a title="KXS" class="user" href="/user/KXS">${response.name}</a><span class="user-extra"><span class="time" data-full="${response.date}"><span class="abbr">${response.date}</span></span></span>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <div class="message">
                                                            <p>${ $('#commenttextarea').val()}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>`)

                        $('#commenttextarea').val('');

                    }
                })
            } else {
                $.toast({
                    heading: 'Error',
                    text: 'Can\'t post empty comment',
                    showHideTransition: 'slide',
                    icon: 'error'
                })
            }

        })

        $('.flag-inapp').click(function() {
            let flag = $(this)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('flag') }}",
                type: "post",
                data: {
                    comment: $(this).data('comment-id')
                },
                dataType: "json",
                success: function(response) {

                    if (response.status) {
                        $.toast({
                            heading: 'Flag report',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        flag.find('span').text('Flag as Inappropiate')

                        flag.find('i').attr('class', 'fa-regular fa-flag')

                    } else {
                        $.toast({
                            heading: 'Flag report',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: '$item->iddanger'
                        })
                        flag.find('span').text('Flag as Inappropiate')
                        flag.find('i').attr('class', 'fa-solid fa-flag')

                    }
                }
            })

        })
        @if (Auth::check())
            $('.btn-upvote').click(function() {
                let reputation = $(this)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    _token: "{{ csrf_token() }}",
                    url: "{{ route('reputation') }}",
                    type: "post",
                    data: {
                        user_id: '{{ Auth::user()->id }}',
                        vehicle_id: '{{ $vechile->id }}',
                        comment_id: reputation.data('comment')
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            if (response.like) {
                                $.toast({
                                    heading: 'Reputation',
                                    text: response.message,
                                    showHideTransition: 'slide',
                                    icon: 'success'
                                })
                                reputation.css({
                                    'background-color': '#0129FF',
                                    'color': '#fff'
                                });
                                reputation.find('path').css({
                                    'stroke': '#fff'
                                });
                                reputation.find('span').text(response.count);
                            } else {
                                $.toast({
                                    heading: 'Reputation',
                                    text: response.message,
                                    showHideTransition: 'slide',
                                    icon: 'success'
                                })
                                reputation.css({
                                    'background-color': 'transparent',
                                    'color': '#828282'
                                });
                                reputation.find('path').css({
                                    'stroke': '#828282'
                                });
                                reputation.find('span').text(response.count);
                            }


                        } else {


                        }
                    }
                })

            });
        @endif


        $('.bidForm').submit(function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('bid') }}",
                type: "post",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {

                    if (response.status) {
                        console.log(Number($('#bid').val()));
                        $('.bid-value').html('<span class="dollar">$</span>' + Number($('#bid').val())
                            .toLocaleString())
                        $('#cardbidderimg').attr('src', response.image)
                        $('#cardbiddername').text(response.name)
                        $('#highbid').text('$' + Number($('#bid').val()).toLocaleString());

                        $.toast({
                            heading: 'Sumbitted',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        $('#bids ul.thread').append(`<li class="comment">
                                            <div name="comment-3OVjgRjz">
                                                <div class="username">
                                                    <div class="photo float-left"><a title="KXS" class="usericon" href="/user/KXS"><img src="${response.image}" class="img-fluid" alt="KXS"></a></div>
                                                    <div class="text"><a title="KXS" class="user" href="/user/KXS">${response.name}</a><span class="user-extra"><svg class="verified" width="17" height="17" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="v-30RLRDPMawesomo3000v">
                                                                <title id="v-30RLRDPMawesomo3000v">Registered Bidder
                                                                </title>
                                                                <path d="M6.166 1.286c.952-1.715 3.418-1.715 4.37 0l.425.764.84-.24c1.886-.54 3.63 1.205 3.091 3.09l-.24.841.764.425c1.715.952 1.715 3.418 0 4.37l-.764.425.24.84c.54 1.886-1.205 3.63-3.09 3.091l-.841-.24-.424.764c-.953 1.715-3.419 1.715-4.371 0l-.425-.764-.84.24c-1.886.54-3.63-1.205-3.091-3.09l.24-.841-.764-.424c-1.715-.953-1.715-3.419 0-4.371l.764-.425-.24-.84C1.27 3.015 3.015 1.27 4.9 1.81l.841.24.425-.764z" fill="#4AD493"></path>
                                                                <path d="M11.5 6.351l-3.625 4.5L6 9.033" stroke="#0F2236" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg><span class="time ml-2" data-full="1 hour ago"><span class="abbr">${response.date}</span></span></span>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    <div class="message">

                                                        <p><span class="badge badge-dark noth"><span class="noth1">Bid</span> $${response.amount}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>`)


                    } else {


                        $.toast({
                            heading: 'Can\'t Bid, please try again!',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'error'
                        })
                    }
                    $('.bidForm')[0].reset();

                }
            });
        })


        function watchthis(event) {
            if ($(event).find('i').hasClass('fa-regular')) {
                $(event).find('i').attr('class', 'fa-solid fa-star active')
                $(event).find('span').text('Watching this auction')

            } else if ($(event).find('i').hasClass('fa-solid')) {
                $(event).find('i').attr('class', 'fa-regular fa-star')
                $(event).find('span').text('Watch this auction')
            }


        }
        $('#toggle-event').change(function() {
            console.log('HERE');
            if ($(this).prop('checked')) {
                $('#notifyicon').attr('class', 'fa-solid fa-bell active')

            } else {
                $('#notifyicon').attr('class', 'fa-regular fa-bell')

            }
        })

        function notify(event) {
            $('#notifymodal').modal('show');




        }
        // jQuery document ready
        $(document).ready(function() {
            @if (Auth::check())

                $('.expiry').val('{{ Auth::user()->expiry_month }}/{{ Auth::user()->expiry_year }}')
                @if (Auth::user()->card_number != null)
                    $('.exists').hide()
                @endif
            @endif
        });
    </script>
@endpush
