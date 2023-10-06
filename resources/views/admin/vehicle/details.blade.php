@extends('admin.layouts.app')
@section('title', 'Add Vehicle ')
@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Form Details
                        {{ $item == null ? '' : '#' . $item->id }}</h3>

                </div>
            </div>
        </div>
        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Seller Application</h4>

                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">
                                <table class="table mb-0">

                                    <tbody>
                                        <tr>
                                            <th>Dealer or private party? 
                                                <span>{{ $item->party ? ucwords($item->party).' Party' :'None' }} </span>
                                            </th>
                                            @php
                                                $dealer = json_decode($item->dealer);
                                            @endphp

                                            <th>Full name
                                                <span>{{ $dealer ? $dealer->name : 'None'}}</span>
                                            </th>

                                            <th>Contact phone number 
                                            <span><a
                                                        href="tel:{{  $dealer ? $dealer->phone : 'None' }}">{{ $dealer ? $dealer->phone : 'None' }}</a></span>
                                       
                                            </th>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-header with-border-top">
                            <h4 class="box-title">Car Details</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">
                                <table class="table mb-0">

                                    <tbody>
                                        <tr>
                                            <th>VIN <span>{{ $item->vin ? $item->vin : 'None'  }}</span></th>
                                            <th>Year<span>{{ $item->year ? $item->year : 'None' }}</span></th>
                                            <th>Make<span>{{ $item->make->name ? $item->make->name : 'None' }}</span></th>
                                            <th>Model<span>{{ $item->model ?  $item->model : 'None' }}</span></th>


                                        </tr>
                                        @php
                                        if($item->data)
                                        {
                                            $title = json_decode($item->data)->title;
                                        }
                                        
                                            
                                        @endphp
                                        <tr>
                                            <th>Where is the car located?
                                         
                                                <span> {{ $item->zip  ? $item->zip : 'None' }},
                                                        {{ $item->location ? $item->location : 'None'  }}</span>
                                        
                                                    </th>
                                            <th>Where is the car titled?<span>
                                                @if($item->data)
                                                    @if ($title->wheretitled == 'US')
                                                        {{ $title->state }}, {{ $title->wheretitled }}
                                                    @else
                                                        {{ $title->province }}, {{ $title->wheretitled }}
                                                    @endif
                                                @else
                                                    None
                                                @endif
                                                </span></th>
                                            <th>Is the vehicle titled in your
                                                name?
                                                @if($item->data)
                                                <span>{{ $title->titlehand == '1' ? 'Yes' : 'No' }}</span>
                                                @endif
                                                </th>

                                            <th>What is the title's status?{{$item->data ?  ucwords($title->title_status) : 'None' }}</th>


                                        </tr>
                                        <tr>
                                            <th colspan="2">Do you want to set a minimum price required for your vehicle
                                                to sell?<span>
                                                    @if($item->data)
                                                    @if (json_decode($item->data)->reserve->status == 1)
                                                        Yes - ${{ json_decode($item->data)->reserve->price }}
                                                    @else
                                                        No
                                                    @endif
                                                    @else
                                                    None
                                                    @endif
                                                </span></th>
                                            <th colspan="1">How did you hear about us? If a user referred you please
                                                leave their
                                                <span>{{ $item->referal ? ucwords($item->referal) : 'No' }}</span>
                                            </th>
                                            <th colspan="1">Inspection Amount: <span>{{ $item->inspection ? '$'.$item->inspection : 'None' }}</span>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th colspan="2">Noteworthy options/features<br><span
                                                    class="m-0">{{ $item->features ? $item->features : 'None' }}</span></th>
                                            <th colspan="2">Additional options and equipment list<br><span
                                                    class="m-0">{{ $item->equipment ? $item->equipment : 'None' }}</span>
                                            </th>

                                        </tr>

                                        <tr>
                                            <th>Exterior Color<span>{{ $item->exterior_color ? $item->exterior_color : 'None' }}</span></th>
                                            <th>Interior Color<span>{{ $item->interior_color ? $item->interior_color : 'None' }}</span></th>
                                            <th>Current mileage (mi)<span>{{ $item->mileage ? $item->mileage : 'None' }}</span></th>
                                            <th>What engine is in the vehicle?<span>{{ $item->engine ?  $item->engine : 'None' }}</span></th>
                                        </tr>
                                        <tr>
                                            <th>What is your ownership history? (How long owned, how many miles, etc.)
                                                <span>{{ $item->history }}</span>
                                            </th>
                                            <th>
                                                Is there a loan on the vehicle?

                                                <button type="button"
                                                    class="btn btn-sm btn-toggle btn-primary {{ $item->loan == 1 ? 'active' : '' }}"
                                                    data-toggle="button"
                                                    aria-pressed="{{ $item->loan == 1 ? 'true' : 'false' }}"
                                                    autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
                                            </th>
                                            <th>
                                                Where is the car located?
                                                <span>{{ $item->located }}</span>
                                            </th>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="box-header with-border-top">
                            <h4 class="box-title">Condition</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive-sm">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <th>
                                                <h4> Service History</h4>
                                            </th>

                                        </tr>
                                        <tr>
                                            <th colspan="2">How extensive are the service records?<br><span
                                                    class="m-0">{{ $item->serv_history ? json_decode($item->serv_history)->extensiveservice : 'None' }}</span>
                                            </th>
                                            <th colspan="2">When was the vehicle recently serviced and what was done?
                                                Please include
                                                details. from the past few services if applicable.<br><span
                                                    class="m-0">{{ $item->serv_history ? json_decode($item->serv_history)->whyservce : 'None'}}</span>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4> Vehicle Condition</h4>
                                            </th>
                                        </tr>

                                        <tr>
                                            <th colspan="6">Has the car been
                                                modified?<span>{{ $item->modify ? $item->modify : 'Completely Stock' }}</span>
                                            </th>
                                            @if($item->conditions)
                                                @foreach (json_decode($item->conditions) as $innerkey => $inneritem)
                                                    <th colspan="2">{{ ucwords($innerkey) }} <span> <button type="button"
                                                                class="btn btn-sm btn-toggle btn-primary {{ $inneritem == 1 ? 'active' : '' }}"
                                                                data-toggle="button"
                                                                aria-pressed="{{ $inneritem == 1 ? 'true' : 'false' }}"
                                                                autocomplete="off">
                                                                <div class="handle"></div>
                                                            </button></span> </th>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <th colspan="2">What's included with the car? (How many keys, owner's
                                                manuals, the window sticker, spare parts, extra wheels/tires, etc.)<br><span
                                                    class="m-0">{{ $item->issues ? json_decode($item->issues)->issueone : 'None' }}</span></th>
                                            <th colspan="2">Anything else we should know?<br><span
                                                    class="m-0">{{ $item->issues ? json_decode($item->issues)->issuetwo : 'None' }}</span></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <h4>Videos Link</h4>
                                                <ul class="video-ul">
                                                    <li>
                                                        @if(count(json_decode($item->videos)) > 0)
                                                            @foreach (json_decode($item->videos) as $video)
                                                                <a href="{{ $video }}">{{ $video }}</a>
                                                            @endforeach
                                                        @else
                                                            No videos found
                                                        @endif
                                                    </li>
                                                </ul>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Auction Start Date <span>{{ $item->schedule ? $item->schedule : 'No Schedule' }}</span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <style>
        .box-header.with-border-top {
            border-top: 1px solid rgba(72, 94, 144, 0.16);
            border-radius: 0;
        }

        th span {
            font-weight: 400;
            margin-left: 1rem;
        }

        ul.video-ul {
            list-style: none;
            padding: 0;
        }

        table,
        td,
        tr,
        th {
            border: none !important;
        }
    </style>
@endpush
