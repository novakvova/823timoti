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


                <div class="form-label-group">
                    <img src="/images/upload.jpg" id="select_file"
                         class="btn rounded-circle mx-auto d-block"
                         width="200px" alt="noimage">
                    <input type="hidden" id="imgBase64" name="imgBase64" />
                </div>

                <div class="form-group">
                    <label for="description">Опис:</label>
                    <textarea class="form-control" name="description" id ="description" rows="10" cols="45" ></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Додати категорію</button>
            </form>

        </div>

    </div>

    @include("cropper-modal");

@endsection

@section("scripts")
    <script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'image'
        });
    </script>

    <script>
        jQuery(function () {
            //фото по якому клікаємо для вибору файла
            $select_file = $("#select_file");

            //модалка для вибору файла
            $dialogCropper=$("#cropperModal");

            //при клікові по фото - робимо клік по інпуту для вибору файла
            $select_file.on("click", function () {
                let uploader = $('<input type="file" accept="image/*" />');

                uploader.click();
                //якщо користувач вибрав файл на ПК
                uploader.on("change", function() {
                    if (this.files && this.files.length) {
                        //Беремо перший файл, який обрав користувач
                        let file = this.files[0];
                        var reader = new FileReader();
                        //коли завершили читання файлу, відобраємо діалогове вікно для кропера і змінюємо фото у кропері
                        reader.onload = function(e) {
                            $dialogCropper.modal('show');
                            cropper.replace(e.target.result);
                            uploader.remove();

                        }
                        //Починаємо зчитувати файл, який обрав користувач
                        reader.readAsDataURL(file);

                    }
                });


            });


            //Фото (тег img) у діалоговому вікні із яким працює кропер
            const imgPreview = document.getElementById('preview-img');
            //Налаштування кроперра
            const cropper = new Cropper(imgPreview, {
                aspectRatio: 1/1,
                viewMode: 1,
                autoCropArea: 0.5,
                crop(event) {
                    // console.log(event.detail.x);
                    // console.log(event.detail.y);
                    // console.log(event.detail.width);
                    // console.log(event.detail.height);
                    // console.log(event.detail.rotate);
                    // console.log(event.detail.scaleX);
                    // console.log(event.detail.scaleY);
                },
            });

            //клікнули на кнопку повернути фото
            $("#img-rotation").on("click",function (e) {
                e.preventDefault();
                cropper.rotate(45);
            });

            //Натиснули кнопку обрізати фото
            $("#cropImg").on("click", function (e) {
                e.preventDefault();
                //Отримали фото із кропера
                var imgContent = cropper.getCroppedCanvas().toDataURL();
                //відобразили фото на формі
                $select_file.attr("src", imgContent);
                $("#imgBase64").val(imgContent);
                //скриваємо діалогове вікно
                $dialogCropper.modal('hide');
            });
        });
    </script>
@endsection
