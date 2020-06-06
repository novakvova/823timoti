@extends('base')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Категорії</h1>
            <a href="{{route("categories.create")}}" class="btn btn-success">Додати</a>

            <table class="table table-hover table-dark">
                <thead>
                <tr>
                    <th scope="col">Фото</th>
                    <th scope="col">Назва</th>
                    <th scope="col">Опис</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $item)
                    <tr>
                        <th scope="row">{{$item->image}}</th>
                        <td>{{$item->name}}</td>
                        <td>{!! $item->description !!}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
