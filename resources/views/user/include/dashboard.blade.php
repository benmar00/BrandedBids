<div class="main-form profile-update">
    <div class="my-listings">
        <div class="main-profile-img">
            <div class="img-man">
                <div class="f-img">
                    <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('front/images/55.png') }}"
                        class="img-fluid" alt="">
                </div>
                <div class="f-img">
                    <h2>{{ Auth::user()->name }}</h2>
                    <p>Joined {{ Carbon::parse(Auth::user()->created_at)->format('F Y') }} </p>
                </div>
            </div>
            <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
                data-target="#profile-modal">Edit Profile</button>
        </div>
    </div>

    <div class="section">
        <h2>Comments <span>({{ count(Auth::user()->comment) }} Comments)</span>
        </h2>
        <ul class="comment-cards">
            @foreach (Auth::user()->comment as $item)
                <li class="auction-items ">
                    <div class="LazyLoad is-visible">
                        <a class="hero" title="{{ $item->vehicle->name }}"
                            href="/auctions/rkbAaXNR/2014-ford-mustang-gt1000-hellanor-by-armageddon">
                            <div class="ratio">
                                <div class="preload-wrap  loaded">
                                    <img src="{{ asset($item->vehicle->image) }}" alt="{{ $item->vehicle->name }}">
                                </div>
                            </div>

                        </a>
                    </div>
                    <div class="metadata">
                        <div class="auction-title">
                            <a title="{{ $item->vehicle->name }}"
                                href="{{ route('vehicleDetail', $item->vehicle->slug) }}">{{ $item->vehicle->name }}</a>
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
<div class="modal fade" id="profile-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="row justify-content-center">

                        <div class="leftarea setting-f">
                            <h6>Edit Profile
                            </h6>

                            <form method="POST" action="{{ route('editProfile') }}"
                                class="modal-sign-up register-to-bid" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                                <div class="main-profile-img">
                                    <div class="img-man">
                                        <div class="f-img">
                                            <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('front/images/55.png') }}"
                                                class="img-fluid" alt="">
                                        </div>
                                        <div class="f-img">
                                            <div class="upload-img">
                                                <input class="form-control" type="file" name="image" id="formFile"
                                                    placeholder="Upload a dealer license photo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Bio</label>
                                        <textarea class="form-control" name="bio" id="exampleFormControlTextarea1" rows="3"
                                            placeholder="Add a short bio. Where are you located? What kind of cars do you like? What do you own? What do you want other members to know about you?">{{ Auth::user()->bio }}</textarea>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-green">Save</button>
                            </form>
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

.user-heading .metadata h1 {
    margin-bottom: 8px;
    font-size:28px;
    font-weight: 700;
}

.section {
    padding-top: 32px;
}

.section {
    display: flex;
    flex-direction: column;
}

.section+.section {
    border-top: 1px solid #ebebeb;
}

.row.subbody {
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

ul.car-cards li.auction-item a.hero .preload-wrap {
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

ul.comment-cards li.auction-item {
    margin-bottom: 40px;
    flex-direction: row;
}


li.auction-items {
    display: flex;
    margin-bottom: 20px;
}



.LazyLoad.is-visible {
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

.section {
    padding: 50px 0px;
}

.section h2 {
    font-size: 22px;
    color: #6b7886;
    padding: 10px 0px;
}

</style>
