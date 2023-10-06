@extends('admin.layouts.app')
@section('title', 'Add Flagged ')
@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Seller Q&A</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="mdi mdi-home-outline">Seller Q&A</i></a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row">
                @foreach ($qas as $key => $item)
                    <div class="col-lg-3 col-md-3">
                        <div class="box">
                            <div class="box-body">
                                <h4 class="box-title">{{ $item->content }}</h4>
                                @if ($item->answer)
                                    {!! $item->answer->content !!}
                                @else
                                    <p>No Answer</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    </div>

@endsection

@push('css')
    <style>
        .toggle.switch {
            float: right;
            border-radius: 23px;
        }

        span.toggle-handle.btn.btn-light.btn-sm {
            border-radius: 50%;
        }

        .toggle.btn.btn-sm.switch.btn-primary span {
            margin-right: 15px;
        }

        .toggle.btn.btn-sm.switch.btn-light.off span {
            margin-left: 15px;
        }
    </style>
@endpush
@push('js')
    <script src="{{ asset('admin/js/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/data-table.js') }}"></script>
@endpush
