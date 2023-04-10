@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">liste de reclamation</h4>

                            <hr>
                            <form method="post" action="{{ route('store.datereclamtion') }}" class="mt-6 space-y-6">
                                @csrf
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="hiden" value="{{ $RSA->user_id }}"
                                            id="user_id"  name="user_id"  readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Object</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="hiden" value="{{ $RSA->id }}"
                                            id="reclamtion_id"  name="reclamtion_id"  readonly>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">PayLoad</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $RSA->payload }}"
                                            id="payload"  name="payload" readonly>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="example-email-input" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value=" {{ $RSA->type_id }}"
                                        id="type_id"  name="type_id" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Date and
                                        time</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="datetime-local" 
                                            id="date"  name="date" >
                                    </div>
                                </div>
                                <input type="submit" value="Set DATE" class="btn btn-info btn-rounded waves-effect waves-light">
                               
                            </form>
                            @php
                            $Date = App\Models\Datereclamtion::where('reclamtion_id', $RSA->id )->get()
                             @endphp
                              @foreach ($Date as $Date)
                            <div class="row mb-3">
                                <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Your date</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="datetime"  value="{{$Date->date}} ">
                                </div>
                            </div>
                            @endforeach
                            @php
                            $ConfirmationDate = App\Models\DateReclamationConfirmation::where('reclamtion_id', $RSA->id )->get()
                             @endphp
                              @foreach ($ConfirmationDate as $ConfirmationDate)
                            <div class="row mb-3">
                                <label for="example-datetime-local-input" class="col-sm-2 col-form-label">Confirmation Residant</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="datetime"  value="{{$ConfirmationDate->date}} ">
                                </div>
                            </div>
                            @endforeach
                          
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-sm-6">
                    <div class="row mb-4">
                        <div class="card">
                            <img class="card-img-top img-fluid"
                                src="{{ !empty($RSA->image) ? url('upload/reclamtion_images/' . $RSA->image) : url('upload/no_image.jpg') }}"
                                class="img-fluid" alt="Responsive image" alt="Card image cap">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
            <!-- end page title -->
        @endsection
