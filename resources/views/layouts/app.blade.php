<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" href="{{ asset($favicon) }}">

    <title>{{ config('app.name') }}</title>
    @include('layouts.components.css')
    @stack('css')
</head>

<body>

    @include('layouts.components.header')
    @yield('content')
    @include('layouts.components.footer')


    <div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <div class="modal-img">
                                <svg width="61" height="29" viewBox="0 0 61 29" class="carsandbids"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
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
                                </svg>
                            </div>
                            <div class="leftarea">
                                <h6>Get the Daily Email
                                </h6>
                                <p>Get the latest auctions and market info delivered right to your inbox, plus a heads
                                    up on exclusive content from Doug.</p>
                            </div>

                            <br>
                            <form class="contactform newsletter">
                                @csrf
                                <input type="hidden" name="type" value="newsletter">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Email address">
                                </div>

                                <button type="submit" class="btn btn-green">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- second modal  -->

    <div class="modal fade" id="signup-btn" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                            <div class="main-flx">
                                <div class="modal-img">
                                    <svg width="61" height="29" viewBox="0 0 61 29" class="carsandbids"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M27.3309 2.5H40.974C41.1857 2.5 41.3748 2.63219 41.4476 2.83098L44.4382 11H47.1005L43.7952 1.97153C43.3617 0.787413 42.2349 0 40.974 0H27.3309C25.9223 0 24.7028 0.978688 24.3978 2.35391L22.4805 11H25.0412L26.8385 2.89517C26.8897 2.6643 27.0945 2.5 27.3309 2.5Z"
                                            fill="#292929"></path>
                                        <path
                                            d="M25.7239 0H27.3921L25.0248 3.04476L24.248 3.08484C24.3754 2.18474 24.3581 1.92343 24.4847 1.2016C24.5541 0.805277 24.7031 0 25.7239 0Z"
                                            fill="#292929"></path>
                                        <path
                                            d="M57.1106 12.5H21.8894C21.6743 12.5 21.5 12.6743 21.5 12.8894V17.5L20 19.5L19 19.6667V12.8894C19 11.2936 20.2936 10 21.8894 10H57.1106C58.7064 10 60 11.2936 60 12.8894V19.6429L59 19.5L57.5 17.5V12.8894C57.5 12.6743 57.3257 12.5 57.1106 12.5Z"
                                            fill="#292929"></path>
                                        <path d="M48.5 23.5H30.5L29.5 25L29.4167 26H49V25L48.5 23.5Z" fill="#292929">
                                        </path>
                                        <rect x="46" y="14" width="4" height="1.5"
                                            rx="0.75" fill="#292929"></rect>
                                        <path
                                            d="M27.5647 10.0158C25.1505 10.0158 25.5529 8.60752 25.8211 7.4004L24.7481 7.19922L23.3398 10.6194H27.2148L27.5647 10.0158Z"
                                            fill="#292929"></path>
                                        <circle cx="54" cy="22" r="5.75" stroke="#292929"
                                            stroke-width="2.5"></circle>
                                        <circle cx="25" cy="22" r="5.75" stroke="#292929"
                                            stroke-width="2.5"></circle>
                                        <rect x="7" y="12" width="7" height="2"
                                            rx="1" fill="#292929"></rect>
                                        <rect y="16" width="12" height="2" rx="1"
                                            fill="#292929"></rect>
                                        <rect x="5" y="20" width="10" height="2"
                                            rx="1" fill="#292929"></rect>
                                    </svg>
                                </div>
                                <div class="leftarea">
                                    <h6>Sign up
                                    </h6>
                                    <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
                                </div>
                                <div class="google-btn">
                                    <a href="{{ url('auth/google') }}" class="btn btn-green google">Continue with Google</a>
                                    <a href="{{ url('redirect') }}" class="btn btn-green facebook">Continue with Facebook</a>
                                    <!--<a href="#" class="btn btn-green apple"> Continue with Apple</a>-->
                                </div>
                            </div>
                            {{-- <form action="submit" class="modal-sign-up goolge-form">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-green">Next</button>
                            </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('layouts.components.script')
    @stack('js')





</body>

</html>
