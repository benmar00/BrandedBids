<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<style>
.dt-buttons.btn-group.flex-wrap {
    display: contents;
}
.btn-secondary {
    color: #fff!important;
    background-color: #4d65d9!important;
    border-color: #0a28b9!important;
}

.toggle-on {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 30%;
    margin: 0;
    border: 0;
    border-radius: 0;
}

.toggle.btn {
    width: 100px !important;
    height: 40px !important;
}
</style>

<div class="main-form">
    <div class="my-listings">
        <h2>Settings</h2>
        <h6>Account</h6>
        <p>Linked accounts</p>
        <div class="email-form-sub">
            <div class="chosen-sso google1">
                @if (Auth::check())
                    <p class="account">{{ Auth::user()->email }}</p>
                @endif
                <!-- <p>whatever@example.com</p> -->
            </div>
            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#setting-one">Remove
                account</button>
        </div>
        <div class="email-form-sub">
            <p>Password <span class="d-block">••••••••••••</span></p>
            <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#setting-two">Set
                password</button>
        </div>
        <div class="top-b">
            <h6>Payment info for bidding</h6>
            <button class="nav-link btn btn-green" data-toggle="modal" data-target="#bidModal">Register to bid</button>
        </div>
        <div class="top-b">
            <h6>C&B Email</h6>
            <ul>
                <li>
                    <p>{{  $settings[0]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[1]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[0]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[1]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[1]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[1]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="top-b">
            <h6>General Notifications</h6>
            <ul>


                <li>
                <p>{{  $settings[2]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[2]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[2]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[3]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[3]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[3]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[4]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[4]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[4]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="top-b">
            <h6>Watch List Notifications</h6>
            <ul>
                <li>
                <p>{{  $settings[5]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[5]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[5]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[6]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[6]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[6]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[7]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[7]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[7]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[8]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[8]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[8]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[9]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[9]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[9]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li class="dark-p">
                <p>{{  $settings[10]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[10]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[10]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
            </ul>
        </div>
        <div class="top-b">
            <h6>Bidder Notifications</h6>
            <ul>

                <li>
                <p>{{  $settings[11]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[11]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[11]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[12]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[12]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[12]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>

            </ul>
        </div>
        <div class="top-b">
            <h6>Seller Notifications</h6>
            <ul>
                <li>
                <p>{{  $settings[13]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[13]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[13]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
                <li>
                <p>{{  $settings[14]->name }}</p>
                    <div class="toggle-btn ">
                    @php
                    $checking = DB::table('setting_check_user')->where('user_id', Auth::user()->id)->where('setting_check_id', $settings[14]->id)->first();
                    if($checking != null){
                        $status = $checking->status;
                    }else{
                        $status = 0;
                    }

                    @endphp

                    <input data-id="{{ Auth::user()->id }}" data-setting="{{ $settings[14]->id  }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="On" data-off="Off" {{ ($status == 1) ? 'checked' : '' }} />
                        <span class="round-btn"></span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="setting-one" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
                        <div class="leftarea setting-f">
                            <h6>Remove linked account?
                            </h6>
                            <div class="chosen-sso chosen-sso1 google1">
                                @if (Auth::check())
                                    <p class="account">{{ Auth::user()->email }}</p>
                                @endif
                                <!-- <p>whatever@example.com</p> -->
                            </div>
                            <p>Before removing this linked account, you need to set a password for your Cars & Bids
                                account.</p>
                        </div>

                            <button type="submit" class="btn btn-green" data-toggle="modal" data-target="#setting-two">Set password</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="setting-two" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <div class="justify-content-center">
                        <div class="modal-img">
                            <svg width="61" height="29" viewBox="0 0 61 29" class="carsandbids" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M27.3309 2.5H40.974C41.1857 2.5 41.3748 2.63219 41.4476 2.83098L44.4382 11H47.1005L43.7952 1.97153C43.3617 0.787413 42.2349 0 40.974 0H27.3309C25.9223 0 24.7028 0.978688 24.3978 2.35391L22.4805 11H25.0412L26.8385 2.89517C26.8897 2.6643 27.0945 2.5 27.3309 2.5Z" fill="#292929"></path>
                                <path d="M25.7239 0H27.3921L25.0248 3.04476L24.248 3.08484C24.3754 2.18474 24.3581 1.92343 24.4847 1.2016C24.5541 0.805277 24.7031 0 25.7239 0Z" fill="#292929"></path>
                                <path d="M57.1106 12.5H21.8894C21.6743 12.5 21.5 12.6743 21.5 12.8894V17.5L20 19.5L19 19.6667V12.8894C19 11.2936 20.2936 10 21.8894 10H57.1106C58.7064 10 60 11.2936 60 12.8894V19.6429L59 19.5L57.5 17.5V12.8894C57.5 12.6743 57.3257 12.5 57.1106 12.5Z" fill="#292929"></path>
                                <path d="M48.5 23.5H30.5L29.5 25L29.4167 26H49V25L48.5 23.5Z" fill="#292929"></path>
                                <rect x="46" y="14" width="4" height="1.5" rx="0.75" fill="#292929"></rect>
                                <path d="M27.5647 10.0158C25.1505 10.0158 25.5529 8.60752 25.8211 7.4004L24.7481 7.19922L23.3398 10.6194H27.2148L27.5647 10.0158Z" fill="#292929"></path>
                                <circle cx="54" cy="22" r="5.75" stroke="#292929" stroke-width="2.5"></circle>
                                <circle cx="25" cy="22" r="5.75" stroke="#292929" stroke-width="2.5"></circle>
                                <rect x="7" y="12" width="7" height="2" rx="1" fill="#292929"></rect>
                                <rect y="16" width="12" height="2" rx="1" fill="#292929"></rect>
                                <rect x="5" y="20" width="10" height="2" rx="1" fill="#292929"></rect>
                            </svg>
                        </div>
                        <div class="leftarea setting-f">
                            <h6>Set Password
                            </h6>
                        </div>
                        <form method="POST" action="{{ route('user.changePass') }}" class="modal-sign-up un-sign">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
                            <div class="form-group col-12">
                                <label>New Password</label>
                                <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Enter New Password">
                            </div>
                            <div class="form-group col-12 mt-2">
                                <label>Re-enter new Password</label>
                                <input type="password" class="form-control" id="cpassword" name="cpassword" aria-describedby="emailHelp" placeholder="Re-enter new Password">
                            </div>
                            <button type="submit" class="btn btn-green">Save password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');
        var setting_id = $(this).data('setting');

        $.ajax({
            type: "get",
            dataType: "json",
            url: '{{route("settingStatus")}}',
            data: {'status': status, 'user_id': user_id, 'setting_id': setting_id},
            success: function(data){
              console.log(data.success)
            }
        });
    });
  });


// jQuery document ready
        $(document).ready(function() {
            @if (Auth::check())

                $('.expiry').val('{{ Auth::user()->expiry_month }}/{{ Auth::user()->expiry_year }}')
                @if (Auth::user()->card_number != null)
                    // $('.exists').hide()
                @endif
            @endif
        });
    </script>
@endpush
