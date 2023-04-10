@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Create Facture</h4>
                            @if (count ($errors))
                            @foreach ($errors->all() as $error)
                            <p class="alert alert-danger alert-dimissible fade show">{{$error}}</p>

                            @endforeach
                            @endif
                            <form method="post" action="{{ route('facture.store') }}" class="mt-6 space-y-6">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  id="name" name="name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" id="last_name" name="last_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Item</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  id="item" name="item">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Price</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" min="0"  id="price" name="price">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Quantity</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" min="0" id="Quantity" name="Quantity">
                                    </div>
                                </div>
                                <input type="submit" value="Create Facture" class="btn btn-info btn-rounded waves-effect waves-light">
                                <a class="btn btn-info btn-rounded waves-effect waves-light" href="{{route('facture.index')}}">Show Facture</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

      