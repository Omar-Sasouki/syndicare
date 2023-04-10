@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Edit Profile</h4>
                            <form method="post" action="{{ route('store.profile') }}" class="mt-6 space-y-6"
                                       enctype="multipart/form-data">
                                @csrf


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $editData->name }}"
                                            id="name" name="name">
                                    </div>
                                </div>
                               
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $editData->email }}"
                                            id="email" name="email" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image" name="profile_image">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img src="{{(!empty($editData->profile_image)?
                                            url('upload/admin_images/'.$editData->profile_image):
                                            url('upload/no_image.jpg'))}}"
                                            id="showImage" class="rounded avatar-lg  " alt="Card image cap">
                                    </div>
                                </div>

                                <input type="submit" value="Update Profile" class="btn btn-info btn-rounded waves-effect waves-light">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    @endsection
