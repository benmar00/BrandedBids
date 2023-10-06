<div class="loading" style="display: none;" id="load">Loading&#8230;</div>
<form id="vechform1">

    <input type="hidden" name="data[car][party]" id="party" value="dealer">
    <input type="hidden" id="modifieeed" value="0">
    <input type="hidden" name="data[car][location]" id="location">
    <input type="hidden" name="data[car][flaw]" id="flaw" value="1">
    <div class="main-form second-form-page">
        <div class="my-listings">
            <h2>Tell us about your car</h2>
            <p>Please give us some basics about yourself and the car you’d like to sell. We’ll also need details about
                the
                car’s title status as well as 6 photos that highlight the car’s exterior and interior condition.
            </p>
            <p>We’ll respond to your application within a business day. Once accepted, we’ll ask for more details and at
                least 50 high-res photos, then work with you to build a custom and professional listing and get the
                auction
                live.</p>
            <p>Application Step 1 of 2</p>

        </div>

        <div class="first-main-form">
            <div class="first-form">

                <h3>Your Info</h3>
                <h6>Dealer or private party?</h6>

                <button class="btn d-inline-block toggleable dealer-btn active" data-inputid="party" data-value="dealer"
                    data-btnclass="dealer-btn" data-toggle="dealerdiv" data-togclass="togclass"
                    type="button">Dealer</button>
                <button class="btn  d-inline-block toggleable dealer-btn" data-btnclass="dealer-btn"
                    data-inputid="party" data-value="private" data-toggle="pivatediv" data-togclass="togclass"
                    type="button">Private</button>
                <div class="dealer-tabs dealer-info togclass" id="dealerdiv">
                    <div class="row">
                        <div class="form-group col-7">
                            <label for="exampleInputEmail1">Are there any additional fees the buyer will have to
                                pay?</label>
                            <input type="text" class="form-control" id="buyerwillpay"
                                name="data[dealer][buyerwillpay]" aria-describedby="emailHelp" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Dealership name</label>
                            <input type="text" class="form-control" name="data[dealer][name]" placeholder="">
                        </div>
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Dealership website</label>
                            <input type="text" name="data[car][website]" class="form-control"
                                id="exampleInputPassword1" placeholder="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="exampleInputPassword1">How many vehicles does your dealership retail each
                                month?</label>
                            <select name="data[dealer][retail_range]">
                                <option value="-1">Select sales range</option>
                                <option value="Less than 10">Less than 10</option>
                                <option value="10-50">10-50</option>
                                <option value="50-100">50-100</option>
                                <option value="More than 100">More than 100</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Full name</label>
                            <input class="form-control" name="data[dealer][fname]" type="text" />
                        </div>
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Contact phone number</label>
                            <input type="number" name="data[dealer][phone]" class="form-control"
                                id="exampleInputPassword1" placeholder="" >
                        </div>
                    </div>
                    <p>Please upload a photo of your dealer license.</p>
                    <p class="color-p">This information will be kept private and only used for verification. It will not
                        be shown in the auction listing.</p>
                    <div class="upload-img">
                        <input class="form-control" name="dealerliscence" type="file" id="formFile"
                            placeholder="Upload a dealer license photo" onchange="displayImage()">
                        <div id="uploadimages"></div>
                    </div>
                </div>
                <div class="dealer-tabs dealer-info togclass" id="pivatediv" style="display:none">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Full name</label>
                            <input class="form-control" name="data[dealer][name]" name="name"
                                id="exampleInputPassword1" placeholder="">
                        </div>
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Contact phone number</label>
                            <input type="number" name="data[dealer][phone]" class="form-control"
                                id="exampleInputPassword1" placeholder="">
                        </div>
                    </div>

                </div>

            </div>

        </div>
        <div class="first-main-form">
            <div class="first-form">
                <h3>Car Details</h3>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="exampleInputEmail1">VIN</label>
                        <div class="vinlookup-flex">
                            <input type="text" id="vinnumber" class="form-control w-75 inline-block"
                                name="data[car][vin]" id="exampleInputEmail1" aria-describedby="emailHelp"
                                placeholder="" required>
                            <button class="nav-link btn btn-green vinbtn" id="lookup" type="button"
                                disabled>LookUp</button>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-4">
                        <label for="exampleInputEmail1">Year</label>
                        <select id="id-year" class="form-control" name="data[car][year]" required>
                            <option value="null" hidden>Select Year</option>
                            @for ($year = 1981; $year < date('Y') + 1; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="exampleInputEmail1">Make</label>

                        <input type="text" name="data[car][make]" id="id-make" class="form-control" required>

                    </div>
                    <div class="form-group col-4">
                        <label for="exampleInputEmail1">Model</label>
                        <input type="text" class="form-control" name="data[car][model]" id="id-model"
                            aria-describedby="emailHelp" placeholder="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-7">
                        <label for="exampleInputEmail1">Transmission</label>
                        <select id="id-transmission" class="form-control" name="data[car][transmission_mode]" required>
                            <option value="-1" hidden>Select transmission type</option>
                            <option value="automatic">Automatic / Automated</option>
                            <option value="manual">Manual (stick shift with three pedals)</option>
                        </select>
                    </div>
                    <div class="form-group col-5">
                        <label for="exampleInputEmail1">Mileage (in miles)</label>
                        <input type="text" class="form-control" name="data[car][mileage]" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <label for="exampleFormControlTextarea1">Noteworthy options/features</label>
                        <textarea class="form-control" name="data[car][features]" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>

                <h6> Has the car been modified?</h6>
                <button class="btn d-inline-block toggleable modifed-btn active" data-btnclass="modifed-btn"
                    data-inputid="modifieeed" data-value="0" data-togclass="modclass" type="button">Completely
                    Stock</button>
                <button class="btn d-inline-block toggleable modifed-btn" data-inputid="modifieeed" data-value="0"
                    data-btnclass="modifed-btn" data-toggle="modification" data-togclass="modclass"
                    type="button">Modified</button>

                <div id="modification" class="modclass mt-2">
                    <label for="">List any modifications, including modification or removal of the catalytic
                        converters.</label>
                    <textarea name="data[car][modify]" id="modificationtextarea" class="form-control" cols="30" rows="10"></textarea>
                </div>


                <h6> Are there any significant mechanical or cosmetic flaws that we should know about?</h6>

                <button class="btn d-inline-block toggleable flaw-btn" data-btnclass="flaw-btn" data-inputid="flaw"
                    data-value="1" data-togclass="flawclass" data-toggle="flawdiv" type="button">Yes</button>
                <button class="btn d-inline-block toggleable flaw-btn active" data-btnclass="flaw-btn" data-inputid="flaw"
                    data-value="0" data-togclass="flawclass" type="button">No</button>
                <div class="row flawclass mt-2" id="flawdiv"style="display: none;">
                    <div class="form-group col-12">
                        <label for="exampleFormControlTextarea1">Please give details.</label>
                        <textarea class="form-control" name="data[car][flaw_content]" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                </div>

                <h6>Where is the car located?</h6>
                <button class="btn d-inline-block toggleable loc-btn active" data-btnclass="loc-btn" data-value="US"
                    data-inputid="location" data-value="US" data-toggle="us" data-togclass="locclass"
                    type="button">United States</button>
                <button class="btn d-inline-block toggleable loc-btn" data-btnclass="loc-btn" data-inputid="location"
                    data-value="CA" data-toggle="can" data-togclass="locclass" type="button">Canada</button>
                <div class="row locclass mt-2" id="us">
                    <div class="form-group col-6">
                        <label for="exampleInputEmail1">Zip code</label>
                        <input type="number" name="data[car][zip]" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="row locclass mt-2" id="can" style="display: none;">
                    <div class="form-group col-6 ">
                        <label for="exampleInputEmail1">City and Province</label>
                        <input type="text" name="data[car][city]" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="">
                    </div>
                </div>
                @if (1 == 2)
                    <h6> Is this car for sale elsewhere?</h6>
                    <button class="btn hide-btn" id="show-input"> Yes</button>
                    <p class="red-p">If we accept your car, all other listings will need to be taken down before it
                        can be
                        listed on our site.</p>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="exampleInputEmail1">Please link to all existing listings
                            </label>
                            <input type="text" name="" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="">
                        </div>
                    </div>

                    <button class="btn hide-btn" id="show-input"> No</button>
                @endif


            </div>


        </div>
        <button class="nav-link btn btn-green" type="submit">Get started</button>
    </div>
</form>

<form id="vechform2" style="display: none;">
    <input type="hidden" id="wheretitled" name="data[title][wheretitled]">
    <input type="hidden" id="reserve" name="data[reserve][status]">
    <input type="hidden" name="data[title][titlehand]" id="titlehand">
    <div class="main-form second-form-page">
        <div class="my-listings">
            <h2>Tell us about your car</h2>
            <p>Please give us some basics about yourself and the car you’d like to sell. We’ll also need details about
                the
                car’s title status as well as 6 photos that highlight the car’s exterior and interior condition.
            </p>
            <p>We’ll respond to your application within a business day. Once accepted, we’ll ask for more details and at
                least 50 high-res photos, then work with you to build a custom and professional listing and get the
                auction
                live.</p>
            <p>Application Step 2 of 2</p>

        </div>

        <div class="first-main-form">
            <div class="first-form">

                <h3>Title Info</h3>
                <h6>Where is the car titled?</h6>
                <span>Note: We require a US title or Canadian registration for the car to be considered.</span>
                <div>
                    <button class="btn d-inline-block toggleable modifed-btn active" data-toggle="statediv"
                        data-inputid="wheretitled" data-value="US" data-btnclass="modifed-btn"
                        data-togclass="modclass" type="button">United States</button>
                    <button class="btn d-inline-block toggleable modifed-btn" data-toggle="prodiv"
                        data-inputid="wheretitled" data-value="CA" data-btnclass="modifed-btn"
                        data-togclass="modclass" type="button">Canada</button>
                </div>


                <div class="dealer-tabs modclass" id="statediv">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputPassword1">State</label>
                            <select id="id-title_state" class="form-control" name="data[title][state]">
                                <option value="-1">Select state</option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="dealer-tabs modclass" id="prodiv">
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="exampleInputPassword1">Province</label>
                            <input type="text" class="form-control" type="text" name="data[title][province]"
                                id="exampleInputPassword1" placeholder="">
                        </div>
                    </div>
                </div>
                <h6>Do you have the title in hand?</h6>
                <button class="btn d-inline-block toggleable titlehand-btn active" data-btnclass="titlehand-btn"
                    data-inputid="titlehand" data-value="1" type="button">Yes</button>
                <button class="btn d-inline-block toggleable titlehand-btn" data-btnclass="titlehand-btn"
                    data-inputid="titlehand" data-value="0" type="button">No</button>
                <div class="dealer-tabs">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="exampleInputPassword1">What is the title’s status?</label>
                            <select id="id-title_status" class="form-control" name="data[title][title_status]">
                                <option value="-1">Choose</option>
                                <option value="clean">Clean</option>
                                <option value="salvage">Salvage</option>
                                <option value="rebuilt">Rebuilt</option>
                                <option value="not actual mileage">Not actual mileage</option>
                                <option value="manufacturer buyback">Manufacturer buyback</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="first-main-form">
            <div class="first-form dealer-tabs">
                <h3>Reserve Price</h3>
                <p class="color-p mb-0">The reserve price is a secret, minimum price required for your vehicle to sell.
                    Cars
                    with reserve prices may garner less interest than those without reserves.</p>
                <p class="color-p">Please note that bidding often brings the end result well above the reserve price.
                    For
                    more information, see Doug DeMuro's video explanation of reserves at <a
                        href="#">https://crsnbds.com/reserve</a></p>
                <h6> Do you want to set a minimum price required for your vehicle to sell?</h6>
                <button class="btn d-inline-block toggleable reserve-btn active" data-btnclass="reserve-btn"
                    data-inputid="reserve" data-value="1" type="button">Yes</button>
                <button class="btn d-inline-block toggleable reserve-btn" data-btnclass="reserve-btn"
                    data-inputid="reserve" data-value="0" type="button">No</button>
                <div class="row">
                    <div class="form-group col-7">
                        <label for="exampleFormControlTextarea1">What reserve price would you like (USD)?</label>

                        <input type="number" name="data[reserve][price]" class="form-control" placeholder="$">
                    </div>
                </div>
            </div>
        </div>
        <div class="first-main-form">
            <div class="first-form dealer-tabs">
                <h3>Photos</h3>
                <h6> Please upload at least 6 photos of the exterior and interior of the car.</h6>
                <div class="upload-img">
                    <input type="file" id="imageInput" accept="image/*" multiple>
                    <div id="imageDisplay"></div>

                </div>
            </div>
        </div>
        <div class="first-main-form">
            <div class="first-form dealer-tabs">
                <h3>Referral</h3>
                <h6> How did you hear about us? If a user referred you please leave their username.</h6>
                <div class="upload-img">
                    <input type="text" class="form-control" name="data[referal]" id="referal"
                        placeholder="">
                </div>
            </div>
        </div>
        <button class="nav-link btn btn-green" id="submitbtn" style="display: none" type="submit">Submit</button>
    </div>
</form>

@push('css')
    <style>
        /* Absolute Center Spinner */
        .loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        /* Transparent Overlay */
        .loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));

            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
        }

        /* :not(:required) hides these rules from IE9 and below */
        .loading:not(:required) {
            /* hide "loading..." text */
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background-color: transparent;
            border: 0;
        }

        .loading:not(:required):after {
            content: '';
            display: block;
            font-size: 10px;
            width: 1em;
            height: 1em;
            margin-top: -0.5em;
            -webkit-animation: spinner 150ms infinite linear;
            -moz-animation: spinner 150ms infinite linear;
            -ms-animation: spinner 150ms infinite linear;
            -o-animation: spinner 150ms infinite linear;
            animation: spinner 150ms infinite linear;
            border-radius: 0.5em;
            -webkit-box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
            box-shadow: rgba(255, 255, 255, 0.75) 1.5em 0 0 0, rgba(255, 255, 255, 0.75) 1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) 0 1.5em 0 0, rgba(255, 255, 255, 0.75) -1.1em 1.1em 0 0, rgba(255, 255, 255, 0.75) -1.5em 0 0 0, rgba(255, 255, 255, 0.75) -1.1em -1.1em 0 0, rgba(255, 255, 255, 0.75) 0 -1.5em 0 0, rgba(255, 255, 255, 0.75) 1.1em -1.1em 0 0;
        }

        /* Animation */

        @-webkit-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-moz-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-o-keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            0% {
                -webkit-transform: rotate(0deg);
                -moz-transform: rotate(0deg);
                -ms-transform: rotate(0deg);
                -o-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        div#uploadimages img {
            width: 150px;
        }

        div#uploadimages {
            margin-top: 12px;
        }
    </style>
@endpush

@push('js')
    <script>
        $('#vinnumber').keyup(function(e) {
            if ($('#vinnumber').val().length == 17) {
                $('#lookup').prop("disabled", false);
            } else {
                $('#lookup').prop("disabled", true);

            }
        })
        $('#lookup').click(function(e) {
            $('#load').slideDown();

            fetch(`https://auto.dev/api/vin/${$('#vinnumber').val()}`, {
                Method: 'POST',
                Headers: {
                    Accept: 'application.json',
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ZrQEPSkKaGFtZGFubWFqaWQ0NTZAZ21haWwuY29t'
                },
                Cache: 'default'
            }).then(response => response.json()).then(json => {

                if ("errorType" in json) {
                    $.toast({
                        heading: 'Sumbitted',
                        text: json.message,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                } else {
                    let year = json.years[0].year
                    let make = json.make.name
                    let model = json.model.name
                    let transmission = json.transmission.transmissionType == 'MANUAL' ? 'manual' :
                        'automatic';
                    $('#id-make').val(make)
                    $('#id-model').val(model)
                    console.log(transmission);
                    $('#id-year').find("option[value=" + year + "]").attr('selected', true)
                    $('#id-transmission').find("option[value=" + transmission + "]").attr('selected', true)

                }
                $('#load').slideUp();


            })


        })

        function displayImage() {
            const imageInput = document.getElementById("formFile");

            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('#uploadimages').html(`<img src=${e.target.result} class="thumbnail"/>`)
                };

                reader.readAsDataURL(imageInput.files[0]);
            }
        }

        let carphotos = [];
        var formData = {};
        var jsonData = {};
        var cardata = {},
            dealerdata = {},
            extradata = {}



        $('#vechform1').submit(function(e) {
            e.preventDefault();
            $('#vechform1 [name^="data[car]["]').each(function() {

                var name = $(this).attr('name');
                var value = $(this).val();
                var match = name.match(/\[car\]\[(.*?)\]/);

                // Check if the match was successful
                if (match && match.length === 2) {
                    var key = match[1];
                    cardata[key] = value;
                }

            });
            if($('#party').val() == 'dealer')
            {
                 $('#vechform1 #dealerdiv [name^="data[dealer]["]').each(function() {

                    var name = $(this).attr('name');
                    var value = $(this).val();
    
                    var match = name.match(/\[dealer\]\[(.*?)\]/);
    
                    // Check if the match was successful
                    if (match && match.length === 2) {
                        var key = match[1];
                        dealerdata[key] = value;
                    }
    
                });
            }
            else{
                $('#vechform1 #pivatediv [name^="data[dealer]["]').each(function() {

                    var name = $(this).attr('name');
                    var value = $(this).val();
    
                    var match = name.match(/\[dealer\]\[(.*?)\]/);
    
                    // Check if the match was successful
                    if (match && match.length === 2) {
                        var key = match[1];
                        dealerdata[key] = value;
                    }
    
                });
                
            }
           
            $('#vechform1 [name^="data[extra]["]').each(function() {

                var name = $(this).attr('name');
                var value = $(this).val();
                var match = name.match(/\[extra\]\[(.*?)\]/);
                if (match && match.length === 2) {
                    var key = match[1];
                    extradata[key] = value;
                }

            });
            const fileInput = document.getElementById("formFile");

            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const base64Image = e.target.result;
                    jsonData['lisenceimg'] = base64Image;

                };


                reader.readAsDataURL(file);
            } else if ($('#party').val() == 'dealer') {
                $.toast({
                    heading: 'Error',
                    text: "Lisence is required",
                    showHideTransition: 'slide',
                    icon: 'error'
                })
                return 0;
            }

            // Serialize the JSON object into a JSON string
            jsonData['car'] = cardata
            jsonData['dealer'] = dealerdata
            jsonData['extradata'] = extradata
            if(Object.keys(dealerdata).length === 0 && Object.keys(cardata).length === 0  )
            {
                 $.toast({
                    heading: 'Error',
                    text: "Some fields are not filed like dealer, car information",
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
            else{
                $('#vechform1').slideUp()
                $('#vechform2').slideDown()
            }
            
        })
     document.getElementById("imageInput").addEventListener("change", function (event) {
        $('#submitbtn').slideDown();

        for (let i = 0; i < this.files.length; i++) {
            const file = this.files[i];
            const img = document.createElement("img");
            const reader = new FileReader();
            reader.onload = function (e) {
                const base64String = e.target.result;

                const tempImg = new Image();
                tempImg.src = base64String;

                tempImg.onload = function () {
                    // Check image dimensions
                    if (tempImg.width > 1024 && tempImg.height > 768) {
                        carphotos.push(base64String);
                        img.src = base64String;
                        const closeButton = document.createElement("button");
                        closeButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" id="cross"><path d="M83.9 17.1c-.9-.9-2.5-.9-3.4 0l-30 30-30-30c-.9-.9-2.5-.9-3.4 0s-.9 2.5 0 3.4l30 30-30 30c-.9.9-.9 2.5 0 3.4.5.5 1.1.7 1.7.7.6 0 1.2-.2 1.7-.7l30-30 30 30c.5.5 1.1.7 1.7.7.6 0 1.2-.2 1.7-.7.9-.9.9-2.5 0-3.4l-30-30 30-30c.9-.9.9-2.4 0-3.4z"></path></svg>`;
                        closeButton.addEventListener("click", function () {
                            const indexToRemove = carphotos.indexOf(base64String);

                            if (indexToRemove !== -1) {
                                carphotos.splice(indexToRemove, 1);
                            }
                            divImg.remove();
                        });

                        const divImg = document.createElement('div');
                        divImg.classList.add("thumbnail");
                        divImg.appendChild(img);
                        divImg.appendChild(closeButton);
    
                        $('#imageDisplay').append(divImg);
                    } else {
                        // Image doesn't meet the criteria, show an error message
                        $.toast({
                            heading: 'Invalid Image',
                            text: "Please select an image with width < 1024px and height > 768px",
                            showHideTransition: 'slide',
                            icon: 'error'
                        });
                    }
                };
            };

            reader.readAsDataURL(file);
        }
    });



        $('#vechform2').submit(function(e) {
            e.preventDefault()
             if (carphotos.length < 6) {
                $('#submitbtn').slideUp();
                $.toast({
                    heading: 'Error',
                    text: "Please select at least 6 images",
                    showHideTransition: 'slide',
                    icon: 'error'
                });
            }
            else{
                $('#vechform2 [name^="data["]').each(function() {
                var name = $(this).attr('name');
                var value = $(this).val();

                var keys = name.split('[').map(function(key) {
                    return key.replace(']', '');
                });

                var obj = formData;
                for (var i = 0; i < keys.length - 1; i++) {
                    var key = keys[i];
                    obj[key] = obj[key] || {};
                    obj = obj[key];
                }
                obj[keys[keys.length - 1]] = value;
            });
            formData['images'] = carphotos
            if ($('#modifieeed').val() == '1') {
                jsonData['car']['modify'] = null;
            } else {
                jsonData['car']['modify'] = $('#modificationtextarea').val();

            }
            $('#load').slideDown();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('savecar') }}",
                type: "post",
                data: {
                    formData: formData,
                    jsonData: jsonData
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {

                        $.toast({
                            heading: 'Submitted',
                            text: response.message,
                            showHideTransition: 'slide',
                            icon: 'success'
                        })
                        window.location.href = response.url
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                    console.log(status);
                    console.log(xhr);
                    $('#load').slideUp();

                }
            })

            }


            
        })
    </script>
    <script src="{{ asset('front/js/form.js') }}"></script>
@endpush
