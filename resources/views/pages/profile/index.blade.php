@extends('layouts.global')

@section('title') Profile User @endsection

@section('content')

{{-- <div class="alert alert-secondary" role="alert">
    <strong>@yield("title")</strong>
</div> --}}

<a href="{{ route('users.index') }}" class="btn btn-outline-danger btn-sm">
    Back <i class="fa fa-plus-square-o" aria-hidden="true"></i>
</a>
<a class="btn btn-outline-purple btn-sm" href="{{ route('users.edit', [$user->id]) }}"> Edit </a>
<div class="card my-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        @if ($user->avatar)
            <img src="{{ asset('storage/'.$user->avatar) }}" class="card-img m-2">
        @elseif($user->avatar == 'default.png' OR $user->avatar == '')
            <img src="{{ asset('storage/avatars/default.png') }}" class="card-img m-2">
        @endif
        {{-- <img src="{{ asset('') }}" alt="..."> --}}
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $user->name }}</h5>
          <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $user->address }}</p>
          <p class="card-text"><i class="fas fa-phone-square"></i> {{ $user->phone }}</p>
          <p class="card-text"><i class="fas fa-envelope-open-text"></i> {{ $user->email }}</p>
          <p class="card-text"><i class="fas fa-user-secret"></i> {{ $user->username }}</p>
          <p class="card-text"><i class="fas fa-user-tag"></i> @foreach (json_decode($user->roles) as $role)
            <span class="badge badge-pill badge-primary">{{ $role }}</span> 
            @endforeach</p>
          <p class="card-text"><small class="text-muted">Last Upd: {{ $user->created_at}}</small></p>
          <p class="card-text">
              
          </p>
        </div>
      </div>
    </div>
</div>
@endsection