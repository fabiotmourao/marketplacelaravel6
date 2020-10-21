@extends('layouts.app')

@section('content')

<h1>Criar Loja</h1>
    <form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data">
                    
        @csrf            

        <div class="form-group">
            <label>Nome Loja</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" placeholder="digite o nome da sua loja">

            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror

        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control  @error('description') is-invalid @enderror" value="{{old('description')}}"placeholder="Um breve descrição da sua loja">
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Telefone</label>
            <input type="text" name="phone" class="form-control phone-ddd-mask @error('phone') is-invalid @enderror" value="{{old('phone')}}" placeholder="Ex.: (00) 0000-0000">
            @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Celular/Whatsapp</label>
            <input type="text" name="mobile_phone" class="form-control cel-sp-mask  @error('mobile_phone') is-invalid @enderror" value="{{old('mobile_phone')}}" placeholder="Ex.: (00) 00000-0000">
            @error('mobile_phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Logo da Loja</label>
            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
            @error('logo')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

   {{--comentado para usar caso seja necessario criar manualmente lojas para os usuarios
        <div class="form-group">
            <label>Usuário</label>
            <select name="user" class="form-control">
                @foreach($users as $user) 
                    <option value="{{$user->id}}">{{$user->name}}</option>        
                @endforeach
            </select>
        </div>     
    --}}

        <div class="float-right" > 
            <button type="submit" class="btn btn-lg btn-success">Criar Loja</button>
        </div>
    </form>


@endsection