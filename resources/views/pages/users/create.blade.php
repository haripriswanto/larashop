@extends('layouts.global');

@section('title') Create User @endsection

@section('content') 


<div class="col-6">
    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Create User</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" autofocus>
                </div>
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <label for="">Roles</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input mr-3" type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
                    <label class="form-check-label mr-5" for="ADMIN">
                      Admin
                    </label>
                    <input class="form-check-input" type="checkbox" name="roles[]" id="STAFF" value="STAFF">
                    <label class="form-check-label mr-5" for="STAFF">
                      Staff
                    </label>
                    <input class="form-check-input" type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
                    <label class="form-check-label mr-5" for="CUSTOMER">
                      Customer
                    </label>
                </div>
                <div class="form-group mt-3">
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <textarea type="text" class="form-control" name="address" id="address" placeholder="Address"></textarea>
                </div>
                <div class="form-group mb-5">
                    <label for="">Avatar Image</label>
                    <div class="custom-file">
                        <div class="custom-file col-10">
                            <input type="file" class="custom-file-input" name="image" id="image" onchange="previewImg()">
                            <label class="custom-file-label" for="avatar">Pilih Gambar</label>
                        </div>
                        <img src="{{ asset('storage/avatars/default.png') }}" class="img-thumbnail img-preview" width="60">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>
                    </div>
                </div>
    
                <hr class="my-3">
                
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="user@email.com">
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="">Password Confirm</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password">
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