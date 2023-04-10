@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Edit Home Page</h4>
                            <form method="post" action="{{ route('store.homeslider') }}" class="mt-6 space-y-6"
                                       enctype="multipart/form-data">
                                @csrf

                                <input  type="hidden" id="id" name="id" value="{{$homeslide->id}}">

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="title" name="title"
                                        value="{{$homeslide->title}}">
                                    </div>
                                </div>
                           
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short title</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" type="text" name="short_title">{{$homeslide->short_title}}</textarea>
                                      {{--   <textarea class="form-control" type="text" id="short_title" name="short_title"  >{{$homeslide->short_title}}</textarea> --}}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Video Url</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="video_url" name="video_url"
                                        value="{{$homeslide->video_url}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Home Slide</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image" name="home_slide">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="{{(!empty($homeslide->home_slide)?
                                            url($homeslide->home_slide):/* : else */ url('upload/no_image.jpg'))}}"
                                            id="showImage" class="rounded avatar-lg  " alt="Card image cap">
                                    </div>
                                </div>

                                <input type="submit" value="Update Home Page" class="btn btn-info btn-rounded waves-effect waves-light">
                                <a href="{{url('/')}}"> <i class="fa fa-eye"></i></a>
                            </form>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>


      

    </div> <!-- container-fluid -->
        <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        </script>
        <script>
            ClassicEditor
                .create( document.querySelector( '#short_title' ) )
                .catch( error => {
                    console.error( error );
                } );
        </script>       
        <script src="{{asset('backend/assets/libs/tinymce/tinymce.min.js')}}"></script>
        <script src="{{asset('backend/assets/js/pages/form-editor.init.js')}}"></script>
      
    @endsection
