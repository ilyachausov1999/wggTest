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
                @foreach($forms as $form)
                    @foreach($form->leads as $lead)
                    <div class="card">
                        <div class="card-header">
                            <p>Lead: {{ $form->name }}</p>
                            <p>Дата создания: {{ $lead->created_at }}</p>
                        </div>
                        <div class="card-body">
                            @foreach($form->questions as $question)
                                <p>Вопрос: {{$question->question}}</p>
                                @foreach($question->answers as $answer)
                                    @if(($answer->question_id == $question->id)&&($answer->lead_id == $lead->id))
                                <p>Ответ: {{$answer->answer}}</p>
                                    @endif
                                @endforeach
                            @endforeach
                                <form method="post" action="{{ route('deleteLead',$lead->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Удалить lead</button>
                                </form>
                        </div>
                    </div>
                        <br>
                    @endforeach
                @endforeach
            </div>
        </div>
            {{ $forms->links('layouts.paginate') }}
    </div>

@endsection
