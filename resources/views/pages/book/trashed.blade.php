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
        Data Book Trash
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="row col mb-3">
                <div class="col-sm-1 mr-3">
                    <a href="{{ route('books.create') }}" class="btn btn-outline-orange">
                        Create <i class="fas fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="col-sm-4">
                    <form action="{{route('books.index')}}" class="form-inline">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control"placeholder="Search By Name" name="keyword" value="{{ Request::get('keyword') }}" autofocus>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-5">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status') == null & Request::path() == 'books' ? 'active' : '' }}" href="{{ route('books.index') }}">All</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status' == 'publish' ? 'active' : '') }}" href="{{ route('books.index', ['status' => 'publish']) }}">Publish</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::get('status' == 'draft' ? 'active' : '') }}" href="{{ route('books.index', ['status' => 'draft']) }}">Draft</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::path() == 'books/trash' ? 'active' : '' }}" href="{{ route('books.trash') }}">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dropdown-divider"></div>

            <table class="table table-bordered table-sm table-hover">
                <thead class="bg bg-secondary-darker">
                    <tr>
                        <th><b>#</b></th>
                        <th><b>Cover</b></th>
                        <th><b>Title</b></th>
                        <th><b>Author</b></th>
                        <th><b>Status</b></th>
                        <th><b>Categories</b></th>
                        <th><b>Stock</b></th>
                        <th><b>Price</b></th>
                        <th><b>Action</b></th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach ($books as $book)    
                    <tr>
                        <td scope="row">{{ $number++ }}</td>
                        <td>
                            @if ($book->cover)
                            <img src="{{ asset('storage/'.$book->cover) }}" width="25">
                            @elseif($book->cover == 'default.png' OR $book->cover == '' )
                            No cover
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            @if ($book->status == 'DRAFT')
                                <span class="badge badge-pill badge-danger text-white">{{ $book->status }}</span>
                            @else
                                <span class="badge badge-pill badge-success text-white">{{ $book->status }}</span>
                            @endif
                        </td>
                        <td>
                            @foreach ($book->categories as $category)
                            <span class="badge badge-pill badge-dark text-white">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->price }}</td>
                        <td>
                            <form action="{{ route('books.restore', [$book->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Restore Data {{$book->title}} ?') ">
                                @csrf
                                <button type="submit" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-window-restore"></i>
                                </button>
                            </form>
                            <form action="{{ route('books.delete-permanent', [$book->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Hapus Permanent Data {{$book->title}} ?') ">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>        
            {{ $books->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
    
@endsection