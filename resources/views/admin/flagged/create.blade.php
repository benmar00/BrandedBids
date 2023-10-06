@extends('admin.layouts.app')
@section('title', 'Add Flagged ')
@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Flags Comment</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="mdi mdi-home-outline">Flagged Comment</i></a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Flagged Details</h4>
                        </div>

                        <div class="table-responsive">
                            <table id="example5" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Comment</th>
                                        <th>Flagged By</th>

                                    </tr>
                                </thead>
                                <tbody>

                                        @foreach ($comments as $item)
                                            @foreach ($item->flags as $inner)
                                                <tr>
                                                    <td>{{ ucwords($inner->comment->user->name) }}</td>
                                                    <td>{{ $inner->comment->comment }}</td>
                                                    <td>{{ ucwords($inner->user->name) }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach



                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>User</th>
                                        <th>Comment</th>
                                        <th>Flagged By</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
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
