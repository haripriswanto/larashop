@extends('layouts.global');

@section('title') {{ $title }} @endsection

@section('content') 


@if (session('status'))
<div class="alert alert-success" role="alert">
    <strong>{{ session('status') }}</strong>
</div>    
@endif

<div class="col-8">
    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Form Edit</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.update', [$order->id]) }}" method="POST" class="p-3 shadow-sm bg-white">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="">Invoice number</label>
                    <input type="text" class="form-control" disabled value="{{ $order->invoice_number }}">
                </div>
                <div class="form-group">
                    <label for="">Buyer</label>
                    <input type="text" class="form-control" disabled value="{{ $order->user->name }}">
                </div>
                <div class="form-group">
                    <label for="">Order Date</label>
                    <input type="text" class="form-control" disabled value="{{ $order->created_at }}">
                </div>
                <div class="form-group">
                    <label for="">Books ({{ $order->totalQuantity }}) </label>
                    <ul>
                        @foreach ($order->books as $book)
                            <li>{{ $book->title }} <b>{{ $book->pivot->quantity }}</b></li>                            
                        @endforeach
                    </ul>
                </div>
                <div class="form-group">
                    <label for="">Total Price</label>
                    <input type="number" class="form-control" disabled value="{{ $order->total_price }}">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{ $order->status == 'SUBMIT' ? 'SELECTED' : '' }} value="SUBMIT">Submit</option>
                        <option {{ $order->status == 'PROCESS' ? 'SELECTED' : '' }} value="PROCESS">Process</option>
                        <option {{ $order->status == 'FINISH' ? 'SELECTED' : '' }} value="FINISH">Finish</option>
                        <option {{ $order->status == 'CANCEL' ? 'SELECTED' : '' }} value="CANCEL">Cancel</option>
                    </select>
                </div>
                
                <hr class="my-3">
    
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success" value="PUBLISH"> Update </button>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-info"> Cancel </a>
                </div>
            </form>
      </div>
    </div>
</div>

@endsection

@section('footer-scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
<script>
    $('#categories').select2({
        ajax: {
            url: 'http://127.0.0.1:8000/ajax/categories/search',
            processResults: function(data){
                return {
                    results: data.map(function(item){return {id: item.id,text: item.name}})
                }
            }
        }
    })

    var categories = {!! $order->categories !!}

    categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>
@endsection