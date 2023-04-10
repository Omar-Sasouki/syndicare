@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Change Password</h4>

                            @if (count ($errors))
                            @foreach ($errors->all() as $error)
                            <p class="alert alert-danger alert-dimissible fade show">{{$error}}</p>

                            @endforeach
                            @endif

                            <form method="post" action="{{ route('store.Password') }}" class="mt-6 space-y-6"
                                       enctype="multipart/form-data">
                                @csrf


                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">OLd Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password"
                                            id="oldpassword" name="oldpassword">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password"
                                            id="newpassword" name="newpassword">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password"
                                            id="passwordc" name="passwordc">
                                    </div>
                                </div>

                                <input type="submit" value="Change Password" class="btn btn-info btn-rounded waves-effect waves-light">
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
