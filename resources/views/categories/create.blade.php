@extends('base')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Створити категорію</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif


            <form id="create" method="post" action="{{ route('categories.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Назва категорії:</label>
                    <input type="text" class="form-control" name="name"/>
                </div>

                <div class="form-group">
                    <label for="description">Опис:</label>
                    <textarea class="form-control" name="description" id ="description" rows="10" cols="45" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Додати категорію</button>
            </form>

        </div>

    </div>

@endsection

@section("scripts")
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'image'
        });
    </script>
@endsection
