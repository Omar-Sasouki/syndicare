@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Reclamtion</h4>
                            <p class="card-title-desc">

                            <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Object</th>
                                        <th>Payload</th>
                                        <th>Type</th>
                                        <th>Image</th>

                                        <th>Action</th>
                                    </tr>
                                </thead><!-- end thead -->

                                @foreach ($a as $a)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0"> {{ $a->user->name }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0"> {{ $a->object }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0"> {{ $a->payload }}</h6>
                                        </td>
                                        <td>
                                            <h6 class="mb-0"> {{ $a->type_id}}</h6>
                                        </td>
                                        <td>
                                            <img class="rounded-circle header-profile-user"
                                            src="{{(!empty($a->image)?
                                                url('upload/reclamtion_images/'.$a->image):
                                                url('upload/no_image.jpg'))}}"
                                            alt="Header Avatar">
                                        </td>
                                        <td>
                                            <a href="{{route ('reclamtion.superadmin.show', $a->id)}}" class="btn btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{route ('reclamtion.superadmin.destroy', $a->id)}}" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    </div>
@endsection
