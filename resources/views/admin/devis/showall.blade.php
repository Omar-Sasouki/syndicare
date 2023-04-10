@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">DEVIS</h4>
                            <p class="card-title-desc">
                            </p>

                            <div class="table-rep-plugin">
                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th data-priority="1">Email</th>
                                                <th data-priority="3">Item</th>
                                                <th data-priority="1">Price</th>
                                                <th data-priority="3">Quantity </th>
                                                <th data-priority="3">Action </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($devis as $devis)
                                                <tr>
                                                    <th>{{ $devis->user->name }}</th>
                                                    <td>{{ $devis->user->email }}</td>
                                                    <td>{{ $devis->item }}</td>
                                                    <td>{{ $devis->Quantity }}</td>
                                                    <td>{{ $devis->price }}</td>
                                                    <td><a href="{{ route('devis.destory', $devis->id) }}"
                                                            class="btn btn-danger">Delete</a>
                                                        <a href="{{ route('devis.show', $devis->id) }}"
                                                            class="btn btn-primary">View</a>
                                                        @if ($devis->pdf)
                                                            <i class="fas fa-check text-success"></i>
                                                        @else
                                                        <form method="POST" action="{{ route('devis.pdf', $devis->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary">PDF</button>
                                                        </form>
                                                        @endif
                                                        
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
@endsection
