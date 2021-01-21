@extends('layouts.global')

@section('title') Detail Kategori @endsection

@section('content')

<a href="{{ route('categories.index') }}" class="btn btn-outline-danger btn-sm">
    Back <i class="fa fa-plus-square-o" aria-hidden="true"></i>
</a>
<a class="btn btn-outline-purple btn-sm" href="{{ route('categories.edit', [$category->id]) }}"> Edit </a>
<div class="card my-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        @if ($category->image)
            <img src="{{ asset('storage/'.$category->image) }}" class="card-img m-2">
        @elseif($category->image == 'default.png' OR $category->image == '')
            <img src="{{ asset('storage/404/no_image.jpg') }}" class="card-img m-2">
        @endif
        {{-- <img src="{{ asset('') }}" alt="..."> --}}
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $category->name }}</h5>
          <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $category->name }}</p>
          <p class="card-text"><i class="fas fa-phone-square"></i> {{ $category->Slug }}</p>
          <p class="card-text"><i class="fas fa-user-secret"></i> {{ $category->created_by }}</p>
          <p class="card-text"><i class="fas fa-user-secret"></i> {{ $category->updated_by }}</p>
          <p class="card-text"><small class="text-muted">Last Upd: {{ $category->updated_at}}</small></p>
          <p class="card-text">
              
          </p>
        </div>
      </div>
    </div>
</div>
@endsection