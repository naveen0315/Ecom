@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <br>
            <div class="card">
                <div class="card-header">{{ __('All Orders') }}
                    <a class="float-end" href="{{ url('/') }}/home">Back</a>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Sr.No</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Payment ID</th>
                            <th scope="col">Shipment ID</th>
                            <th scope="col">Order Amount</th>
                            {{-- <th scope="col">Name</th>
                            <th scope="col">Address</th> --}}
                            <th scope="col">Order Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($adminOrder as $products )
                            <tr>
                              <th style="padding: 20px;" scope="row">{{$products['id']}}</th>
                              <td style="padding: 20px;">{{$products['user_id']}}</td>
                              <td style="padding: 20px;">{{$products['payment_id']}}</td>
                              <td style="padding: 20px;">{{$products['shipment_id']}}</td>
                              <td style="padding: 20px;">{{$products['amount']}}</td>
                              {{-- <td style="padding: 20px;">{{$products['name']}}</td>
                              <td style="padding: 20px;">{{$products['address']}}</td> --}}
                              <td style="padding: 20px;">
                                  @if($products['order_status'] == 'Hold')
                                    <span style="background-color: yellow; padding:5px; border-radius:5px">{{$products['order_status']}}</span>
                                  @elseif($products['order_status'] == 'Cancel')
                                    <span style="background-color: Red; padding:5px; border-radius:5px">{{$products['order_status']}}</span>
                                  @elseif($products['order_status'] == 'Delivered')
                                    <span style="background-color: Green; padding:5px; border-radius:5px">{{$products['order_status']}}</span>
                                  @else
                                    <span style="background-color: Orange; padding:5px; border-radius:5px">{{$products['order_status']}}</span>
                                  @endif
                            </td>
                              <td style="padding: 20px;">
                                  <a href="{{ url('/') }}/editOrder/{{$products['id']}}" class="btn btn-outline-success">Edit</a>
                                  {{-- <a href="" class="btn btn-outline-success">View</a> --}}
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
