@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
 
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                    <h4 class="mb-sm-0">Residence Name: {{ $residence->name }} </h4>

                </div>
                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type') }}" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('update-event') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="card border border-primary">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>First Event
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-form-label">Event Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="event_title1" name="event_title1"
                                                value="{{ old('event_title1') }}">
                                            @error('event_title1')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class=" col-form-label">Event Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="image" name="event1">
                                            @error('event1')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <img src="{{ !empty($residence->event1) ? url('upload/events/' . $residence->event1) : /* : else */ url('upload/no_image.jpg') }}"
                                                id="showImage" class="rounded avatar-lg  " alt="Card image cap">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="card border border-danger">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Second Event
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-form-label">Event Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="event_title2" name="event_title2"
                                                value="{{ old('event_title2') }}">
                                            @error('event_title2')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class=" col-form-label">Event Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="image2" name="event2">
                                            @error('event2')
                                            <div class="text-danger">{{ $message }}</div>
                                         @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <img src="{{ !empty($residence->event2) ? url('upload/events/' . $residence->event2) : /* : else */ url('upload/no_image.jpg') }}"
                                                id="showImage2" class="rounded avatar-lg  " alt="Card image cap">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <div class="card border border-success">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Third Event
                                    </h5>
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-form-label">Event Title</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="event_title3" name="event_title3"
                                                value="{{ old('event_title3') }}">
                                            @error('event_title3')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class=" col-form-label">Event Image</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="image3" name="event3">
                                            @error('event3')
                                            <div class="text-danger">{{ $message }}</div>
                                          @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                        <div class="col-sm-10">
                                            <img src="{{ !empty($residence->event3) ? url('upload/events/' . $residence->event3) : /* : else */ url('upload/no_image.jpg') }}"
                                                id="showImage3" class="rounded avatar-lg  " alt="Card image cap">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Events</button>
                        </div>
                    </center>
                   
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image2').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage2').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#image3').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage3').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
