@extends('admin.layouts.app')
@section('title', 'Add Vehicle ')
@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $data == null ? 'Add' : 'Update ' }} Vehicle
                        {{ $data == null ? '' : '#' . $data->id }}</h3>

                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#"><i class="mdi mdi-home-outline">Vehicle Management</i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $data == null ? 'Add' : 'Update ' }} Vehicle</li>
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
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="box-header with-border">
                            <div class="d-flex justify-content-between">
                                <h4 class="box-title">{{ $data == null ? 'Upload' : 'Update ' }} Vehicle Details</h4>
                                <div>
                                   
                                    
                                    @if($data)
                                        @if($data->accept == 0)
                                         <button id="acceptcar" class="btn btn-info btn-xs">Accept this new car</button>
                                        @endif
                                        <a target="_blank" href="{{ route('admin.vehicleDetail', $data->id) }}">Form Details</a>
                                    @endif
                                </div>
                              
                            </div>


                        </div>
                        <!-- /.box-header -->
                        <form class="form" method="post" id="vehicleform"
                            action="{{ $data == null ? route('vehicle.store') : route('vehicle.update', $data->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="seller_id"
                                value="{{ $data == null ? Auth::user()->id : $data->seller_id }}">
                            {{ $data != null ? method_field('PUT') : '' }}
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                     
                                      
                                        <div class="form-group">
                                            <label for="make">Make</label>
                                            <select name="make_id" class="form-control" id="make">
                                                @foreach ($make as $item)
                                                    <option {{$data ?( ($item->id == $data->make_id) ? 'selected' : '') : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                         <div class="form-group">
                                            <label for="reserve">No Reserve</label>
                                            <select name="reserve" class="form-control" id="reserve">
                                                <option {{ $data ? ($data->reserve == 0 ? 'selected' : '') : ''}} value="0">No</option>
                                                    <option {{ $data ? ($data->reserve == 1 ? 'selected' : '') : ''}} value="1">Yes</option>
                                            </select>
                                        </div>
                                            <div class="form-group">
                                            <label for="title_status">Title Status</label>
                                         <input class="form-control" name="title_status" type="text" id="title_status"
                                                value="{{ $data == null ? old('title_status') : $data->title_status }}" required>

                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name" class="control-label">{{ 'Name' }}</label>
                                            <input class="form-control" name="name" type="text" id="name"
                                                value="{{ $data == null ? old('name') : $data->name }}" required>

                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('model') ? 'has-error' : '' }}">
                                            <label for="model" class="control-label">{{ 'Model' }}</label>
                                            <input class="form-control" name="model" type="text" id="model"
                                                value="{{ $data == null ? old('model') : $data->model }}" required>

                                            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('mileage') ? 'has-error' : '' }}">
                                            <label for="mileage" class="control-label">{{ 'Mileage' }}</label>
                                            <input class="form-control" name="mileage" type="number" id="mileage"
                                                value="{{ $data == null ? old('mileage') : $data->mileage }}" required>

                                            {!! $errors->first('mileage', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('year') ? 'has-error' : '' }}">
                                            <label for="mileage" class="control-label">{{ 'Year' }}</label>
                                            <input type="number" class="form-control" id="year" name="year"
                                                min="1000" max="9999" required
                                                value="{{ $data == null ? old('year') : $data->year }}">

                                            {!! $errors->first('mileage', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('vin') ? 'has-error' : '' }}">
                                            <label for="vin" class="control-label">{{ 'Vin' }}</label>
                                            <input class="form-control" name="vin" type="text" id="vin"
                                                value="{{ $data == null ? old('vin') : $data->vin }}" required>

                                            {!! $errors->first('vin', '<p class="help-block">:message</p>') !!}
                                        </div>
                                      
                                        <div class="form-group{{ $errors->has('location') ? 'has-error' : '' }}">
                                            <label for="location" class="control-label">{{ 'Location' }}</label>
                                            <input class="form-control" name="location" type="text" id="location"
                                                value="{{ $data == null ? old('location') : $data->location }}">

                                            {!! $errors->first('location', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('engine') ? 'has-error' : '' }}">
                                            <label for="engine" class="control-label">{{ 'Engine' }}</label>
                                            <input class="form-control" name="engine" type="text" id="engine"
                                                value="{{ $data == null ? old('engine') : $data->engine }}">

                                            {!! $errors->first('engine', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('drivetrain') ? 'has-error' : '' }}">
                                            <label for="drivetrain" class="control-label">{{ 'Drivetrain' }}</label>
                                            <input class="form-control" name="drivetrain" type="text" id="drivetrain"
                                                value="{{ $data == null ? old('drivetrain') : $data->drivetrain }}">

                                            {!! $errors->first('drivetrain', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('transmission_mode') ? 'has-error' : '' }}">
                                            <label for="transmission_mode"
                                                class="control-label">{{ 'Transmission Mode' }}</label>
                                            <select name="transmission_mode" id="" class="form-control">
                                                <option
                                                    {{ $data ? ($data->transmission_mode == 'manual' ? 'selected' : '') : '' }}
                                                    value="manual">Manual</option>
                                                <option
                                                    {{ $data ? ($data->transmission_mode == 'automatic' ? 'selected' : '') : '' }}
                                                    value="automatic">Automatic</option>
                                            </select>

                                            {!! $errors->first('transmission_mode', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        <div class="form-group{{ $errors->has('body_style') ? 'has-error' : '' }}">
                                            <label for="body_style" class="control-label">{{ 'Body Style' }}</label>
                                            <select name="body_style_id" id="body_style_id" class="form-control">
                                                @foreach ($bodystyle as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $data ? ($item->id == $data->body_style_id ? 'selected' : '') : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            {!! $errors->first('body_style', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('exterior_color') ? 'has-error' : '' }}">
                                            <label for="exterior_color"
                                                class="control-label">{{ 'Exterior Color' }}</label>
                                            <input class="form-control" name="exterior_color" type="text"
                                                id="exterior_color"
                                                value="{{ $data == null ? old('exterior_color') : $data->exterior_color }}">

                                            {!! $errors->first('exterior_color', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('starting_bid') ? 'has-error' : '' }}">
                                            <label for="starting_bid"
                                                class="control-label">{{ 'Starting Bid in ($)' }}</label>
                                            <input class="form-control" name="starting_bid" type="number"
                                                step="0.01" id="starting_bid"
                                                value="{{ $data == null ? old('starting_bid') : $data->starting_bid }}">

                                            {!! $errors->first('starting_bid', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('expire') ? 'has-error' : '' }}">
                                            <label for="starting_bid" class="control-label">{{ 'Expire Time' }}</label>
                                            <input class="form-control" name="expire" type="datetime-local"
                                                step="0.01" id="expire"
                                                value="{{ $data == null ? old('expire') : $data->expire }}">

                                            {!! $errors->first('expire', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        <div class="form-group{{ $errors->has('interior_color') ? 'has-error' : '' }}">
                                            <label for="interior_color"
                                                class="control-label">{{ 'Interior Color' }}</label>
                                            <input class="form-control" name="interior_color" type="text"
                                                id="interior_color"
                                                value="{{ $data == null ? old('interior_color') : $data->interior_color }}">

                                            {!! $errors->first('interior_color', '<p class="help-block">:message</p>') !!}
                                        </div>

                                        <div class="form-group{{ $errors->has('short_desc') ? 'has-error' : '' }}">
                                            <label for="description"
                                                class="control-label">{{ 'Short Description' }}</label>
                                            <textarea class="editor" id="short_desc" name="short_desc">{!! $data == null ? old('short_desc') : $data->short_desc !!}</textarea>

                                            {!! $errors->first('short_desc', '<p class="help-block">:message</p>') !!}
                                        </div>

                                     

                                        <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
                                            <label for="description" class="control-label">{{ 'Description' }}</label>
                                            <textarea class="editor" id="description" name="description">{!! $data == null ? old('description') : $data->description !!}</textarea>

                                            {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                        </div>
                                     
                                        <div class="form-group">
                                            <input type="checkbox" id="basic_checkbox_2" {{ $data ? ($data->crash ? 'checked' : '') : '' }} class="filled-in" />
                                            <label for="basic_checkbox_2">This vechile has crash history or not?</label>
                                        </div>
                                        <div class="form-group{{ $errors->has('crash') ? 'has-error' : '' }}"
                                            id="crash_form" style="display:{{ $data ? ($data->crash ? 'block' : 'none') : 'none' }} ">
                                            <label for="crash" class="control-label">{{ 'Crash Gallery' }}</label>
                                            <input type="hidden" id="crashimages"
                                                value="{{ $data ? ($data->crash ? json_encode($data->crash) : '') : '' }}">
                                            <div class="file-loading">
                                                <input id="crash-file" name="input-ficons-5[]" multiple type="file">
                                            </div>

                                        </div>
                                        <div id="repeater">
                                                <!-- Repeater Items -->
                                                <div class="items" data-group="attrbiute">
                                                    <div class="item-content">
                                                       
                                                        @if ($data)
                                                         @if($data->videos)
                                                                @foreach(json_decode($data->videos,true) as $key => $item)
                                                                    <div class="form-group">
                                                                        <label for="">Video # {{$key+1}}</label>
                                                                        <div class="class-attr d-flex">
                                                                            <input disabled type="text"   name="videos[]"
                                                                                class="form-control"
                                                                                value="{{ $item }}">
                                                                            <button type="button"
                                                                                onclick="deleteVideo(this,'{{ $item}}')"
                                                                                class="waves-effect waves-light btn btn-sm btn-rounded btn-primary-light mb-5">
                                                                                <i class="ti-trash"></i>
                                                                                Delete</button>
                                                                        </div>
    
                                                                    </div>
                                                                @endforeach
                                                             @endif
                                                        @endif

                                                        <div class="form-group">
                                                            <label for="">New Video</label>
                                                            <div class="class-attr d-flex">
                                                                <input type="text" name="videos[]" class="form-control">
                                                                <button type="button"
                                                                    onclick="$(this).parent().parent().remove()"
                                                                    class="waves-effect waves-light btn btn-sm btn-rounded btn-primary-light mb-5">
                                                                    <i class="ti-trash"></i>
                                                                    Delete</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="repeater-heading">
                                                        <button type="button"
                                                            class="waves-effect waves-light btn btn-danger-light btn-sm btn-rounded repeater-add-btn">
                                                            <i class="ti-plus"></i>
                                                            Add
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
                                            <label for="image" class="control-label">{{ 'Image' }}</label>
                                            <input type="file" class="dropify" name="image"
                                                {{ $data != null ? 'data-default-file = ' . asset($data->image) : '' }}>

                                            {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="gallery">Gallery</label>
                                            <input type="hidden" id="productimages"
                                                value="{{ $data ? ($data->images ? json_encode($data->images) : '') : '' }}">
                                            <div class="file-loading">
                                                <input id="image-file" name="input-ficons-5[]" multiple type="file">
                                            </div>


                                        </div>

                                        @if (Auth::user()->hasRole('admin'))
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="0"
                                                        {{ $data != null && $data->status == 0 ? 'selected' : '' }}>
                                                        Deactive</option>
                                                    <option value="1"
                                                        {{ $data != null && $data->status == 1 ? 'selected' : '' }}>Active
                                                    </option>

                                                </select>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1">
                                    <i class="ti-trash"></i> Cancel
                                </button>
                                <button type="button" id="saveSubmit" class="btn btn-rounded btn-primary btn-outline">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

@push('css')
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <style>
          .items{
           margin: 0 auto;
        }
        .form-group.border-primary::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.9);
            border-radius: 10px;
            background-color: #CCCCCC;
        }

        .form-group.border-primary::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        .form-group.border-primary::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: rgb(255, 255, 255);
            background: linear-gradient(351deg, rgba(255, 255, 255, 1) 0%, rgba(253, 104, 62, 1) 23%, rgba(253, 225, 62, 1) 100%)
        }

        .form-group.border-primary {
            height: 350px;
            overflow-y: scroll;
        }

        div.border-primary {
            border: 1px solid #fd683e;
            border-radius: 13px;
            padding: 12px;
        }


        div#repeater {
            margin: 0 auto;
            width: 50%;
            display: flex;
            flex-direction: column-reverse;
        }

        .class-attr input {
            width: 200px;
            margin-right: 5px;
        }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
    <script>
    $('#acceptcar').click(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('vehicleDetail.acceptCar') }}",
                type: "post",
                data: {
                    id: "{{$data ? $data->id : ''}}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $('#acceptcar').slideUp();
                        toastrShow('Accepted!', response.message, 'success');
                    }
                }
            })
    })
        deleteVideo = (element, video) => {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                _token: "{{ csrf_token() }}",
                url: "{{ route('vehicleDetail.deleteVideo') }}",
                type: "post",
                data: {
                    id: "{{$data ? $data->id : ''}}",
                    video: video
                },
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        $(element).parent().parent().remove();
                        toastrShow('Deleted!', response.message, 'success');
                    }
                }
            })

        }
         $(document).ready(function() {
            var entryClone = $('.item-content .form-group:last');
            $('.repeater-heading button').click(function(e) {
                e.preventDefault()
                entryClone.clone().appendTo('.item-content');
            })
        });
        $('#basic_checkbox_2').change(function() {
            if ($(this).is(':checked')) {
                $('#crash_form').slideDown();

            } else {
                $('#crash_form').slideUp();
                $('#crash_form').val('')


            }
        })
    </script>
     <script>
        
        var crashFormData = new FormData();
        var productImages = $('#crashimages').val().length > 0 ? JSON.parse($('#crashimages').val()) : []
        var urls = [],
            initialPreviewConfig = [],
            initialPreviewAsData = false;
        if (Object.keys(productImages).length > 0) {
            JSON.parse(productImages)

            JSON.parse(productImages).forEach(function(obj, index) {

                urls.push('{{ asset('/') }}' + '/' + obj);

                initialPreviewConfig.push({
                    caption: obj.split('/').slice(-1)[0],
                    downloadUrl: '{{ asset('/') }}' + '/' + obj,
                    url: "{{ route('vehicle.crash.delete_img') }}",
                    key: '{{ $data ? $data->id : '0' }}',
                    extra: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        path: obj
                    }
                })
            });

            initialPreviewAsData = true

        }

        $("#crash-file").fileinput({
            showUpload: false,
            uploadUrl: "{{ $data == null ? route('vehicle.store') : route('vehicle.update', $data->id) }}",
            theme: 'fa',
            initialPreview: urls,
            initialPreviewAsData: initialPreviewAsData,
            initialPreviewConfig: initialPreviewConfig,
            uploadAsync: false,
            browseOnZoneClick: true,
            initialPreviewShowDelete: true,
            dropZoneEnabled: true,
            overwriteInitial: false,
            maxFilesNum: 20,
            uploadExtraData: function() {
                return {
                    created_at: $('.created_at').val()
                };
            }
        }).on('filebatchselected', function(event, files) {

            $.each(files, function(index, value) {
                crashFormData.append('crashgalleries[]', value['file'])
            });
        });
    </script>
    <script>
        var productImages = $('#productimages').val().length > 0 ? JSON.parse($('#productimages').val()) : []
        var urls = [],
            initialPreviewConfig = [],
            initialPreviewAsData = false;
        if (Object.keys(productImages).length > 0) {
            JSON.parse(productImages)

            JSON.parse(productImages).forEach(function(obj, index) {

                urls.push('{{ asset('/') }}' + '/' + obj);

                initialPreviewConfig.push({
                    caption: obj.split('/').slice(-1)[0],
                    downloadUrl: '{{ asset('/') }}' + '/' + obj,
                    url: "{{ route('vehicle.delete_img') }}",
                    key: '{{ $data ? $data->id : '0' }}',
                    extra: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        path: obj
                    }
                })
            });

            initialPreviewAsData = true

        }
        var formData = new FormData();


        $("#image-file").fileinput({
            showUpload: false,
            uploadUrl: "{{ $data == null ? route('vehicle.store') : route('vehicle.update', $data->id) }}",
            theme: 'fa',
            initialPreview: urls,
            initialPreviewAsData: initialPreviewAsData,
            initialPreviewConfig: initialPreviewConfig,
            uploadAsync: false,
            browseOnZoneClick: true,
            initialPreviewShowDelete: true,
            dropZoneEnabled: true,
            overwriteInitial: false,
            maxFilesNum: 20,
            uploadExtraData: function() {
                return {
                    created_at: $('.created_at').val()
                };
            }
        }).on('filebatchselected', function(event, files) {

            $.each(files, function(index, value) {
                formData.append('productgalleries[]', value['file'])
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            function restrictYearInput() {
                return (/^\d{4}$/.test(document.getElementById('year').value.trim())) ? true : false;

            }
            $('#saveSubmit').click(function(e) {
                removeAllErrors();
                
                var productForm = new FormData($('#vehicleform').get(0));
                formData.forEach(function(value, key) {
                    productForm.append('gallery[]', value)
                });
                crashFormData.forEach(function(value, key) {
                    productForm.append('crashgallery[]', value)
                });

                if ($('.dropify')[0].files[0]) {
                    productForm.append('image', $('.dropify')[0].files[0])
                }
                if($('#status').val() == 1 && $('#expire').val().length <= 0 )
                {
                       swal("ERROR!", "Your auction end time is not set please set.", "error");
                  
                }else{
                    
                    if (restrictYearInput()) {
                        $.ajax({
                            xhr: function() {
                                var xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function(evt) {
                                    loaderShow()
                                }, false);
                                return xhr;
                            },
                            method: 'post',
                            processData: false,
                            contentType: false,
                            cache: false,
    
                            data: productForm,
                            enctype: 'multipart/form-data',
                            url: $('#vehicleform').attr('action'),
    
                        }).done(function(response) {
                            loaderHide()
                            if ($('input[name="_method"]').val() == 'POST') {
                                $('#image-file').fileinput('clear');
                                $(".dropify").trigger("click");
                            }
                            swal("SUCCESS!", "Product Added Successfully", "success");
    
    
                        }).fail(function(jqxhr, textStatus, error) {
                            let string = ''
                            $.each(jqxhr.responseJSON.errors, function(key, value) {
                                $('#' + key).addClass('error-control');
                                $("#" + key + 'error').text(value[0]);
                                string += value[0] + '\n';
                                $("#" + key + 'error').removeClass('d-none');
                            });
                            loaderHide()
    
    
                            swal("ERROR!", string, "error");
                        });
                    } else {
                      
                             swal("ERROR!", "Invalid Year!", "error");
    
                    }
                }
             




            });

        })
    </script>
    <script>
        $('input[type="checkbox"]').change(function() {
            ($(this).prop("checked")) ? $(this).val(1): $(this).val(0);
        })
    </script>
@endpush
