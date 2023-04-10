@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                           {{--  <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div> --}}
                        </div>

                        <h4 class="card-title mb-4">Latest Transactions</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Residence</th>
                                        <th>Start date</th>
                                        <th style="width: 120px;">Status</th>
                                    </tr>
                                </thead><!-- end thead -->
                                @php
                                    $users = App\Models\User::orderBy('created_at', 'desc')->get()
                                @endphp
                                <tbody>
                                     @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">{{$user->name}}</h6>
                                        </td>

                                        <td>
                                            {{$user->email}}
                                        </td>
                                   
                                        <td> {{$user->residence->name}}</td>
                                        <td> {{$user->created_at}}</td>
                                        <td>
                                            @if ($user->ban==1)
                                        <a href="{{route('users.bann', [$user->id,'ban_code'=>0 ])}}" class="btn btn-danger">
                                            <i class="fa fa-ban"></i>
                                        </a>
                                        @else
                                        <a href="{{route('users.bann', [$user->id,'ban_code'=>1 ])}}" class="btn btn-success">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        @endif
                                        @if ($user->approved==0)
                                        <a href="{{route('users.approved', [$user->id,'approved_code'=>0 ])}}" class="btn btn-primary">
                                            <i class="fa fa-child"></i>
                                        </a>
                                        @else
                                        <a href="{{route('users.approved', [$user->id,'approved_code'=>1 ])}}" class="btn btn-success">
                                            <i class="fa fa-child"></i>
                                        </a>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->

        </div>
        <!-- end row -->
    </div>
</div>

@endsection
