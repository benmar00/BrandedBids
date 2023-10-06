@extends('layouts.app')
@section('content')
    <section class="listings-sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="link-listing">
                        <p><a href="{{ route('user.listings') }}">My listings</a> — {{ $item->name }}</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="side-bar form-submission-sec">
                        <ul class="sidebar-ul">
                            <li>
                                <a data-formid="app" class="active">1.Application</a>
                            </li>
                            <li>
                                <a data-formid="inspect" class="{{ $item->accept == 0 ? 'disabled' : '' }}">2.Inspection

                                </a>
                            </li>
                            <li>
                                <a data-formid="details" class="{{ $item->accept == 0 ? 'disabled' : '' }}">3.Details</a>
                            </li>
                            <li>
                                <a data-formid="condform" class="{{ $item->accept == 0 ? 'disabled' : '' }}">4.Condition</a>
                            </li>
                            <li>
                                <a data-formid="mediaform" class="{{ $item->accept == 0 ? 'disabled' : '' }}">5.Media

                                </a>
                            </li>
                            <li>
                                <a data-formid="schedule"
                                    class="{{ $item->accept == 0 ? 'disabled' : '' }}">6.Scheduling</a>
                            </li>
                            <li>
                                <a data-formid="review" class="{{ $item->accept == 0 ? 'disabled' : '' }}">7.Review</a>
                            </li>
                            <li>
                                <a data-formid="listing" class="{{ $item->accept == 0 ? 'disabled' : '' }}">8.Listing

                                </a>
                            </li>
                            <li>
                                <a data-formid="auction" class="{{ $item->accept == 0 ? 'disabled' : '' }}">9.Auction</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    @if ($item->accept == 1)
                        <div class="main-form second-form-page" id="app">
                            <div class="my-listings">
                                <h2>Your Application</h2>
                            </div>
                            <div class="first-main-form">
                                <div class="first-form application-form">
                                    <h3>Your Info</h3>
                                    <h6>Dealer or private party?</h6>
                                    <span>{{ ucwords($item->party) }} Party</span>
                                    @php
                                         $dealer = json_decode($item->dealer);
                                       
                                
                                    @endphp
                                    <h6>Full name</h6>

                                    <span>{{ $dealer->name }}</span>
                                    <h6>Contact phone number</h6>
                                    <span><a href="tel:{{ $dealer->phone }}">{{ $dealer->phone }}</a></span>
                                    <h3>Car Details</h3>
                                    <h6>VIN</h6>
                                    <span>{{ $item->vin }}</span>
                                    <h6>Year</h6>
                                    <span>{{ $item->year }}</span>
                                    <h6>Make</h6>
                                    <span>{{ $item->make->name }}</span>
                                    <h6>Model</h6>
                                    <span>{{ $item->model }}</span>
                                    <h6> Where is the car located?</h6>
                                    <span>{{ $item->zip }}, {{ $item->location }}</span>
                                    <h6>Is this car for sale elsewhere?</h6>
                                    <span>No</span>
                                    @php
                                        $title = json_decode($item->data)->title;
                                    @endphp
                                    <h3>Title Info</h3>

                                    <h6>Where is the car titled?</h6>
                                    @if ($title->wheretitled == 'US')
                                        <span>{{ $title->state }}, {{ $title->wheretitled }}</span>
                                    @else
                                        <span>{{ $title->province }}, {{ $title->wheretitled }}</span>
                                    @endif
                                    <h6>Is the vehicle titled in your name?</h6>
                                    <span>{{ $title->titlehand == '1' ? 'Yes' : 'No' }}</span>
                                    <h6>What is the title's status?</h6>
                                    <span>{{ ucwords($title->title_status) }}</span>
                                    <h3>Reserve Price</h3>

                                    <h6> Do you want to set a minimum price required for your vehicle to sell?
                                        @if($item->data)
                                            @if (json_decode($item->data)->reserve->status == 1)
                                                Yes - ${{ json_decode($item->data)->reserve->price }}
                                            @endif
                                        @else
                                            No
                                        @endif

                                    </h6>
                                    <h3>Referral</h3>
                                    <h6>How did you hear about us? If a user referred you please leave their</h6>
                                    <span>{{ ucwords($item->referal) }}</span>
                                </div>

                            </div> <button id="appbtn" class="nav-link btn btn-green steps-form-btn" data-id="inspection">Next</button>
                        </div>
                    @else
                        <div class="main-form second-form-page" id="app">
                            <div class="my-listings">
                                <h2>Thanks for your submission! <br>
                                    We’ll get back to you soon.</h2>
                                <p>We’ll review your {{ $item->name }} to see if it’s a match
                                    for Branded Bids. You can expect to hear from us within a business day, and we'll reach
                                    out if we have any questions.</p>
                                <p>Throughout this process, you can get in touch with us at any time by using the chat box
                                    on the bottom-right corner of this page. If we reach out with any questions, you’ll be
                                    alerted both on the site and via email so you don’t miss anything. In the unlikely event
                                    that you haven't heard from us in more than a few days, feel free to check back and send
                                    us a message.</p>
                            </div>
                        </div>
                    @endif
                    @if ($item->accept == 1)
                        <div class="main-form second-form-page" id="inspect" style="display: none">
                            <div class="my-listings">
                                <h2>Your car has been accepted!</h2>
                                <p>Congratulations, we've accepted your {{ $item->name }} with a reserve price of
                                    ${{ json_decode($item->data)->reserve->price }}
                                </p>
                            </div>
                            <form id="inspectform">
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3><img src="{{ asset('front/images/54.png') }}" class="img-fluid" alt="">
                                            <span>New</span> Book an
                                            inspection to get the most for your car.s
                                        </h3>
                                        <h6>A quick and easy inspection gives bidders information about your car's condition
                                            so
                                            they have the confidence to bid more. <a href="#">Learn more</a></h6>
                                        <div class="foem-group row col-7 mt-3 mb-4">
                                            <input type="text" value="{{ $item->inspection }}" id="inspectvalue" name="inspect" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Book an inspection - $199">
                                        </div>
                                    </div>
                                </div>
                                <button class="nav-link btn btn-green w-u" type="submit">Continue your
                                    submission</button>
                            </form>

                        </div>
                        <div class="main-form second-form-page" id="details" style="display: none">
                            <form id="detailform">
                                <input type="hidden" name="data[car][loan]" id="loan" value="0">

                                <div class="my-listings">
                                    <h2>Details</h2>
                                    <p>To prepare your auction listing, we need collect some additional information from
                                        you.
                                    </p>
                                </div>
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3>Car Info</h3>
                                        <div class="row">
                                            <div class="foem-group  col-6">
                                                <label>VIN</label>
                                                <input type="text" name="data[car][vin]" value="{{ $item->vin }}"
                                                    class="form-control">
                                            </div>
                                            <div class="foem-group  col-6 ">
                                                <label>Year</label>
                                                <input type="text" name="data[car][year]" class="form-control"
                                                    value="{{ $item->year }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group  col-6">
                                                <label>Make</label>
                                                @php
                                                    $make = App\Models\Make::all();
                                                @endphp
                                                <select id="id-year" class="form-control" name="data[car][make]">
                                                    <option value="null" hidden>Select Make</option>
                                                    @foreach ($make as $makes)
                                                        <option {{ $item->make_id == $makes->id ? 'selected' : '' }}
                                                            value="{{ $makes->id }}">{{ $makes->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="foem-group  col-6 ">
                                                <label>Model </label>
                                                <input type="text" name="data[car][model]" class="form-control"
                                                    value="{{ $item->model }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group  col-6 mt-3">
                                                <label>Current mileage (mi)</label>
                                                <input type="text" name="data[car][mileage]" class="form-control"
                                                    value="{{ $item->mileage }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group  col-7 mt-4">
                                                <label>What kind of transmission is in the car?</label>
                                                <select id="id-transmission" class="form-control"
                                                    name="data[car][transmission_mode]">
                                                    <option value="-1" hidden>Select transmission type</option>
                                                    <option {{ $item->transmission_mode == 'automatic' ? 'selected' : '' }}
                                                        value="automatic">Automatic / Automated</option>
                                                    <option {{ $item->transmission_mode == 'manual' ? 'selected' : '' }}
                                                        value="manual">Manual (stick shift with three pedals)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group  col-12 mt-4">
                                                <label>Noteworthy options/features</label>
                                                <textarea class="form-control" name="data[car][features]" id="exampleFormControlTextarea1" rows="3"
                                                    value="{{ $item->features }}" placeholder="2.5 inch lifted. nice new steel front bumper, 35 off road tires">{{ $item->features }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group  col-12 mt-4">
                                                <label>Additional options and equipment list</label>
                                                <textarea class="form-control" name="data[car][equipment]" value={{ $item->equipment }} rows="3"
                                                    placeholder="">{{ $item->equipment }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group  col-6">
                                                <label>Exterior Color</label>
                                                <input type="text" name="data[car][exterior_color]"
                                                    value="{{ $item->exterior_color }} "class="form-control">
                                            </div>
                                            <div class="foem-group  col-6 ">
                                                <label>Interior Color </label>
                                                <input type="text" name="data[car][interior_color]"
                                                    value="{{ $item->interior_color }} "class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group  col-6">
                                                <label>What engine is in the vehicle?</label>
                                                <input type="text" name="data[car][engine]"
                                                    value="{{ $item->engine }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="foem-group col-12 mt-4">
                                                <label>What is your ownership history? (How long owned, how many miles,
                                                    etc.)</label>
                                                <textarea class="form-control" name="data[car][history]" value="{{ $item->history }}">{{ $item->history }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3>Additional Title Info</h3>
                                        <h6>Is there a loan on the vehicle?</h6>
                                        <button class="btn d-inline-block toggleable modifed-btn "
                                            data-btnclass="modifed-btn" data-inputid="modified" data-value="0"
                                            data-togclass="modclass" type="button">Yes</button>
                                        <button class="btn d-inline-block toggleable modifed-btn active"
                                            data-btnclass="modifed-btn" data-inputid="modified" data-value="1"
                                            data-togclass="modclass" type="button">No</button>
                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <button class="nav-link btn btn-green w-u" data-formid="" type="submit">Save and
                                        Continue</button>
                                    <button class="nav-link btn btn-green" type="button">Back</button>
                                </div>
                            </form>

                        </div>
                        <div class="main-form second-form-page" id="condform" style="display: none">
                            <div class="my-listings">
                                <h2>Condition</h2>
                            </div>
                            <form id="conform">
                                <input type="hidden" id="paint" name="data[condition][paint]" value="{{ json_decode($item->conditions) ? ((json_decode($item->conditions)->paint == '1') ?  '1' : '0') : '0'}}">
                                <input type="hidden" id="dents" name="data[condition][dents]" value="{{ json_decode($item->conditions) ? ((json_decode($item->conditions)->dents == '1') ?  '1' : '0') : '0'}}">
                                <input type="hidden" id="rust" name="data[condition][rust]" value="{{ json_decode($item->conditions) ? ((json_decode($item->conditions)->rust == '1') ?  '1' : '0') : '0'}}">

                                <input type="hidden" id="issuebool">

                                <input type="hidden" id="modifieeed">
                                <input type="hidden" id="flawbool">
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3> Service History</h3>
                                        <div class="row">
                                            <div class="form-group  col-12">
                                                <label>How extensive are the service records?</label>
                                                <textarea class="form-control servicetextarea" value="{{ $item->serv_history ? json_decode($item->serv_history)->extensiveservice : ''}}" id="extensiveservice" rows="3">{{ $item->serv_history ? json_decode($item->serv_history)->extensiveservice : '' }}</textarea>
                                            </div>
                                            <div class="form-group  col-12">
                                                <label>When was the vehicle recently serviced and what was done? Please
                                                    include details. from the past few services if applicable.</label>
                                                <textarea class="form-control servicetextarea" id="whyservce" value="{{ $item->serv_history ? json_decode($item->serv_history)->whyservce : '' }}" rows="3">{{$item->serv_history ? json_decode($item->serv_history)->extensiveservice : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3>Vehicle Condition</h3>
                                        <h6>Has the car been modified?</h6>
                                        <div class="foem-group  col-12">
                                            <button data-inputid="modifieeed" data-value="0"
                                                class="btn d-inline-block toggleable modifed-btn {{ $item->modify == null ? 'active' : '' }}"
                                                data-btnclass="modifed-btn" data-togclass="togclass"
                                                type="button">Completely stock</button>
                                            <button data-inputid="modifieeed" data-value="1"
                                                class="btn d-inline-block toggleable modifed-btn {{ $item->modify != null ? 'active' : '' }} "
                                                data-btnclass="modifed-btn" data-togclass="togclass"
                                                data-toggle="modifiedtextarea" type="button">Modified</button>
                                            <div class="togclass" id="modifiedtextarea">

                                                <label>List any modifications, including modification or removal of the
                                                    catalytic converters.</label>
                                                <textarea class="form-control" rows="3" id="modificationtextarea" value="{{ $item->modify }}"
                                                    placeholder="2.5 inch lifted. nice new steel front bumper, 35 off road tires">{!! $item->modify !!}</textarea>

                                            </div>

                                        </div>
                                        <div class="foem-group  col-12">
                                            <h6>Are there any significant mechanical or cosmetic flaws that we should know
                                                about?</h6>
                                            <button
                                                class="btn d-inline-block toggleable flaw-btn {{ $item->flaws == 0 ? 'active' : '' }}"
                                                data-btnclass="flaw-btn" data-togclass="flaw-div" data-inputid="flawbool"
                                                data-value="0" type="button">No</button>
                                            <button
                                                class="btn d-inline-block toggleable flaw-btn {{ $item->flaws == 1 ? 'active' : '' }} "
                                                data-btnclass="flaw-btn" data-togclass="flaw-div" data-inputid="flawbool"
                                                data-value="1" data-toggle="flawtextdiv" type="button">Yes</button>
                                        </div>
                                        <div class="foem-group col-12 flaw-div" id="flawtextdiv"
                                            style="{{ $item->flaws == 0 ? 'display: none' : '' }}">
                                            <label>Please give details.</label>
                                            <textarea class="form-control" id="flawtextarea" rows="3" value="{{ $item->flaw_content }}"
                                                placeholder="front passenger leather is coming off, bump">{{ $item->flaw_content }}</textarea>
                                        </div>
                                        <div class="foem-group col-12">
                                            <h6>Has the vehicle had any paint or body work done?</h6>
                                            <button class="btn d-inline-block toggleable paint-btn {{ $item->conditions ? (json_decode($item->conditions)->paint == 0 ?'active' : '') : 'active' }}"
                                                data-btnclass="paint-btn" data-inputid="paint" type="button"
                                                data-value="0">No</button>
                                            <button class="btn d-inline-block toggleable paint-btn {{ $item->conditions ? (json_decode($item->conditions)->paint == 1 ?'active' : '') : '' }}" type="button"
                                                data-btnclass="paint-btn" data-inputid="paint"
                                                data-value="1">Yes</button>
                                        </div>
                                        <div class="foem-group  col-12">
                                            <h6>Are there any dents, dings, or scratches?</h6>
                                            <button class="btn d-inline-block toggleable dents-btn {{ $item->conditions ? (json_decode($item->conditions)->dents == 0 ?'active' : '') :'active' }}"
                                                data-btnclass="dents-btn" data-inputid="dents" type="button"
                                                data-value="0">No</button>
                                            <button class="btn d-inline-block toggleable dents-btn {{ $item->conditions ? (json_decode($item->conditions)->dents == 1 ?'active' : '') : '' }}" type="button"
                                                data-btnclass="dents-btn" data-inputid="dents"
                                                data-value="1">Yes</button>
                                        </div>
                                        <div class="foem-group  col-12">
                                            <h6>Is there any rust on the vehicle?</h6>

                                            <button class="btn d-inline-block toggleable rust-btn {{ $item->conditions ? (json_decode($item->conditions)->rust == 0 ?'active' : '') : 'active' }}"
                                                data-btnclass="rust-btn" data-inputid="rust" type="button"
                                                data-value="0">No</button>
                                            <button class="btn d-inline-block toggleable rust-btn {{ $item->conditions ? (json_decode($item->conditions)->rust == 1 ?'active' : '') : '' }}" type="button"
                                                data-btnclass="rust-btn" data-inputid="rust" data-value="1">Yes</button>
                                        </div>
                                        <div class="foem-group  col-12">
                                            <h6>Any additional issues or problems?</h6>

                                            <button class="btn d-inline-block toggleable issue-btn {{ $item->issues ? 'active' : '' }}" type="button"
                                                data-toggle="issuestextarea" data-togclass="issueclasstext"
                                                data-btnclass="issue-btn" data-inputid="issuebool"
                                                data-value="1">Yes</button>

                                            <button class="btn d-inline-block toggleable issue-btn {{ $item->issues ? '' : 'active' }}" type="button"
                                                data-togclass="issueclasstext" data-btnclass="issue-btn"
                                                data-inputid="issuebool" data-value="0">No</button>

                                        </div>
                                        <div id="issuestextarea" class="issueclasstext" style="display:{{ $item->issues ? 'block' : 'none' }}">
                                            <div class="foem-group  col-12">
                                                <label>What's included with the car? (How many keys, owner's manuals, the
                                                    window
                                                    sticker, spare parts, extra wheels/tires, etc.)</label>
                                                 
                                                <textarea class="form-control istext" id="issuesone" rows="3" value="{{ $item->issues ? json_decode($item->issues)->issueone : '' }}" placeholder="">{{ $item->issues ? json_decode($item->issues)->issueone : '' }}</textarea>
                                            </div>
                                            <div class="foem-group  col-12">
                                                <label>Anything else we should know?</label>
                                                <textarea class="form-control istext" id="issuestwo" value="{{  $item->issues ? json_decode($item->issues)->issuetwo : ''}}" rows="3" placeholder="">{{ $item->issues ? json_decode($item->issues)->issuetwo : '' }}</textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <button class="nav-link btn btn-green " type="button">Back</button>
                                    <button class="nav-link btn btn-green" type="submit">Submit</button>
                                </div>
                            </form>


                        </div>
                        <div class="main-form second-form-page" id="mediaform" style="display: none">
                            <form id="mediafom">
                                <div class="my-listings">
                                    <h2>Media</h2>
                                    <h3>Want help taking excellent photos?</h3>
                                    <p>
                                        <a href="#">Visit our photography page</a> to get tips and tricks, download
                                        our detailed photo guide, or even hire a professional photographer to come shoot
                                        your car.
                                    </p>
                                </div>
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3>Photos and Documents</h3>
                                        <p>Please follow our <a href="#"> photo guide</a> and upload at least 50
                                            clear, high-quality photos of your car. Good photos are very important to ensure
                                            you get top dollar for your car.</p>
                                        <p>All photos should be taken landscape orientation, ideally with a 3:2 aspect
                                            ratio, and a minimum resolution of 2400x1600 pixels. You should include photos
                                            of the car's exterior, interior, mechanicals, and service records or other
                                            associated paperwork.</p>
                                        <div class="row">
                                            <div class="foem-group  col-12">
                                                <div class="upload-img">
                                                    <input class="form-control" type="file" id="mediafile" multiple
                                                        placeholder="Upload a dealer license photo">
                                                </div>
                                                <div id="imageDisplay"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3>Videos</h3>
                                        <h6>Has the car been modified?</h6>
                                        <div class="foem-group  col-12">
                                            <label>We require a cold start video and recommend walk-around and driving
                                                clips. Please
                                                upload them to YouTube or Vimeo and add the links below.
                                            </label>
                                            <div id="videosrepeater">
                                                <input type="text" class="form-control video"
                                                    placeholder="https://www.youtube.com/">
                                            </div>
                                            <button type="button" id="addvideorepater">+ Add more</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <button type="button" class="nav-link btn btn-green ">Back</button>
                                    <button type="submit" class="nav-link btn btn-green w-u">Save and continue</button>
                                </div>
                            </form>
                        </div>
                        <div class="main-form second-form-page" id="schedule" style="display: none">
                            <div class="my-listings">
                                <h2>Scheduling</h2>
                            </div>
                            <form id="schdulefrm">
                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3>Auction Start Date</h3>
                                        <p>We schedule auctions to launch and end Monday through Friday, between 10am and
                                            1pm
                                            Pacific Time. We always strive to schedule your auction to launch as soon
                                            as possible, while considering your scheduling preferences and any similar
                                            vehicles
                                            already live or on the schedule.
                                        </p>
                                        <div class="row">
                                            <div class="foem-group  col-12">
                                                <label for="exampleFormControlTextarea1">With that said, do you have any
                                                    scheduling preferences for your auction?</label>
                                                <textarea class="form-control" id="schduletextarea" value="{{ $item->schedule }}" rows="3">{{ $item->schedule }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <button class="nav-link btn btn-green">Back</button>
                                    <button class="nav-link btn btn-green w-u">Save and continue</button>
                                </div>
                            </form>
                        </div>
                        <div class="main-form second-form-page" id="review" style="display: none;">
                            <div class="my-listings">
                                <h2>Review</h2>
                            </div>
                            <form id="reviewform">

                                <div class="first-main-form">
                                    <div class="first-form application-form">
                                        <h3>Complete Submission</h3>
                                        <p>Once you submit, our auction team will get to work reviewing the photos and
                                            information you've provided and will reach out with any additional questions. If
                                            you'd like to make any changes to the information you've provided, please use
                                            the
                                            "Back" button to do so now.
                                        </p>
                                        <p>As a reminder, your car must not be available for sale elsewhere. By moving
                                            forward,
                                            you are committing to auctioning your car on Cars & Bids with a reserve of
                                            $22,000.
                                        </p>
                                        <input type="checkbox" id="vehicle1" name="vehicle1" value="1">
                                        <label for="vehicle1"> I accept the Terms of Use and Privacy Policy.</label><br>
                                        <input type="checkbox" id="vehicle2" name="vehicle2" value="1">
                                        <label for="vehicle2"> I agree that if the highest bid for my car is below the
                                            reserve, Cars & Bids may choose to pay me the difference between the highest bid
                                            and the reserve price, and mark the car as sold below the reserve price. In this
                                            case, I will complete and sign any required tax documents (if applicable); once
                                            the vehicle transaction is complete, Cars & Bids will then pay me the difference
                                            between the highest bid and the reserve price.</label>
                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <button type="button" class="nav-link btn btn-green ">Back</button>
                                    <button type="submit" class="nav-link btn btn-green w-u">Submit</button>

                                </div>
                            </form>
                            <p class="mt-3">We expect and appreciate quick responses to any requests for additional
                                information regarding your listing. This allows us to get your listing ready and auction
                                live as soon as possible.</p>
                        </div>
                        <div class="main-form second-form-page" id="listing" style="display: none;">
                            <div class="my-listings">
                                <h2>Thank you for completing your <span class="d-block">submission!</span></h2>
                                <p>Our auction team will start by reviewing all of the photos and information you provided
                                    us, and will reach out with any questions or requests. Once we have all of the
                                    information, photos, and videos needed to best showcase your special car, you'll be
                                    assigned a dedicated Auction Specialist who will prepare your custom auction listing.
                                </p>
                                <p>
                                    Your Auction Specialist will reach out with any additional questions, and you can expect
                                    a final draft for your approval usually within a week. Once you approve the draft, we'll
                                    schedule your auction!</p>
                                <ul>
                                    <li>
                                        <p>Use the <a href="#">Upload additional photos</a> button to add photos to
                                            your listing. Have questions about how to take the best photos? You can check
                                            out our photo guide and how-to video for guidance or reach out to us via chat!
                                        </p>
                                    </li>
                                    <li>
                                        <p>If you have PDF documents to upload, such as window stickers or maintenance
                                            records, please email them to us at <a
                                                href="mailto:specialists@carsandbids.com.">specialists@carsandbids.com.</a>
                                        </p>
                                    </li>
                                    <li>
                                        <p> Please verify that any other ads for your vehicle have been removed.</p>
                                    </li>
                                    <li>
                                        <p>
                                            If you haven't already done so, record interior and exterior walkaround videos
                                            and just send us the YouTube or Vimeo links via our built-in chat!
                                        </p>
                                    </li>
                                </ul>
                                <p>As a reminder, our auctions start and end Monday through Friday, generally between 10am
                                    and 1pm Pacific Time. We always strive to schedule your auction for the earliest and
                                    best possible launch date, while considering your scheduling preferences and any similar
                                    vehicles already live or on the calendar.</p>
                                <p>Please let us know if you have any questions, we'll be in touch soon!</p>
                                <form id="listmediaform">

                                    <div class="first-main-form">
                                        <div class="first-form application-form">
                                            <h3>Additional photos</h3>
                                            <div class="row">
                                                <div class="foem-group  col-12">
                                                    <div class="upload-img">
                                                        <input class="form-control" type="file" name="listmediainput"
                                                            id="listmediainput" multiple
                                                            placeholder="Upload a dealer license photo">
                                                    </div>
                                                    <div id="imageDisplayMedia"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mt-2">
                                        <button type="submit" class="nav-link btn btn-green ">Done</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                </div>

            </div>
        </div>
        @endif
        </div>
        </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        div#imageDisplay img {
            width: 100%;
        }

        button#addvideorepater {
            background: transparent;
            border: none;
            color: blue;
            font-style: italic;
            font-size: 13px;
        }

        ul.sidebar-ul a.disabled {
            pointer-events: none;
            color: #ccc;
        }
    </style>
@endpush

@push('js')
    <script>
        function toggleSidebar(formid){
            $('.sidebar-ul a').removeClass('active')
            $('.sidebar-ul a[data-formid="'+formid+'"]').first().addClass('active');
        }
        $('#appbtn').click(function(e){
            $('.second-form-page').slideUp();
            toggleSidebar('inspect')
            $('#inspect').slideDown()
        })
        $('#inspectform').submit(function(e){
            e.preventDefault()
            let inspect = {
                slug: '{{ $item->slug }}',
                value: $('#inspectvalue').val().length > 0 ? $('#inspectvalue').val() : 0
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('car.submission.update.inspect') }}",
                type: "post",
                data: inspect,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Updated',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        $('.second-form-page').slideUp();
                        toggleSidebar('details')
                        $('#details').slideDown()
                    }

                },
                error: function(xhr, status, error) {

                }
            })
        })
        $('#reviewform').submit(function(e) {
            e.preventDefault()
            let review = {
                slug: '{{ $item->slug }}',
                privacy: $('#vehicle1').is(':checked') ? 1 : 0,
                reserve: $('#vehicle2').is(':checked') ? 1 : 0

            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('car.submission.update.stepeight') }}",
                type: "post",
                data: review,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Updated',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        $('.second-form-page').slideUp();
                        toggleSidebar('listing');
                        $('#listing').slideDown();
                    }

                },
                error: function(xhr, status, error) {

                }
            })

        })
        $('#schdulefrm').submit(function(e) {
            e.preventDefault();
            let schtext = {
                slug: '{{ $item->slug }}',
            }
            if ($('#schduletextarea').val().length > 0) {
                schtext['value'] = $('#schduletextarea').val()
            } else {
                schtext['value'] = null

            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('car.submission.update.stepseven') }}",
                type: "post",
                data: schtext,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Updated',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        $('.second-form-page').slideUp();
                        toggleSidebar('review');
                        $('#review').slideDown();
                    }

                },
                error: function(xhr, status, error) {

                }
            })

        })
        let listmediafiles = []

        $('#listmediaform').submit(function(e) {
            e.preventDefault()
            let mediaform = {
                slug: '{{ $item->slug }}',
                images: listmediafiles
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('car.submission.update.stepsix') }}",
                type: "post",
                data: mediaform,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Updated',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        window.location.href = response.url


                    }
                    
                },
                error: function(xhr, status, error) {

                    $('#load').slideUp();

                }
            })
        })
        document.getElementById("listmediainput").addEventListener("change", function(event) {
            $('#imageDisplayMedia').html('')
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];

                const reader = new FileReader();
                reader.onload = function(e) {
                    const base64String = e.target.result;
                    listmediafiles.push(base64String)
                };

                reader.readAsDataURL(file);


                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);

                const divImg = document.createElement('div')
                divImg.appendChild(img)

                $('#imageDisplayMedia').append(divImg);
            }
        })
        let mediafiles = []
        document.getElementById("mediafile").addEventListener("change", function(event) {
            mediafiles = []
            $('#submitbtn').slideDown();
            $('#imageDisplay').html('')
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];

                const reader = new FileReader();
                reader.onload = function(e) {
                    const base64String = e.target.result;
                    mediafiles.push(base64String)
                };

                reader.readAsDataURL(file);


                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);

                const divImg = document.createElement('div')
                divImg.appendChild(img)

                $('#imageDisplay').append(divImg);
            }

        });
        $('#mediafom').submit(function(e) {
            e.preventDefault()
            let mediadata = {
                slug: '{{ $item->slug }}'
            }
            let videos = []
            $('.video').each(function(e) {
                if ($(this).val().length > 0) {
                    videos.push($(this).val())
                }
            })
            mediadata['videos'] = videos
            mediadata['images'] = mediafiles
            console.log(mediadata)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('car.submission.update.stepfive') }}",
                type: "post",
                data: mediadata,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Updated',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        $('.second-form-page').slideUp();
                        toggleSidebar('schedule');
                        $('#schedule').slideDown();


                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    console.log(status);
                    console.log(xhr);
                    $('#load').slideUp();

                }
            })


        })
        $('#addvideorepater').click(function() {
            let video = $('.video').first().clone()
            $('#videosrepeater').append(video)
        })
        $('#conform').submit(function(e) {
            e.preventDefault()
            cardata = {
                slug: "{{ $item->slug }}",
                serv_history:{
                    extensiveservice:$('#extensiveservice').val(),
                    whyservce:$('#whyservce').val()
                }
            };
            $('#conform [name^="data[car]["]').each(function() {
                var name = $(this).attr('name');
                var value = $(this).val();
                var match = name.match(/\[car\]\[(.*?)\]/);

                // Check if the match was successful
                if (match && match.length === 2) {
                    var key = match[1];
                    cardata[key] = value;
                }

            });
            let condition = {};
            $('#conform [name^="data[condition]["]').each(function() {
                var name = $(this).attr('name');
                var value = $(this).val();
                var match = name.match(/\[condition\]\[(.*?)\]/);

                // Check if the match was successful
                if (match && match.length === 2) {
                    var key = match[1];
                    condition[key] = value;
                }

            });
            if ($('#modifieeed').val() == '1') {
                cardata['modify'] = $('#modificationtextarea').val();

            } else {
                cardata['modify'] = null;

            }
            if ($('#flawbool').val() == '1') {
                cardata['flaws'] = 1
                cardata['flawextra'] = $('#flawtextarea').val();

            } else {
                cardata['flaws'] = 0
                cardata['flawextra'] = null
            }
            if ($('#issuebool').val() == '1') {
                cardata['issues'] = {
                    issueone: $('#issuesone').val(),
                    issuetwo: $('#issuestwo').val()
                }
            } else {
                cardata['issues'] = null;

            }
            cardata['condition'] = condition;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('car.submission.update.stepfour') }}",
                type: "post",
                data: cardata,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Updated',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        $('.second-form-page').slideUp();
                        $('#mediaform').slideDown();
                    }
                }
            })


            console.log(cardata)
        })
    </script>
    <script src="{{ asset('front/js/form.js') }}"></script>
    <script>

        $('#detailform').submit(function(e) {
            e.preventDefault()

            let cardata = {
                slug: '{{ $item->slug }}'
            }
            $('#detailform [name^="data[car]["]').each(function() {

                var name = $(this).attr('name');
                var value = $(this).val();
                var match = name.match(/\[car\]\[(.*?)\]/);
                if (match && match.length === 2) {
                    var key = match[1];
                    cardata[key] = value;
                }

            });
            console.log(cardata);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('car.submission.update') }}",
                type: "post",
                data: cardata,
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $.toast({
                            heading: 'Updated',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        $('.second-form-page').slideUp();
                        $('#condform').slideDown();

                    }
                }
            })
        })

        $('.sidebar-ul a').click(function() {
            $('.sidebar-ul a').removeClass('active')
            $('.second-form-page').slideUp();
            $('#' + $(this).data('formid')).slideDown();
            $(this).addClass('active')

        })
    </script>
@endpush
