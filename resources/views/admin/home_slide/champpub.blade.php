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
                            <h4 class="card-title mb-4"> Champ Pub </h4>
                            
                            <form method="post" action="{{ route('store.champ') }}" class="mt-6 space-y-6"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" id="id" name="id" value="{{ $champub->id }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Photo De PUB</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image" name="pub_photo">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="{{ !empty($champub->pub_photo) ? url($champub->pub_photo) : /* : else */ url('upload/no_image.jpg') }}"
                                            id="showImage" class="rounded avatar-lg  " alt="Card image cap">
                                    </div>
                                </div>

                                <input type="submit" value="Update Champ Pub"
                                    class="btn btn-info btn-rounded waves-effect waves-light">

                            </form>

                        </div>
                    </div>
                </div>
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
    <script>
        ClassicEditor
            .create(document.querySelector('#short_title'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
