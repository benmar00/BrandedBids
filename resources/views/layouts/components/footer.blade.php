<footer>
    {!! $helper->footerContent() !!}
</footer>
<section class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="bottom-footer">
                    <figure>
                        <img src="{{ asset($logo) }}" class="img-fluid" alt="">

                    </figure>
                </div>
            </div>
            <div class="col">
                <div class="bottom-footer">
                    <h6>HOW IT WORKS
                    </h6>
                    <ul>
                        @foreach (App\Models\FaqCategory::all() as $item)
                            @if (!$item->faqs->isEmpty())
                                <li>
                                    <a href="{{ route('whycars') }}#{{ str_replace(' ', '-', strtolower($item->name)) }}-faq">{{ $item->name }}</a>
                                </li>
                            @endif
                        @endforeach

                        <li>
                            <a href="{{ route('whycars') }}#buyer-questions-faq">FAQs</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="bottom-footer">
                    <h6>SELLERS
                    </h6>
                    <ul>
                        <li>
                            <a href="{{ route('sellacar') }}">Submit Your Car</a>
                        </li>
                        <li>
                            <a href="{{ route('photos') }}">Photography Guide</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="bottom-footer">
                    <h6>HELPFUL LINKS
                    </h6>
                    <ul>
                        <li>
                            <a href="{{ route('support') }}">Support</a>
                        </li>
                        <li>
                            <a href="{{ route('shipping') }}">Shipping</a>
                        </li>
                        <li>
                            <a href="{{ route('inspection') }}">Inspections</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="bottom-footer">
                    <div class="font-awesome">
                        <a href="{{ $helper->youtube() }}"><img src="{{ asset('front/images/4.png') }}" class="img-fluid" alt=""></a>
                        <a href="{{ $helper->instagram() }}"><img src="{{ asset('front/images/5.png') }}" class="img-fluid" alt=""></a>
                        <a href="{{ $helper->facebook() }}"><img src="{{ asset('front/images/6.png') }}" class="img-fluid" alt=""></a>
                        <a href="{{ $helper->tiktok() }}"><img src="{{ asset('front/images/7.png') }}" class="img-fluid" alt=""></a>
                        <a href="{{ $helper->twitter() }}"><img src="{{ asset('front/images/8.png') }}" class="img-fluid" alt=""></a>
                    </div>
                    <div class="last-para">
                        <p>{{ $helper->copyright() }}

                            <a href="terms-of-use.php" target="_blank">Terms of Use</a> <a href="privacy-policy.php" target="_blank">Privacy PolicyF</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if (Auth::check())
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



                            <fieldset class="form-group mb-3 exists"><label for="bid">Zip Code</label><input
                                    class="form-control" type="text" name="zip_code" id="zip_code"
                                    placeholder="Zip or Postal Code" value="{{ Auth::user()->zip_code }}" required>
                            </fieldset>


                            <button type="submit" class="btn btn-lg btn-bid mt-3">Register to bid</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endif
