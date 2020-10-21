@extends('layouts.front')


@section('content')
    <div class="row">
        <div class="col-6">
            @if($product->photos->count())
                <img src="{{ asset('storage/'.$product->photos->first()->image) }}" alt="FOTOS" class="card-img-top img-thumbnail">
                <div class="row">
                    @foreach($product->photos as $photo)
                        <div class="col-3">
                            <img src="{{ asset('storage/'.$photo->image) }}" alt="FOTOS" class='card-img-top img-thumbnail mt-1'>
                        </div>
                    @endforeach
                </div>
            @else
                <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="" class="card-img-top">
            @endif
        </div>
        <div class="col-6 mt-4">
            <div class='col-md-12'>
                <h2> {{$product->name}} </h2>
                <p>  {{$product->description}} </p>
                <h3> R$ {{number_format($product->price, '2', ',', '.')}} </h3>
                <span>
                    Loja: {{$product->store->name}}
                </span>
            </div>

            <div class="product-add col-md-12">
            <hr>
                <form action="{{ route('cart.add')}}" method="post">
                @csrf
                    <input type="hidden" name="product[name]"  value="{{$product->name}}">
                    <input type="hidden" name="product[price]" value="{{$product->price}}">
                    <input type="hidden" name="product[slug]"  value="{{$product->slug}}">

                    <div class="form-group mt-3">
                        <label>Quantidade</label>
                        <input type="number" name="product[amount]" class='form-control col-md-2' value="1" min='0'>
                    </div>
                        <button class="btn btn-lg btn-danger">
                            Adicionar ao carrinho
                            <i class="fa fa-shopping-cart fa-1x"></i>
                        </button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>
            {{$product->body}}
        </div>
    </div>
@endsection
