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
        Data Kategori Trash
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div class="row col mb-3">
                <div class="col-sm-1 mr-3">
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-orange">
                        Create <i class="fas fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="col-sm-4">
                    <form action="{{route('categories.index')}}" class="form-inline">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control"placeholder="Ketik Nama Kategori" name="keyword" value="{{ Request::get('keyword') }}" autofocus>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-5">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('categories.index')}}">Published</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('categories.trash')}}">Trash</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dropdown-divider"></div>

            <table class="table table-bordered table-sm table-hover">
                <thead class="bg bg-secondary-darker">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Slug</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach ($categories as $cat)    
                    <tr>
                        <td scope="row">{{ $number++ }}</td>
                        <td scope="row">{{ $cat->name }}</td>
                        <td>{{ $cat->slug }}</td>
                        <td>
                            @if ($cat->image)
                            <img src="{{ asset('storage/'.$cat->image) }}" width="25">
                            @elseif($cat->image == 'default.png' OR $cat->image == '' )
                            No Image
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-outline-success btn-sm" href="{{ route('categories.restore', [$cat->id]) }}" title="Restore Kategori {{ $cat->name }}">
                                <i class="fas fa-trash-restore"></i>
                            </a>

                            <form class="d-inline" action="{{ route('categories.delete-permanent', [$cat->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus permanent kategori {{ $cat->name }} ?')">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-outline-danger btn-sm" title="Hapus Permanen Kategori {{ $cat->name }}"><i class="fas fa-times-circle"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>        
            {{ $categories->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
    
@endsection