@extends('layouts.app')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
@endpush
@section('content')

<section class="listings-sec">
    <div class="container">

        <div class="row">
            <div class="col-lg-3">
                @include('user.include.sidebar')
            </div>

            <div class="col-lg-9">
                @include($include)

            </div>
        </div>
    </div>
</section>

@endsection
@push('js')
@endpush
