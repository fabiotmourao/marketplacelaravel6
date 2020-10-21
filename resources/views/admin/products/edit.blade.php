@extends('layouts.app')

@section('content')

<h1>Atualizar Protudo</h1>
    <form action="{{ route('admin.products.update', ['id'=> $product->id]) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nome produto</label>
            <input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{$product->name}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description')is-invalid @enderror" value="{{$product->description}}">
                @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control  @error('description')is-invalid @enderror" value="">{{$product->body}}</textarea>
                @error('body')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" class="form-control @error('description')is-invalid @enderror" value="{{$product->price}}">
                @error('price')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
        </div>

        <div class="form-group">
            <label>Categorias</label>
            <select name="categories[]" class="form-control " multiple>               
                @foreach($categories as $category)                
                        <option value="{{$category->id}}"
                            @if ($product->categories->contains($category)) selected @endif
                        >{{$category->name}}</option>                
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="">Fotos do Produto</label>
            <input type="file" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>
            @error('photos.*')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror

        </div>
        
        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar produto</button>
        </div>
    </form>
        <hr>
    <div class="row">
        @foreach($product->photos as $photo) 
            <div class="col-4 text-center ">
                <img src="{{ asset('storage/'. $photo->image )}}" class="rounded" alt="Cinque Terre" width="300" height="300">
                <form action="{{ route('admin.photo.remove')}}" method="post">  
                @csrf
                @method('POST')      
                    <input type="hidden" name="image" value="{{ $photo->image }}">
                    <button type="submit" class="btn btn-sm btn-danger float-left mt-2">Remover</button>   
                    <hr>       
                </form>
            </div>
        @endforeach
    </div>

@endsection