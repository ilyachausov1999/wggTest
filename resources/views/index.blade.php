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
                @foreach($users as $user)
                    @foreach($user->forms as $form)
                <div class="card">
                    <div class="card-header">
                        <p>{{ $form->name }}</p>
                        <p>Дата создания: {{ $form->created_at }}</p>
                        <p>Создал: {{ $user->name }}</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('createLead',$form)}}">
                            @csrf
                                @foreach($form->questions as $question)
                                    <p>Вопрос: {{ $question->question}}</p>
                                <input type="text" name="answer" value="" class="form-control" id="value">
                                @endforeach
                            <button type="submit" name="button" disabled class="btn btn-sm btn-success">Добавить ответ</button>
                        </form>
                    </div>
                </div>
                        <br>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
    <script>
        const checkLength = function(evt) {
            if (inputField.value.length > 2) {
                button.removeAttribute('disabled')
            }
        }
        const inputField = document.querySelector('input[name="answer"]')
        const button = document.querySelector('button[name="button"]')
        inputField.addEventListener('keyup', checkLength)
    </script>
@endsection
