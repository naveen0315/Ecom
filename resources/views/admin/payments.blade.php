@extends('layouts.app')

@section('content')
    <!-- Message -->
    @if (session()->has('message'))
        <div class="alert alert-danger">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <br>
                <div class="card">
                    <div class="card-header">{{ __('All Payments') }}
                        <a class="float-end" href="{{ url('/') }}/home">Back</a>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Order No</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">User Email</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Transcation No</th>
                                    <th scope="col">Payment Mode</th>
                                    <th scope="col">Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentTable as $payments)
                                    <tr>
                                        <th style="padding: 10px;" scope="row">{{ $payments['id'] }}</th>
                                        <td style="width: 200px; padding: 10px;">{{ $payments->user['First_Name'] }} {{ $payments->user['Last_Name'] }}</td>
                                        <td style="width: 200px; padding: 10px;">{{ $payments->user['email'] }}</td>
                                        <td style="padding: 10px;">{{ $payments->amount }}</td>
                                        <td style="padding: 10px;">{{ $payments->orderRelation->payment_status }}</td>
                                        <td style="padding: 10px;">{{ $payments->orderRelation->transcation_no }}</td>
                                        <td style="padding: 10px;">{{ $payments->orderRelation->payment_type }}</td>
                                        <td style="padding: 10px;">{{ $payments->orderRelation->created_at  }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: center;">{!! $paymentTable->appends(Request::all())->links() !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
