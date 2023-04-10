@extends('admin.admin_master')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title mb-4">Create Devis</h4>
                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger alert-dimissible fade show">{{ $error }}</p>
                                @endforeach
                            @endif
                            <form method="post" action="{{ route('devis.store') }}" class="mt-6 space-y-6">
                                @csrf
                                <div class="row mb-3">
                                    <div class="form-group row">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <select name="user_id" class="form-select form-select-lg mb-3"
                                                data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="3">Select</option>
                                                @foreach ($users as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Item</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="item" name="item">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Price</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="number" min="0" id="price"
                                                name="price">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Quantity</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="number" min="0" id="Quantity"
                                                name="Quantity">
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" value="Create Devis"
                                    class="btn btn-info btn-rounded waves-effect waves-light">
                                <a class="btn btn-info btn-rounded waves-effect waves-light"
                                    href="{{ route('devis.showall') }}">Show ALL Devis</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
