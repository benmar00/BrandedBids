@extends('admin.layouts.app')
@section('title', 'Bid List')
@section('content')

<style>
.card-body {
    padding: 0.5rem 1.5rem;
}
</style>

<div class="container-full">
	<div class="content-header">
	    <div class="d-flex align-items-center">
	        <div class="mr-auto">
	            <h3 class="page-title">Bid List</h3>
	            <div class="d-inline-block align-items-center">
	                <nav>
	                    <ol class="breadcrumb">
	                        <li class="breadcrumb-item">
	                        	<a href="#"><i class="mdi mdi-home-outline">Bid Management</i></a>
	                        </li>
	                        <li class="breadcrumb-item active" aria-current="page">Bid List</li>
	                    </ol>
	                </nav>
	            </div>
	        </div>
	    </div>
	</div>
	<section class="content">

		<div class="row" id="section-content">
        <div class="table-responsive">
        <table id="example5" class="table table-bordered table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Vehicle</th>
            <th scope="col">Bid By</th>
            <th scope="col">Bid</th>
            <th scope="col">Time</th>
            <th scope="col">Date</th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 1;
        @endphp
        @foreach ($data as $item)
            <tr>
                <th scope="row">{{ $count }}</th>
                <td>{{ $item->vehicle->name }}</td>
                <td>{{ $item->user->name }}</td>
                <td><span class="badge badge-dark">${{ number_format($item->bid) }}</span></td>
                <td><span class="badge badge-primary">{{ Carbon::parse($item->created_at)->format('h:m A') }}</span></td>
                <td><span class="badge badge-success">{{ Carbon::parse($item->created_at)->format('d F Y') }}</span></td>
            </tr>
            @php    
                $count++;
            @endphp
        @endforeach
    </tbody>
</table>
        </div>

		</div>

	</section>
</div>
@endsection

@push('css')
<style>
       .error {
            margin: 0 auto;
        }

        ul.pagination {
            position: relative;
        }

        li.page-item {
            display: inline;
            text-align: center;
        }

        ul.pagination {
            /* background: #666; */
            /* display: inline-block; */
        }

        ul.pagination li {
            background: #fff;
            /* display: flex; */
            color: black !important;
        }

        ul.pagination span {
            background: transparent !important;
            color: #737373 !important;
        }

        ul.pagination {
            display: flex;
            justify-content: center;
        }

        li.page-item.active {
            background: #fd683e;
            border-color: coral !important;
        }

        .page-item.active .page-link {
            border-color: #fd683e;
            color: white !important;
        }
</style>
@endpush

@push('js')
    <script src="{{ asset('admin/js/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/data-table.js') }}"></script>
@endpush

@push('js')
    <script src="{{ asset('admin/js/search.js') }}"></script>
@endpush
