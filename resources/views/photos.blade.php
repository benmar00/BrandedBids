@extends('layouts.app')
@section('content')
<section class="waht-is">
    <div class="container-fluid">
         <div class="row">
              <div class="col-lg-3">

              </div>
              <div class="col-lg-6">
                   <div class="support">
                        <h1><span>Photography</span>
                        </h1>
                        <div class="img-main">
                             <figure>
                                  <img src="{{ asset($page->findSection('photography-image')) }}" class="img-fluid" alt="">
                             </figure>
                        </div>
                       {!! $page->findSection('photography-banner') !!}
                   </div>

              </div>
         </div>
    </div>
</section>
<section class="photos">
    <div class="container">
         <div class="row">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                   <div class="about-tabs-main" id="selling-a-car">
                        <div class="about-tabs">
                            {!! $page->findSection('taking-our-own-photos') !!}
                             <div class="img-main">
                                  <figure>
                                       <img src="images/181.jpg" class="img-fluid" alt="">
                                       <svg height="100%" version="1.1" viewBox="0 0 68 48" width="100%">
                                            <path class="ytp-large-play-button-bg" d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#f00"></path>
                                            <path d="M 45,24 27,14 27,34" fill="#fff"></path>
                                       </svg>
                                  </figure>
                             </div>
                             <h4>
                                  Walkaround Videos
                             </h4>
                             <p>We require a cold start video and recommend walk-around and driving clips to give bidders extra confidence!</p>
                             <p>Try to keep the video simple: we recommend using your phone, held horizontally in landscape-orientation! You can then simply upload the video to YouTube or Vimeo and send your auction specialist a link – we’ll take care of the rest!</p>
                        </div>
                   </div>
              </div>
         </div>
    </div>
</section>
@endsection
