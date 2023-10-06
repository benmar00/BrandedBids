<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('front/js/fancy.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
<script src="{{ asset('front/js/card-js.min.js') }}"></script>
<script src="{{ asset('admin/js/toastr.js') }}"></script>

<!-- inquiry send data -->
<script>
    setWishlist = (event, id) => {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: "{{ csrf_token() }}",
            url: "{{ route('add_to_wishlist') }}",
            type: "post",
            data: {
                vechile: id
            },
            dataType: "json",
            success: function(response) {
                if (response.status) {
                    $.toast({
                        heading: 'Wishlist',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                } else {
                    $.toast({
                        heading: 'Wishlist',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                }
            }
        })
        if ($(event).hasClass('fa-regular'))
            $(event).attr('class', 'fa-solid fa-star staricon')
        else if ($(event).hasClass('fa-solid'))
            $(event).attr('class', 'fa-regular fa-star staricon')


    }
    $('#footer-newsletter-btn').click(function() {
        if ($('#footer-newsletter').val().length > 0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('inquiry.submit') }}",
                type: "post",
                data: {
                    type: 'newsletter',
                    email: $('#footer-newsletter').val()
                },
                dataType: "json",
                success: function(response) {
                    $('#footer-newsletter').val('')
                    $.toast({
                        heading: 'Sumbitted',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                }
            })
        } else {
            $.toast({
                heading: 'Cannot Submit',
                text: "Email should not be empty",
                showHideTransition: 'slide',
                icon: 'error'
            })
        }
    })
    $('.contactform').submit(function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: "{{ csrf_token() }}",
            url: "{{ route('inquiry.submit') }}",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                $('.contactform')[0].reset();
                if (response.status) {
                    $.toast({
                        heading: 'Sumbitted',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'success'
                    })
                } else {
                    $.toast({
                        heading: 'Cannot Submit',
                        text: response.message,
                        showHideTransition: 'slide',
                        icon: 'error'
                    })
                }
            }
        });
    })
</script>


<script>
    @if (\Session::has('success'))
        $.toast({
            heading: 'Sumbitted',
            text: "{{ Session::get('success') }}",
            showHideTransition: 'slide',
            icon: 'success'
        })
    @endif
</script>
