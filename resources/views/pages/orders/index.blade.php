@extends('layouts.global')

@section('title') {{ $title }} @endsection

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    <strong>{{ session('status') }}</strong>
</div>    
@endif

<div class="card border-primary-lighter">
    <div class="card-header bg bg-primary-lighter text-white">
        Data Order
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <form action="{{ route('orders.index') }}" class="form-inline">
                <div>
                    <input type="text" class="form-control" name="buyer_email" id="buyer_email" placeholder="Search By Buyer Email" value="{{ Request::get('buyer_email') }}" autofocus>
                </div>
                <div class="col-md-4">
                    <select class="form-control" name="status" id="status">
                      <option value="">ANY</option>
                      <option {{ Request::get('status') == 'SUBMIT' ? 'SELECTED' : ''}} value="SUBMIT">Submit</option>
                      <option {{ Request::get('status') == 'PROCESS' ? 'SELECTED' : ''}} value="PROCESS">Process</option>
                      <option {{ Request::get('status') == 'FINISH' ? 'SELECTED' : ''}} value="FINISH">Finish</option>
                      <option {{ Request::get('status') == 'CANCEL' ? 'SELECTED' : ''}} value="CANCEL">Cancel</option>
                    </select>
                    <button class="btn btn-outline-purple"><i class="fas fa-search"></i></button>
                </div>
                <div>
                </div>
            </form>
            <hr class="my-3">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>invoice</th>
                        <th>Status</th>
                        <th>Buyer</th>
                        <th>Total Quantity</th>
                        <th>Order Date</th>
                        <th>Total Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->invoice_number }}</td>
                        <td>
                            @if ($order->status == "SUBMIT")
                                <span class="badge bg-warning text-light">{{ $order->status }}</span>
                            @elseif($order->status == "PROCESS")
                                <span class="badge bg-info text-light">{{ $order->status }}</span>
                            @elseif($order->status == "FINISH")
                                <span class="badge bg-success text-light">{{ $order->status }}</span>
                            @elseif($order->status == "CANCEL")
                                <span class="badge bg-dark text-light">{{ $order->status }}</span>
                            @endif
                        </td>
                        <td>
                            {{ $order->user->name }}<br>
                            <small>{{ $order->user->email }}</small>
                        </td>
                        <td>{{ $order->totalQuantity }} pc (s)</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>
                            <a href="{{ route('orders.edit', [$order->id]) }}" class="btn btn-outline-purple btn-sm"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
    
@endsection