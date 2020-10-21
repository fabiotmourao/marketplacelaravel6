@extends('layouts.app')

@section('content')

<h1>Atualizar Loja</h1>
    <form action="{{ route('admin.stores.update', ['id'=> $store->id]) }}" method="post" enctype="multipart/form-data">
                    
        @csrf
        @method('PUT')

        <div class="row">      
            <div class="col-sm-10">  
                <div class="form-group">
                    <label>Nome Loja</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$store->name}}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" value="{{$store->description}}">
                    @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" name="phone" class="form-control  @error('phone') is-invalid @enderror" value="{{$store->phone}}">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Celular/Whatsapp</label>
                    <input type="text" name="mobile_phone" class="form-control  @error('mobile_phone') is-invalid @enderror" value="{{$store->mobile_phone}}">
                    @error('mobile_phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-sm-7 mt-auto">  
                        <label for="" >Logo da Loja</label>
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" placeholder="Escolha um logo" >
                                @error('logo')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                    </div>

                    <div class="col-sm-4 pt-2 pl-5 ml-5"> 
                        <div class="form-group">
                            <img src="{{ asset('storage/' . $store->logo) }}" class="rounded-circle " alt="Cinque" width="252" height="252">
                        </div>
                    </div>
                </div>
                        <hr>
                <div>
                    <button type="submit" class="btn btn-lg btn-success">Atualizar</button>
                </div>
            </div>
        </div>
    </form>
@endsection