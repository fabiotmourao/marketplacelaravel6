@extends('layouts.app')


@section('content')

    <a href="{{route('admin.categories.create')}}" class="btn btn-lg btn-success">Criar Categoria</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td width="15%">
                        <div class="btn-group">
                            <a href="{{route('admin.categories.edit', ['id' => $category->id])}}" class="btn btn-sm btn-primary mr-1">EDITAR</a>
                            <form action="{{route('admin.categories.remover', ['id' => $category->id])}}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">REMOVER</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection