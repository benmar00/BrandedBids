@extends('layouts.app')
@section('content')
    <section class="banner">
        <div class="container">
            <div class="row">
                <div class="inner-banner">
                    <h1 class="banner-title-head">Shop</h1>
                </div>
            </div>
    </section>
    <section class="product">
        <div class="container">
            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3 col-sm-6">
                        <div class="product-grid7">
                            <div class="product-image7">
                                <a href="#">
                                    <img class="pic-1" src="{{ asset($item->image) }}">
                                    <img class="pic-2"
                                        src="{{ asset(json_decode($item->images)[0] ? json_decode($item->images)[0] : $item->image) }}">
                                </a>
                                <ul class="social">
                                    <li><button type="button" class="btn cart-btn" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop" data-detail="{{ $item->toJson() }}">
                                            <i class="fa-solid fa-eye fa-bounce"></i>
                                        </button></li>
                                    <li><button type="button" class="btn" data-toggle="modal"
                                            data-target="#exampleModalCenter">
                                            <i class="fa-solid fa-cart-plus fa-bounce" ></i>
                                        </button></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <h3 class="title"><a href="#">{{ $item->name }}</a></h3>
                                <p class="price">${{ $item->price }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="product-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="" class="w-100" id="image" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="product-details">
                                <h4 id="product-title-inner"></h4>
                                <div id="product-desc"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).on("click", ".cart-btn", function() {
           let product = $(this).data('detail');
           console.log(product);
           $('#product-title').text(product['name'])
           $('#product-title-inner').text(product['name'])
           $('#product-desc').html(product['short_desc'])
           $('#image').attr('src', window.location.origin+'/'+product['image'])


        });
    </script>
@endpush
