@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Object : {{ $RSA->object }} </h4>
                            <hr>
                            <h4 class="card-title">PayLoad : {{ $RSA->payload }}</h4>
                            <hr>
                            <h4 class="card-title">Type : {{ $RSA->type_id}} </h4>
                        </div>
                    </div>
                </div>
            </div>
            <center>
              
                    <div class="col-md-6 col-xl-3" >
                    <div class="card">
                        <img class="card-img-top img-fluid"
                            src="{{ !empty($RSA->image) ? url('upload/reclamtion_images/' . $RSA->image) : url('upload/no_image.jpg') }}"
                            class="img-fluid" alt="Responsive image" alt="Card image cap">
                        <div class="card-body">
                        </div>
                    </div>  
            </center>
           

           </div>
        </div>
    </div>
@endsection
