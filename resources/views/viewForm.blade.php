@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $form->name }}</div>
                    <div class="card-body">
                        @foreach($form->questions as $question)
                            <p>Вопрос : {{ $question->question}}</p>

                            @foreach($question->answers as $answer)
                                <p>Ответ : {{$answer->answer}}</p>
                            @endforeach
                        @endforeach
                            <p>Дата создания : {{ $form->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
