@extends('admin.admin_master')
@section('admin')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Devis</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">
                                        <h4 class="float-end font-size-16"><strong></strong></h4>
                                        <h3>
                                            <img src="{{ asset('backend/assets/images/logo-Syndiacre.png') }}"
                                                alt="logo" height="75" />
                                        </h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6">
                                            <address>
                                                <strong>Created By :</strong><br>
                                                Syndicare<br>
                                                1001 Tunisie<br>
                                                Apt. 4B<br>
                                                Adress.....
                                            </address>
                                        </div>
                                        <div class="col-6 text-end">
                                            <address>
                                                <strong>Shipped To:</strong><br>
                                                {{ $devis->user->name }}<br>
                                                {{ $devis->last_name }}<br>
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <address>
                                                {{-- <strong>Payment Method:</strong><br>
                                                Visa ending **** 4242<br>
                                                jsmith@email.com --}}
                                            </address>
                                        </div>
                                        <div class="col-6 mt-4 text-end">
                                            <address>
                                                {{-- <strong>Order Date:</strong><br>
                                                January 16, 2019<br><br> --}}
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Order summary</strong></h3>
                                        </div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <td><strong>Item</strong></td>
                                                            <td class="text-center"><strong>Price</strong></td>
                                                            <td class="text-center"><strong>Quantity</strong>
                                                            </td>
                                                            <td class="text-end"><strong>Totals</strong></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                        <tr>

                                                            <td>{{ $devis->item }}</td>
                                                            <td class="text-center">{{ $devis->price }}</td>
                                                            <td class="text-center">{{ $devis->Quantity }}</td>
                                                            <td class="text-end">
                                                                {{ $pricee = $devis->price * $devis->Quantity }}</td>
                                                        </tr>
                                                        <td class="no-line"></td>
                                                        <td class="no-line"></td>
                                                        <td class="no-line text-center">
                                                            <strong>Total</strong>
                                                        </td>
                                                        <td class="no-line text-end">
                                                            @php
                                                                $priceTotle = 0;
                                                            @endphp
                                                            <h4 class="m-0">{{ $priceTotle = $priceTotle + $pricee }}
                                                            </h4>
                                                        </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="d-print-none">
                                                <div class="float-end">

                                                    <form method="POST" action="{{ route('devis.pdf', $devis->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary">Generate PDF and
                                                            Download</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#print-button').click(function() {
                window.print();

                var html = document.documentElement.outerHTML;
                $.ajax({
                    url: '/print',
                    method: 'POST',
                    data: {
                        html: html
                    },
                    success: function(response) {
                        console.log(response.message);
                    }
                });
            });
        });
    </script>
@endsection
