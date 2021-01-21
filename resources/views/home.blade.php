@extends('layouts.global')

@section("title") Home @endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card border-success">
                <div class="card-header bg bg-success text-white">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-info">
                <div class="card-header bg bg-info text-white">{{ __('Info!') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Info Hari Ini') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
