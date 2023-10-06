@extends('layouts.app')
@section('content')
<div class="page container subflow account">
  <div class="row subbody">
    <div class="col container">
      <div class="user-heading">
        <div class="user-hero">
          <img src="{{ $user->image ? asset($user->image) : asset('front/images/default.png') }}" alt="KDS580">
        </div>
        <div class="metadata">
          <h1 class="" style="text-transform: capitalize;">{{ $user->name }}</h1>
          <p class="badges">
            <span class="reputation">
              <span class="rep">
                <svg class="reputation" width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="ir-profile-rep">
                  <title id="ir-profile-rep">Reputation Icon</title>
                  <path d="M5.125 1V12" stroke="#262626" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"></path>
                  <path d="M1 5.125L5.125 1L9.25 5.125" stroke="#262626" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>{{ $count }} </span>Reputation Score </span>
                <p>Total win <span>{{ $user->win }}</span></p>
          </p>
          <p>Joined {{ Carbon::parse($user->created_at)->format('F Y') }}</p>
        </div>
      </div>
      <div class="section">
        <p class="bio"></p>
      </div>
    @if(count($user->vehicle) > 0)
      <div class="section">

        <h2>Cars Auctioned <span>(Listed {{ count($user->vehicle) }} Car)</span>
        </h2>
        <ul class="car-cards">
        @foreach($user->vehicle as $item)
          <li class="auction-item ">
            <div class="LazyLoad is-visible">
              <a class="hero" title="{{ $item->name }}" href="{{ route('vehicleDetail', $item->slug) }}">
                <div class="ratio">
                  <div class="preload-wrap  loaded">
                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                  </div>
                </div>

              </a>
            </div>
            <div class="metadata">
              <div class="auction-title">
                <a title="{{ $item->name }}" href="{{ route('vehicleDetail', $item->slug) }}">{{ $item->name }}</a>
              </div>
              <p class="auction-subtitle">  {!! $item->short_desc !!}</p>
              <p class="auction-loc">{{ $item->location }}</p>
              <p class="auction-time">{{ Carbon::parse($item->created_at)->format('F d, Y') }}</p>
            </div>
          </li>
        @endforeach
        </ul>
      </div>
    @endif

      <div class="section">

        <h2>Bid History <span>(Bid on {{ count($user->bids) }} Cars)</span>
        </h2>
        <ul class="car-cards">
        @foreach($user->bids as $item)
          <li class="auction-item ">
            <div class="LazyLoad is-visible">
              <a class="hero" title="{{ $item->vehicle->name }}" href="{{ route('vehicleDetail', $item->vehicle->slug) }}">
                <div class="ratio">
                  <div class="preload-wrap  loaded">
                    <img src="{{ asset($item->vehicle->image) }}" alt="{{ $item->vehicle->name }}">
                  </div>
                </div>

              </a>
            </div>
            <div class="metadata">
              <div class="auction-title">
                <a title="{{ $item->vehicle->name }}" href="{{ route('vehicleDetail', $item->vehicle->slug) }}">{{ $item->name }}</a>
              </div>
              <p class="auction-subtitle">  {!! $item->vehicle->short_desc !!}</p>
              <p class="auction-loc">{{ $item->vehicle->location }}</p>
              <p class="auction-time">{{ Carbon::parse($item->vehicle->created_at)->format('F d, Y') }}</p>
            </div>
          </li>
        @endforeach
        </ul>
      </div>
      <div class="section">
        <h2>Comments <span>({{ count($user->comment) }} Comments)</span>
        </h2>
        <ul class="comment-cards">
        @foreach($user->comment as $item)

          <li class="auction-items ">
            <div class="LazyLoad is-visible">
              <a class="hero" title="{{ $item->vehicle->name }}" href="/auctions/rkbAaXNR/2014-ford-mustang-gt1000-hellanor-by-armageddon">
                <div class="ratio">
                  <div class="preload-wrap  loaded">
                    <img src="{{ asset($item->vehicle->image) }}" alt="{{ $item->vehicle->name }}">
                  </div>
                </div>

              </a>
            </div>
            <div class="metadata">
              <div class="auction-title">
                <a title="{{ $item->vehicle->name }}" href="{{ route('vehicleDetail', $item->vehicle->slug) }}">{{ $item->vehicle->name }}</a>
              </div>
              <div class="comment-time">{{ Carbon::parse($item->created_at)->format('F d, Y h:m A') }}</div>
              <div class="comment-text">
                <p>{!! $item->comment !!}</p>
              </div>
              <!-- <div class="interact">
                <button class="btn btn-sm btn-outline-secondary btn-upvote" disabled="">
                  <svg class="reputation" width="8" height="10" fill="none" xmlns="http://www.w3.org/2000/svg" aria-labelledby="ir-3zZ16wEBuv">
                    <title id="ir-3zZ16wEBuv">Reputation Icon</title>
                    <path d="M4 1v8M1 4l3-3 3 3" stroke="#828282" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>1 </button>
              </div> -->
            </div>
          </li>
        @endforeach
        </ul>
        <!-- <button type="button" class="btn btn-primary btn-lg load-more-comments">Load more comments</button> -->
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

.user-heading {
    display: flex;
    align-items: center;
}

.user-hero {
    height: 150px;
    width: 150px;
    margin-right: 32px;
    margin-bottom: 0;
}

.user-hero img {
    height: 100%;
    width: 100%;
}

.metadata{
    padding-top: 15px;
    display: block;
}

.subflow.account .user-heading .metadata h1 {
    margin-bottom: 8px;
    font-size:28px;
    font-weight: 700;
}

.subflow.account .section {
    padding-top: 32px;
}

.subflow.account .section {
    display: flex;
    flex-direction: column;
}

.subflow.account .section+.section {
    border-top: 1px solid #ebebeb;
}

.subflow .row.subbody {
    padding-top: 65px;
}

ul.car-cards {
    display: flex;
    flex-wrap: wrap;
}

li.auction-item {
    margin-right: 33px;
    margin-bottom: 54px;
    width: 28.333%;
}

.preload-wrap.loaded img {
    height: 150px;
    width: 100%;
}

.bid-bar {
    display: flex;
    position: absolute;
    bottom: 8px;
    left: 8px;
}

.bid-bar .bar-bg {
    margin: 0;
    background: #262626;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    display: flex;
    flex-grow: 1;
    align-items: center;
}

.bid-bar.mini .bid-stats {
    padding: 4px 8px;
    height: 25px;
    justify-content: flex-start;
}

.bid-bar .bid-stats, .bid-bar .bid-stats li {
    display: flex;
    align-items: center;
}

.bid-bar.mini .bid-stats li span.value {
    font-weight: 500;
    font-size: 14px;
    line-height: 17px;
}

.auction-item a.hero .ratio {
    position: relative;
    padding-bottom: 65.56%;
}

div.preload-wrap {
    overflow: hidden;
    background: #fafafa;
    border-radius: 3px;
}

.auction-item a.hero .ratio .preload-wrap {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.subflow.account ul.car-cards li.auction-item a.hero .preload-wrap {
    width: 218px;
    height: 143px;
}

div.preload-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 3px;
    opacity: 1;
}

.auction-item a.hero .bid-bar {
    position: absolute;
    bottom: 8px;
    left: 8px;
}

.bid-bar {
    display: flex;
}

.auction-title a {
    margin-right: 10px;
    font-weight: 700;
    font-size: 16px;
    line-height: 19px;
    color: #262626;
}

.auction-item .auction-subtitle {
    margin: 0;
    padding-right: 30px;
    font-size: 14px;
    line-height: 21px;
    word-break: break-word;
}

.auction-item .auction-loc, .auction-item .auction-time {
    margin: 0;
    color: #828282;
    font-size: 14px;
    line-height: 21px;
}

.subflow.account ul.comment-cards li.auction-item {
    margin-bottom: 40px;
    flex-direction: row;
}


li.auction-items {
    display: flex;
    margin-bottom: 20px;
}



.subflow.account ul.comment-cards li.auction-items .LazyLoad.is-visible {
    margin-bottom: 0;
    margin-right: 24px;
    width:30% !important;
    height: 143px !important;
}

.comment-cards .auction-items .metadata {
    width: 70%;
}

.subflow.account .section h2 {
    margin-bottom: 32px;
    font-size: 28px;
    line-height: 33px;
}

.subflow.account .section h2 span {
    padding-left: 8px;
    font-size: 16px;
    line-height: 33px;
}

</style>


@endsection
