@extends('layouts.global')

@section('title') Manage User @endsection

@section('content')


{{-- <div class="alert alert-secondary" role="alert">
    <strong>@yield("title")</strong>
</div> --}}

@if (session('status'))
<div class="alert alert-success" role="alert">
    <strong>{{ session('status') }}</strong>
</div>    
@endif

<div class="card border-primary-lighter">
    <div class="card-header bg bg-primary-lighter text-white">
        Data User
    </div>
    <div class="card-body">
        <div class="table-responsive">
            
            <div class="row col mb-3">
                <div class="col-sm-1 mr-3">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-orange">
                        Create <i class="fas fa-plus-circle" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="col-sm-7">
                    <form action="{{route('users.index')}}" class="form-inline">
                        <div class="form-group mb-2">
                        <input type="text" class="form-control"placeholder="Cari Berdasarkan Email" name="keyword" value="{{ Request::get('keyword') }}" autofocus>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="radio" class="form-control" name="status" id="active" value="ACTIVE" {{ Request::get('status') == 'ACTIVE' ? 'checked' : '' }} class="form-control" checked>
                            <label for="active">Active</label>
                            
                            <input type="radio" class="form-control" name="status" id="inactive" value="INACTIVE" {{ Request::get('status') == 'INACTIVE' ? 'checked' : '' }} class="form-control">
                            <label for="inactive">Inactive</label>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary mb-2">Confirm identity</button> --}}
                        <button type="submit" class="btn btn-outline-success"><i class="fas fa-eye"></i></button>
                    </form>
                </div>
            </div>
            <table class="table table-bordered table-sm table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Avatar</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @php
                    $number = 1;
                @endphp
                @foreach ($users as $user)
                    <tr>
                        <td scope="row">{{ $number++ }}</td>
                        <td scope="row">{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->avatar)
                            <img src="{{ asset('storage/'.$user->avatar) }}" width="25">
                            @elseif($user->avatar == 'default.png' OR $user->avatar == '' )
                            <img src="{{ asset('storage/avatars/default.png') }}" width="25">
                            @endif
                        </td>
                        <td>
                            @if ($user->status == 'ACTIVE')
                            <span class="badge badge-pill badge-success">
                                {{$user->status}}
                            </span>    
                            @else
                            <span class="badge badge-pill badge-danger">
                                {{$user->status}}
                            </span>                             
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-outline-purple btn-sm" href="{{ route('users.edit', [$user->id]) }}">
                                <i class="fas fa-pencil-alt"></i>
                                {{-- <i class="fav fa-pencil-paintbrush    "></i> --}}
                            </a>
                            <a class="btn btn-outline-info btn-sm" href="{{ route('users.show', [$user->id]) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            {{-- @if ($user->name != Auth::user()->name) --}}
                                <form action="{{ route('users.destroy', [$user->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin hapus permanent data ini?') ">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            {{-- @endif --}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>        
            {{ $users->links('vendor.pagination.custom') }}
        </div>
    </div>
</div>
    
@endsection