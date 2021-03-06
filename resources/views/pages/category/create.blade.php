@extends('layouts.global');

@section('title') {{ $title }} @endsection

@section('content') 


<div class="col-6">
    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Create Kategori</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control {{ $errors->first('name') ? "is-invalid" : "" }} " name="name" id="name" autofocus value="{{ old('name') }}">
                    <div class="invalid_feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>
                
                <div class="form-group mb-5">
                    <label for="">Category Image</label>
                    <div class="custom-file">
                        <small class="text-muted text-left">Kosongkan jika tidak ingin mengubah Image</small>
                        <div class="custom-file col-10">
                            <input type="file" class="custom-file-input {{ $errors->first('image') ? "is-invalid" : "" }}" name="image" id="image" onchange="previewImg()">
                            <label class="custom-file-label" for="image">Pilih Gambar</label>
                        </div>
                        <img src="{{ asset('storage/404/no_image.jpg') }}" class="img-thumbnail img-preview" width="50">
                        <div class="invalid_feedback">
                            {{ $errors->first('image') }}
                        </div>
                    </div>
                </div>

                <hr class="my-4">
    
                <div class="form-group">
                    <label for=""></label>
                    <button type="submit" class="btn btn-outline-success" name="save" id="save"> Save </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-info"> Cancel </a>
                </div>
    
            </form>
      </div>
    </div>
</div>

@endsection