@extends('layouts.global');

@section('title') Edit User @endsection

@section('content') 

<div class="col-6">
    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Edit User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="{{ $user->username }}">
                </div>
                <div class="form-group">
                    <label for="">Roles</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input mr-3" type="checkbox" name="roles[]" id="ADMIN" value="ADMIN" {{ in_array('ADMIN', json_decode($user->roles)) ? "CHECKED" : "" }}>
                    <label class="form-check-label mr-5" for="ADMIN">
                      Admin
                    </label>
                    <input class="form-check-input" type="checkbox" name="roles[]" id="STAFF" value="STAFF" {{ in_array('STAFF', json_decode($user->roles)) ? "CHECKED" : "" }}>
                    <label class="form-check-label mr-5" for="STAFF">
                      Staff
                    </label>
                    <input class="form-check-input" type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER" {{ in_array('CUSTOMER', json_decode($user->roles)) ? "CHECKED" : "" }}>
                    <label class="form-check-label mr-5" for="CUSTOMER">
                      Customer
                    </label>
                </div>
                <div class="form-group mt-3">
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea type="text" class="form-control" name="address" id="address" placeholder="Address">{{ $user->address }}</textarea>
                </div>

                <div class="form-group">
                        <label for="avatar">Avatar Image</label>
                        <div class="custom-file col-8">
                            <input type="file" class="custom-file-input" name="avatar" id="avatar">
                            <label class="custom-file-label">Pilih Gambar</label>
                        </div>
                        @if ($user->avatar)
                            <img src="{{ asset('storage/'.$user->avatar) }}" class="img-thumbnail img-preview" width="50">
                        @else
                            No Avatar
                        @endif
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                </div>
    
                <hr class="my-3">
                
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="user@email.com" value="{{ $user->email }}">
                </div>
    
                <hr class="my-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="active" value="ACTIVE" {{ $user->status == 'ACTIVE' ? 'CHECKED' : '' }} >
                    <label class="form-check-label" for="active">
                      Active
                    </label>
                {{-- </div>
                <div class="form-check"> --}}
                    <input class="form-check-input" type="radio" name="status" id="inActive" value="INACTIVE" {{ $user->status == 'INACTIVE' ? 'CHECKED' : '' }} >
                    <label class="form-check-label" for="inActive">
                      Inactive
                    </label>
                </div>
                <hr class="my-3">
    
                <div class="form-group">
                    <label for=""></label>
                    <button type="submit" class="btn btn-outline-success" name="save" id="save"> Save </button>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-info"> Cancel </a>
                </div>
    
            </form>
      </div>
    </div>
</div>


@endsection