@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Create Residence</h4>
                            @if (count ($errors))
                            @foreach ($errors->all() as $error)
                            <p class="alert alert-danger alert-dimissible fade show">{{$error}}</p>

                            @endforeach
                            @endif
                            <form method="post" action="{{ route('residence.store') }}" class="mt-6 space-y-6">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  id="name" name="name">
                                    </div>
                                </div>
                    
                                <input type="submit" value="Create Residence" class="btn btn-info btn-rounded waves-effect waves-light">
                            </form>
                        </div>
                    </div>
                    @php
                        $residnece  = App\Models\Residence::get()
                    @endphp
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List des Residences </h4>
                                <p class="card-title-desc"><code></code>.
                                </p>    
                                
                                <div class="table-responsive">
                                    <table class="table table-dark mb-0">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Residence</th>
                                    
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($residnece as $residnece)
                                            <tr>
                                                <th scope="row"></th>
                                                <td>{{$residnece->name}}</td>
                                            </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

      