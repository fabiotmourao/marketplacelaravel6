@extends('layouts.front')
<style>
    #img{
        width: 345px; 
        height: 299px;
    }
    #a{
        margin-top: 50px;
    }
    #conteudo-body{
        width: 100%;
        height: 20px;
    }
</style>

@section('content')
    <div class="row front row-cols-1 row-cols-md-3">
        @foreach ($products as $key => $product)
            <div class="col-md-4">
                <div class="card border-dark">
                        @if($product->photos->count())
                            <img src="{{ asset('storage/'.$product->photos->first()->image) }}" alt="" id="img" class="card-img-top img-thumbnail">
                        @else 
                            <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="" id="img" class="card-img-top img-thumbnail">
                        @endif
                    <div class="card-body">
                        <h2 class="card-title mb-5" id="conteudo-body">{{ $product->name }}</h2>
                        <p  class="card-text pt-5 pb-3" id="conteudo-body">{{ $product->description }}</p>
                        <h3 class="card-text pt-5" id="conteudo-body"> R$ {{number_format($product->price, '2', ',', '.')}} </h3>
                    </div>

                    <a id="a" href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success ">
                        Ver fotos
                    </a>
                </div>
            </div>
            @if (($key + 1) %3 == 0)  </div><div class="row front"> @endif
        @endforeach
        <hr>
    </div>
@endsection