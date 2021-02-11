@extends('layouts.global');

@section('title') Create User @endsection

@section('content') 


<div class="col-6">
    
@if (session('status'))
<div class="alert alert-success" role="alert">
    <strong>{{ session('status') }}</strong>
</div>    
@endif

    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Create User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" name="name" id="name" placeholder="Full Name" autofocus value="{{ old('name') }}">
                    <div class="invalid_feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control {{ $errors->first('username') ? "is-invalid" : "" }}" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                    <div class="invalid_feedback">
                        {{ $errors->first('username') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Roles</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input mr-3 {{ $errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
                    <label class="form-check-label mr-5" for="ADMIN">
                      Admin
                    </label>
                    <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="STAFF" value="STAFF">
                    <label class="form-check-label mr-5" for="STAFF">
                      Staff
                    </label>
                    <input class="form-check-input {{ $errors->first('roles') ? "is-invalid" : "" }}" type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
                    <label class="form-check-label mr-5" for="CUSTOMER">
                      Customer
                    </label>
                    <div class="invalid_feedback">
                        {{ $errors->first('roles') }}
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control {{ $errors->first('phone') ? "is-invalid" : "" }}" name="phone" id="phone" placeholder="Phone Number" value="{{ old('phone') }}">
                    <div class="invalid_feedback">
                        {{ $errors->first('phone') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea type="text" class="form-control {{ $errors->first('address') ? "is-invalid" : "" }}" name="address" id="address" placeholder="Address">{{ old('address') }}</textarea>
                    <div class="invalid_feedback">
                        {{ $errors->first('address') }}
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="">Avatar Image</label>
                    <div class="custom-file">
                        {{-- <small class="text-muted text-left">Kosongkan jika tidak ingin mengubah Image</small> --}}
                        <div class="custom-file col-10">
                            <input type="file" class="custom-file-input {{ $errors->first('image') ? "is-invalid" : "" }}" name="image" id="image" onchange="previewImg()">
                            <label class="custom-file-label" for="image">Pilih Gambar</label>
                        </div>
                        <img src="{{ asset('storage/avatars/default.png') }}" class="img-thumbnail img-preview" width="60">
                        <div class="invalid_feedback mb-3">
                            {{ $errors->first('image') }}
                        </div>
                    </div>
                </div>
    
                <hr class="my-3">
                
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control {{ $errors->first('email') ? "is-invalid" : "" }}" name="email" id="email" placeholder="user@email.com" value="{{ old('email') }}">
                    <div class="invalid_feedback">
                        {{ $errors->first('email') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control {{ $errors->first('password') ? "is-invalid" : "" }}" name="password" id="password" placeholder="Password">
                    <div class="invalid_feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Password Confirm</label>
                    <input type="password" class="form-control {{ $errors->first('password_confirmation') ? "is-invalid" : "" }}" name="password_confirmation" id="password_confirmation" placeholder="Password">
                    <div class="invalid_feedback">
                        {{ $errors->first('password_confirmation') }}
                    </div>
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