@extends('layouts.global');

@section('title') {{ $title }} @endsection

@section('content') 


@if (session('status'))
<div class="alert alert-success" role="alert">
    <strong>{{ session('status') }}</strong>
</div>    
@endif

<div class="col-6">
    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Create New Book</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control {{ $errors->first('title') ? "is-invalid" : ""}} " name="title" id="title" autofocus value="{{ old('title') }}">
                    <div class="invalid-feedback">
                      {{$errors->first('title')}}
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="">Book Cover</label>
                    <div class="custom-file">
                        <small class="text-muted text-left">Kosongkan jika tidak ingin mengubah Image</small>
                        <div class="custom-file col-10">
                            <input type="file" class="custom-file-input" name="image" id="image" onchange="previewImg()" value="{{ old('image') }}">
                            <label class="custom-file-label" for="image">Pilih Gambar</label>
                        </div>
                        <img src="{{ asset('storage/404/no_image.jpg') }}" class="img-thumbnail img-preview" width="60">
                        <div class="invalid-feedback">
                          {{$errors->first('image')}}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <textarea type="text" class="form-control {{$errors->first('description') ? "is-invalid" : ""}}" name="description" id="description">{{old('description')}}</textarea>
                    <div class="invalid-feedback">
                      {{$errors->first('description')}}
                    </div>
                </div>
                
                <div class="form-group">
                  <label for="">Kategori</label>
                  <select multiple class="form-control" name="categories[]" id="categories"></select>
                </div>

                <div class="form-group">
                    <label for="">Stock</label>
                    <input type="number" class="form-control {{ $errors->first('stock') ? "is-invalid" : ""}} " name="stock" id="stock" min=0 value=0 value="{{ old('stock') }}">
                    <div class="invalid-feedback">
                      {{$errors->first('stock')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="">Author</label>
                    <input type="text" class="form-control {{$errors->first('author') ? "is-invalid" : ""}} " name="author" id="author" value="{{ old('author') }}">
                    <div class="invalid-feedback">
                      {{$errors->first('author')}}
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Publisher</label>
                    <input type="text" class="form-control {{ $errors->first('publisher') ? "is-invalid" : ""}}" name="publisher" id="publisher" value="{{ old('publisher') }}">
                    <div class="invalid-feedback">
                      {{$errors->first('publisher')}}
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" class="form-control {{ $errors->first('price') ? "is-invalid" : "" }}" name="price" id="price" value=0 value="{{ old('price')}} ">
                    <div class="invalid-feedback">
                      {{$errors->first('price')}}
                    </div>
                </div>

                <hr class="my-3">
    
                <div class="form-group">
                    <label for=""></label>
                    <button type="submit" class="btn btn-outline-success" name="save" id="PUBLISH" value="PUBLISH"> Publish </button>
                    <button type="submit" class="btn btn-outline-orange" name="save" id="DRAFT" value="DRAFT"> Save As Draft </button>
                    <a href="{{ route('books.index') }}" class="btn btn-outline-info"> Cancel </a>
                </div>
    
            </form>
      </div>
    </div>
</div>

@endsection


@section('footer-scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
    $('#categories').select2({
        ajax: {
            url: 'http://127.0.0.1:8000/ajax/categories/search',
            processResults: function(data){
                return {
                    results: data.map(function(item){
                        return {
                            id: item.id,
                            text: item.name
                        }
                    })
                }
            }
        }
    })
</script>
@endsection