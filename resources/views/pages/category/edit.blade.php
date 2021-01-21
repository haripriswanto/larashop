@extends('layouts.global');

@section('title') {{ $title }} @endsection

@section('content') 


<div class="col-6">
    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Update Kategori</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('categories.update', [$category->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <label for="">Category Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" value="{{ $category->slug }}">
                </div>
                <div class="form-group">
                    <label for="image">Category Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label">Pilih Gambar</label>
                    </div>
                    <div class="clearfix"><br></div>
                    @if ($category->image)
                        <img src="{{ asset('storage/'.$category->image) }}" class="img-thumbnail img-preview" width="50">
                    @else
                        <img src="{{ asset('storage/404/no_image.jpg') }}" class="img-thumbnail img-preview" width="50">
                    @endif
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah image</small>
                </div>
    
                <hr class="my-3">
    
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