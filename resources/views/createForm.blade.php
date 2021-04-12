@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session()->get('success'))
            <div class="alert alert-success mt-3">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Создание формы') }}</div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('store') }}" method="POST" id="form">
                                @csrf
                                <div class="form-group">
                                    <label for="user-login">Название</label>
                                    <input name="name" value="" class="form-control " id="user-login">
                                </div>

                                <button class="btn btn-sm btn-success" type="button" onclick="add_question()">Добавить вопрос</button>
                                <button class="btn btn-sm btn-success" type="button" onclick="add_answer()">Добавить ответ</button>
                                <button class="btn btn-sm btn-success" type="submit">Сохранить</button>

                            </form>
                            <script>
                                document.getElementById('form').onsubmit = function() {
                                    if(n > 0 && m > 0){
                                        return true;
                                    }else{
                                        alert('Добавьте поля Вопрос и Ответ!');
                                        return false;
                                    }
                                }

                                let n = 0;
                                function add_question(){
                                    n = n + 1;
                                    var name = "Вопрос" + n;
                                    //var name_img = 'Изображение';
                                    var y = document.getElementById("form");
                                    var new_label = document.createElement("label");
                                    new_label.setAttribute("for", "content-title");
                                    new_label.setAttribute("id", "label_qv" + n);
                                    var pos1 = y.childElementCount;
                                    y.insertBefore(new_label, y.childNodes[pos1]);
                                    var label_qv = document.getElementById("label_qv" + n);
                                    label_qv.insertAdjacentHTML('afterbegin' , name);

                                    var new_field = document.createElement("input");
                                    new_field.setAttribute("type", "text");
                                    new_field.setAttribute("name", "questions[" + n + "][name]");
                                    new_field.setAttribute("class", "form-control");
                                    var pos = y.childElementCount;
                                    y.insertBefore(new_field, y.childNodes[pos]);

                                    var z = 0;
                                    z = z + 1;
                                    if(z > 0){x = 0}
                                }

                                let m = 0;
                                let x = 0;
                                function add_answer(){
                                    m = m + 1
                                    x = x + 1;
                                    let name = "Ответ" + x;
                                    var y = document.getElementById("form");
                                    var new_label = document.createElement("label");
                                    new_label.setAttribute("for", "content-title");
                                    new_label.setAttribute("id", "label_an" + m);
                                    var pos0 = y.childElementCount;
                                    y.insertBefore(new_label, y.childNodes[pos0]);
                                    var label_an = document.getElementById("label_an" + m);
                                    label_an.insertAdjacentHTML('afterbegin' , name);

                                    var new_field = document.createElement("input");
                                    new_field.setAttribute("type", "text");
                                    new_field.setAttribute("name", "questions[" + n + "][answers][" + m + "][answer]");
                                    new_field.setAttribute("class", "form-control");
                                    var pos = y.childElementCount;
                                    y.insertBefore(new_field, y.childNodes[pos]);
                                }
                            </script>
                        </div>
                </div>
            </div>
        </div>
@endsection



