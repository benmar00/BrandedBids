@extends('layouts.app')
@section('content')


<section class="support-page">
    <div class="container">
         <div class="row">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                   <div class="about-tabs-main" id="selling-a-car">
                        <div class="about-tabs">
                            {!! $page->findSection('support-content') !!}
                             <div class="d-flex">
                                  <div class="one-flx">
                                       <address>{{ env('APP_NAME') }}</address>
                                       <address>{{ $helper->companyAddress() }}</address>
                                  </div>
                                  <div class="one-flx">
                                       <img src="{{ asset('front/images/39.png') }}" class="img-fluid" alt="">
                                  </div>

                             </div>
                        </div>
                   </div>
              </div>
         </div>
    </div>
</section>



@endsection