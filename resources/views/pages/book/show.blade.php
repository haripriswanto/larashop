@extends('layouts.global')

@section('title') {{ $title }} @endsection

@section('content')

<a href="{{ route('books.index') }}" class="btn btn-outline-danger btn-sm">
    Back <i class="fa fa-plus-square-o" aria-hidden="true"></i>
</a>
<a class="btn btn-outline-purple btn-sm" href="{{ route('books.edit', [$book->id]) }}"> Edit </a>
<div class="card my-3">
    <div class="row no-gutters">
      <div class="col-md-4">
        @if ($book->cover)
            <img src="{{ asset('storage/'.$book->cover) }}" class="card-img m-2">
        @elseif($book->cover == 'default.png' OR $book->cover == '')
            <img src="{{ asset('storage/404/no_image.jpg') }}" class="card-img m-2">
        @endif
        {{-- <img src="{{ asset('') }}" alt="..."> --}}
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $book->title }}</h5>
          <p class="card-text"><i class="fas fa-map-marker-alt"></i> {{ $book->name }}</p>
          <p class="card-text"><i class="fas fa-phone-square"></i> {{ $book->Slug }}</p>
          <p class="card-text"><i class="fas fa-user-secret"></i> {{ $book->created_by }}</p>
          <p class="card-text"><i class="fas fa-user-secret"></i> {{ $book->updated_by }}</p>
          <p class="card-text"><small class="text-muted">Last Upd: {{ $book->updated_at}}</small></p>
          <p class="card-text">
              
          </p>
        </div>
      </div>
    </div>
</div>
@endsection