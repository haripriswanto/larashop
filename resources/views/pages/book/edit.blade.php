@extends('layouts.global');

@section('title') {{ $title }} @endsection

@section('content') 


@if (session('status'))
<div class="alert alert-success" role="alert">
    <strong>{{ session('status') }}</strong>
</div>    
@endif

<div class="col-8">
    <div class="card border-primary my-3">
        <div class="card-header bg bg-primary text-white">
            <h3>Form Edit</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('books.update', [$book->id]) }}" method="POST" class="p-3 shadow-sm bg-white" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" class="form-control {{ $errors->first('title') ? "is-invalid" : "" }} " name="title" id="title" placeholder="Book Title" value="{{ $book->title }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                </div>
                <div class="form-group mb-5">
                    <label for="">Book Cover</label>
                    <div class="custom-file">
                        <small class="text-muted text-left">Kosongkan jika tidak ingin mengubah Image</small>
                        <div class="custom-file col-10">
                            <input type="file" class="custom-file-input " name="image" id="image" onchange="previewImg()">
                            <label class="custom-file-label" for="image">Pilih Gambar</label>
                        </div>
                        @if ($book->cover)
                            <img src="{{ asset('storage/'.$book->cover) }}" class="img-thumbnail img-preview" width="60">
                        @else
                            <img src="{{ asset('storage/404/no_image.jpg') }}" class="img-thumbnail img-preview" width="60">
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Slug</label>
                    <input type="text" class="form-control {{ $errors->first('slug') ? "is-invalid" : "" }} " name="slug" id="slug" placeholder="Slug-on-sistem" value="{{ $book->slug }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea class="form-control {{ $errors->first('description') ? "is-invalid" : "" }} " name="description" id="description" placeholder="Description">{{ $book->description }}</textarea>
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Kategori</label>
                    <select name="categories[]" id="categories" multiple class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="">Stok</label>
                    <input type="number" class="form-control {{ $errors->first('stock') ? "is-invalid" : "" }} " name="stock" id="stock" placeholder="0" value="{{ $book->stock }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('stock') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Author</label>
                    <input type="text" class="form-control {{ $errors->first('author') ? "is-invalid" : "" }} " name="author" id="author" placeholder="Author" value="{{ $book->author }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('author') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Publisher</label>
                    <input type="text" class="form-control {{ $errors->first('publisher') ? "is-invalid" : "" }}" name="publisher" id="publisher" placeholder="Publisher" value="{{ $book->publisher }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('publisher') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="number" class="form-control {{ $errors->first('price') ? "is-invalid" : "" }} " name="price" id="price" placeholder="0" value="{{ $book->price }}">
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option {{ $book->status == 'PUBLISH' ? 'SELECTED' : '' }} value="PUBLISH">Publish</option>
                        <option {{ $book->status == 'DRAFT' ? 'SELECTED' : '' }} value="DRAFT">Draft</option>
                    </select>
                </div>
                
                <hr class="my-3">
    
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success" value="PUBLISH"> Update </button>
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
                    results: data.map(function(item){return {id: item.id,text: item.name}})
                }
            }
        }
    })

    var categories = {!! $book->categories !!}

    categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
    });
</script>
@endsection