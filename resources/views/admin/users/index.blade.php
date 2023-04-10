@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Liste de Resident</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                            <li class="breadcrumb-item active"></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">liste de resident</h4>
                        <p class="card-title-desc">
                          
                        </p>
                        @if (session('success'))
                        <span class="text-danger">{{session('success')}}</span>
                        @endif
                        <table id="state-saving-datatable" class="table activate-select dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th> 
                                    <th>Email</th>
                                    <th>Residence</th>
                                    <th>Num Appartement</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                               @foreach ($user as $user)
                            {{-- liste onligne user or offli
                                @if($user->isOnline())
                                <li class="text-success">online<li>
                                 @else
                                 <li class="text-muted">offline<li>
                                 @endif --}}
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->residence->name}}</td>
                                    <td>{{$user->appartement->number}}</td>
                                    <td><a href="{{route('users.show', $user->id)}}" class="btn btn-danger">role</a>
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
                                        @if ($user->paymentSyndic==0)
                                        <a href="{{route('users.setPaymentSyndic', [$user->id])}}" class="btn btn-danger">
                                            <i class=" fas fa-money-bill" ></i>
                                        </a>
                                        @else
                                        <a href="{{route('users.setPaymentSyndic', [$user->id])}}" class="btn btn-primary">
                                            <i class=" fas fa-money-bill" ></i>
                                        </a>
                                        @endif
                                    </td>
                               
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
    
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>
</div>



@endsection
